<?php

namespace App\Utils;

/**
 * Description of Rsa
 *
 * @author acer-2
 */
class Rsa {

    public static function encrypt($content) {
        if(is_array($content)){
            $content    = json_encode($content,JSON_UNESCAPED_SLASHES);
        }
        $pubKey = base_path('keys/rsa_public_key.pem');
        $publicKey = openssl_pkey_get_public(file_get_contents($pubKey));
        $encryptData = '';
        if (openssl_public_encrypt($content, $encryptData, $publicKey)) {
            return base64_encode($encryptData);
        }
        return null;
    }

    public static function decrypt($text, $keyPath) {
        $text   = base64_decode($text);
        $privateKey = openssl_pkey_get_private(file_get_contents($keyPath));
        $decryptData = '';

        if (openssl_private_decrypt($text, $decryptData, $privateKey)) {
            return $decryptData;
        }
        
        return null;
    }

}
