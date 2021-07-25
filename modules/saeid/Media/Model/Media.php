<?php

namespace saeid\Media\Model;

use Illuminate\Database\Eloquent\Model;
use saeid\Media\Services\MediaFileServices;


class Media extends Model
{
    protected $casts=[
      'files'=>'json'
    ];

    protected static function booted(){
        static::deleting(function ($media){
            MediaFileServices::delete($media);
        });
    }
   /* public function getThumbAttribute()
    {
        return 'public\\' .$this->files[300];
    }*/

}
