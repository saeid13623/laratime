<?php


namespace saeid\Media\Contract;


use Illuminate\Http\UploadedFile;
use saeid\Media\Model\Media;

interface FileServiceContract
{
    public static function upload(UploadedFile $file,string $dir,string $extension,string $filename) :array ;
    public static function delete(Media $media) ;
    public static function stream(Media $media);
}
