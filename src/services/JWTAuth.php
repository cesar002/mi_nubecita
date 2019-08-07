<?php

namespace Services;

use Firebase\JWT\JWT;
use Models\UserModel;
use Services\DevelopConstants;

class JWTAuth {

    public static function generateAuthToken(UserModel $user) : string{
        $time = time();
        $token = [
            "iat" => $time,
            "exp" => $time + (60*60),
            "aud" => self::Aud(),
            "data" => $user,
        ];  

        $jwtToken = JWT::encode($token, DevelopConstants::$KEY_JWT);

        return $jwtToken;
    }

    public static function checkAuthToken(string $jwtToken) : bool{
        if(empty($jwtToken)){
            return false;
        }

        $decode = null;

        try{
            $decode = JWT::decode($jwtToken, DevelopConstants::$KEY_JWT, array('HS256'));
        }catch(\Exception $e){
            return false;
        }catch(\Error $err){
            return false;
        }
        

        if($decode->aud !== self::Aud()){
            return false;
        }

        return true;
    }

    public static function getDataAuthToken(object $jwtToken) : ?UserModel {
        if(empty($jwtToken)){
            return null;
        }

        try{
            $decode = JWT::decode($jwtToken, DevelopConstants::$KEY_JWT, array('HS256'));

            return $decode->data;
        }catch(\Error $err){
            return null;
        }catch(\Exception $e){
            return null;
        }
    }

    public static function getDataArrayAuthToken(object $jwtToken) : ?array {
        if(empty($jwtToken)){
            return null;
        }

        try{
            $decode = JWT::decode($jwtToken, DevelopConstants::$KEY_JWT, array('HS256'));

            return $decode->data->toArray();
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