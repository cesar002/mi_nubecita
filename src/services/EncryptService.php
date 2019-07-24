<?php

namespace Services;

class EncryptService{
    private static $key = "jlcsrCA58*";

    public static function encrypt(string $text) : string{
        $result = '';
        for($i=0; $i<strlen($text); $i++) {
            $char = substr($text, $i, 1);
            $keychar = substr(self::$key, ($i % strlen(self::$key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $result.=$char;
        }
        return base64_encode($result);
    }

    public static function decrypt(string $text) : string{
        $result = '';
        $text = base64_decode($text);
        for($i=0; $i<strlen($text); $i++) {
            $char = substr($text, $i, 1);
            $keychar = substr(self::$key, ($i % strlen(self::$key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }
        return $result;
    }

}