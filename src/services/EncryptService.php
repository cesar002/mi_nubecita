<?php

namespace Services;

use Utils\DevelopConstants;

class EncryptService{
    
    public static function encrypt(string $text) : string{
        return self::encrypt_decrypt('encrypt', $text);
    }

    public static function decrypt(string $text) : string{
        return self::encrypt_decrypt('decrypt', $text);
    }

    private static function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        // hash
        $key = hash('sha256', DevelopConstants::$KEY_ENCRYPT_SERVICE);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', DevelopConstants::$IV), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }


}