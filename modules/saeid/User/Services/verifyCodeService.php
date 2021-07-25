<?php


namespace saeid\User\Services;


class verifyCodeService
{
    private static $min = 100000;
    private static $max = 999999;
    private static $prefix = 'verify_code_';

    public static function code(){
        $code=random_int(100000,999999);
        return $code;
    }
    public static function storeCache($id,$code,$time){
         cache()->set('verify_code_'.$id,$code,$time);
    }
    public static function getCache($id){
        return cache()->get('verify_code_'.$id);
    }
    public static function delete ($id)
    {
       return cache()->delete('verify_code_'.$id);
    }
    public static function getRule()
    {
        return 'required|numeric|between:' . self::$min .','. self::$max;
    }
    public static function check($id, $code)
    {
        if (self::getCache($id) != $code) return false;

        self::delete($id);
        return  true;
    }
    public static function has($id)
    {
        return cache()->has(self::$prefix .$id);
    }
}
