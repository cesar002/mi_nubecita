<?php

namespace Services;

/**
 * Clase que permite generar tokens
 */
class TokenGenerator{
    /**
     * Retorna un token generado por el metodo SSL dado un tamaño de bytes
     *
     * @param integer $size_token
     * tamaño de bytes
     * @return string
     */
    public static function generateOpenSSLToken(int $size_token) : string{
        $token = openssl_random_pseudo_bytes($size_token);
        return bin2hex($token);
    }

    /**
     * Retorna un token generado por el metodo de Random Bytes dado un tamaño de bytes
     *
     * @param integer $size_token
     * tamaño de bytes
     * @return string
     */
    public static function generateRandomBytesToken(int $size_token) : string{
        return bin2hex(random_bytes($size_token));
    }
}

