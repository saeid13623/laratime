<?php


namespace saeid\Commen\Responses;


use http\Env\Response;

class AjaxResponse
{
    public static function SuccessResponse()
    {
        return response()->json(['message'=>'عملیات با موفقیت انجام شد'],Response::HTTP_OK);
    }
    public static function FailedResponse()
    {
        return response()->json(['message'=>'عملیات موفقیت آمیزنبود'],Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
