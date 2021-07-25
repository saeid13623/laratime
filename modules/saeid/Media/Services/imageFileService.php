<?php


namespace saeid\Media\Services;


use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image;
use saeid\Media\Contract\FileServiceContract;
use saeid\Media\Model\Media;


class imageFileService extends DefaultFileService implements FileServiceContract
{
    public static $sizes=['300','600'];

    public static function upload($file,$dir,$extension,$filename):array
    {
        $file->move(storage_path($dir),$filename . '.' . $extension);

        $path= $dir  . $filename . '.' . $extension;

        $img=storage_path($path);

        $image=self::resize($img,$dir,$filename,$extension);
        return $image;
    }

    private static function resize($img,$dir,$filename,$extension){
        $img=Image::make($img);

        $imgs['original']= $filename . '.' . $extension;
        foreach (Self::$sizes as $size){
            $imgs[$size]= $filename . '_' .$size. '.' . $extension;
            $img->resize($size,null,function ($aspect){
                $aspect->aspectRatio();
            })->save(storage_path($dir).$filename . '_' .$size. '.' . $extension);

        }
        return $imgs;
    }
    public static function getFilename(){
        return (static::$media->is_private ? 'private/' : 'public/') . static::$media->files['original'];
    }



}
