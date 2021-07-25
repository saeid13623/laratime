<?php


namespace saeid\Media\Services;


;

use Illuminate\Http\UploadedFile;
use saeid\Media\Contract\FileServiceContract;
use saeid\Media\Model\Media;

class MediaFileServices
{
    public static $IsPrivate;
    public static $dir;
    public static $file;

    public static function PrivateUpload(UploadedFile $file)
    {
        self::$IsPrivate = true;
        self::$file = $file;
        self::$dir = "private/";
        return self::upload();
    }

    public static function PublicUpload(UploadedFile $file)
    {
        self::$IsPrivate = false;
        self::$file = $file;
        self::$dir = "app\public\\";
        return self::upload();
    }

    public static function upload()
    {
        $extension = self::NormalizeExtension(self::$file);

        foreach (config('fileServices.MediaTypeServices') as $key => $service) {
            if (in_array($extension, $service['extensions'])) {
                return self::UploadByHandler(new $service['handler'], $extension, $key);
            }
        }
    }

    public static function stream(Media $media)
    {
        foreach (config('fileServices.MediaTypeServices') as $type => $service){
            if($media->type == $type){
                return $service['handler']::stream($media);
            }
        }
    }

    public static function delete($media)
    {
        foreach (config('fileServices.MediaTypeServices') as $type => $service){
            if($media->type == $type){
               return $service['handler']::delete($media);
            }
        }



        /*switch ($media->type) {
            case 'image' :
                imageFileService::delete($media);
                break;

        }*/
    }
   /* public static function delete(Media $media)
    {
        foreach (config('mediaFile.MediaTypeServices') as $type => $service) {
            if ($media->type == $type) {
                return $service['handler']::delete($media);
            }
        }
    }*/

    private static function NormalizeExtension($file): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        return $extension;
    }

    private static function FileNameGenerator()
    {
        return uniqid();
    }

    private static function UploadByHandler(FileServiceContract $service, string $extension, $key): Media
    {
        $media = new Media();
        $media->files = $service::upload(self::$file, self::$dir, $extension, self::FileNameGenerator());
        $media->type = $key;
        $media->user_id = auth()->id();
        $media->filename = self::$file->getClientOriginalName();
        $media->is_private = self::$IsPrivate;
        $media->save();
        return $media;
    }

    public static function getExtensions()
    {
        $extensions=[];
        foreach (config('fileServices.MediaTypeServices') as $service){
            foreach ($service['extensions'] as $extension){
                $extensions[]=$extension;
            }
        }
        return implode(',',$extensions);
    }

    public static function thumb(Media $media)
    {
        foreach (config('fileServices.MediaTypeServices') as $type => $service) {
            if ($media->type == $type) {
                return $service['handler']::thumb($media);
            }
        }
    }




    /* public static function upload()
    {
    $extension = strtolower($file->getClientOriginalExtension());

        switch ($extension){
             case 'jpg' :
             case 'jpeg' :
             case 'png' :
                 $media = new Media();
                 $media->files=imageFileservice::upload($file);
                 $media->type='image';
                 $media->user_id = auth()->id();
                 $media->filename = $file->getClientOriginalName();
                 $media->save();
                 return $media;
                 break;

             case 'avi' :
             case 'mp4' :
             case 'mkv' :
                 $media=new Media();
                 $media->files=videoFileService::upload($file);
                 $media->type = 'video';
                 $media->user_id = auth()->id();
                 $media->filename = $file->getClientOriginalName();
                 $media->save();
                 return $media;
                 break;
         }
    }*/

}
