<?php


namespace saeid\Media\Services;


use Illuminate\Support\Facades\Storage;
use saeid\Media\Contract\FileServiceContract;
use saeid\Media\Model\Media;

class videoFileService extends DefaultFileService implements FileServiceContract
{
    public static function upload($file,$dir,$extension,$filename):array
    {
        $extension=$file->getClientOriginalExtension();
        $filename=uniqid();
        $dir='private\\';
        /*$file->move(storage_path($dir),$fileName . '.' . $extension);*/
        Storage::putFileAs($dir,$file,$filename. '.' .$extension);
        return ["video"=> $filename . '.' . $extension];
    }

    public static function getFilename(){
        return (static::$media->is_private ? 'private/' : 'public/') . static::$media->files['video'];
    }

}
