<?php
return [
        "MediaTypeServices"=>[

                "image" => [
                    "extensions" =>['jpg' ,'jpeg' , 'png','gif'],
                    "handler" => saeid\Media\Services\imageFileService::class,
                ],
                "video" => [
                    "extensions"=>['avi' ,'mp4' , 'mkv'],
                    "handler" => saeid\Media\Services\videoFileService::class,
                ],
                "zip" => [
                    "extensions"=>['zip' ,'rar' , 'tar'],
                    "handler" => saeid\Media\Services\ZipFileService::class,
                ],
        ],
    ];
