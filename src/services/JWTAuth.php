<?php

namespace Services;

use Firebase\JWT\JWT;
use Models\UserModel;

class JWTAuth {

    public static function generateAuthToken(UserModel $user) : string{
        $time = time();
        $token = [
            "iat" => $time,
            "exp" => $time + (60*60),
            "data" => $user,
        ];  

        $jwtToken = JWT::encode($token, KEY_JWT);

        return $jwtToken;
    }

    public static function checkAuthToken(object $jwtToken) : bool{
        if(empty($jwtToken)){
            return false;
        }

        $decode = JWT::decode($jwtToken, KEY_JWT, array('HS256'));

        if($decode->aud !== self::Aud()){
            return false;
        }

        return true;
    }

    public static function getDataAuthToken(object $jwtToken) : ?object {
        if(empty($jwtToken)){
            return null;
        }

        try{
            $decode = JWT::decode($jwtToken, KEY_JWT, array('HS256'));

            return $decode->data;
        }catch(\Error $err){
            return null;
        }catch(\Exception $e){
            return null;
        }
    }

    public static function getDataArrayAuthToken(object $jwtToken) : ?object {
        if(empty($jwtToken)){
            return null;
        }

        try{
            $decode = JWT::decode($jwtToken, KEY_JWT, array('HS256'));

            return json_decode($decode->data);
        }catch(\Error $err){
            return null;
        }catch(\Exception $e){
            return null;
        }
    }

    private static function Aud(){
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }
}