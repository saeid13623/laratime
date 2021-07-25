<?php

namespace saeid\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use saeid\Media\Model\Media;
use saeid\Media\Services\MediaFileServices;

class MediaController extends Controller
{
    public function download(Request $request,Media $media)
    {
            if(!$request->hasValidSignature()){
                abort(401);
            }
            return MediaFileServices::stream($media);
    }
}
