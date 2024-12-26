<?php
/**
 * @copyright 2023 CDN Service (playdb.id)
 * @author xtrarom (xtrarom@desible.net)
 * @Version 1.0.2
 */

namespace CDNWeb;

use Exception;

class BakeCDN
{
    public static $API_Url = "https://cdn-pustekipad.uinbanten.ac.id/depository/file/";
    public static $API_ID;
    public static $API_Key;

    /**
     * Object to request sending
     * 
     * */ 
    public static function ObjFileRequest($Req_params, $File_Content)
    {
        $encryptReq = self::cdncrypt(json_encode($Req_params), self::$API_Key);
        
        if($File_Content == "none")
        {
            $params = [];
            $params['send_request'] = $encryptReq;
            $params['api_id'] = self::$API_ID;
        }
        else{            
            $params = [];
            $params['send_request'] = $encryptReq;
            $params['api_id'] = self::$API_ID;
            $params['file_contents'] = $File_Content;
        }
        
        return self::ReplayCatching($params);        
    }

    /**
     * CURL Configuration & Catch return transfer
     * 
     * */ 
    private static function ReplayCatching($params)
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_CONNECTTIMEOUT => 500,
            CURLOPT_TIMEOUT        => 500,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => ["Content-Type: multipart/form-data"],
            CURLOPT_POSTFIELDS => $params
        ];
        
        //================================================================================//
        //================================================================================//        
        
        $ch = curl_init(self::$API_Url);
        curl_setopt_array($ch, $options);
        $content = @json_decode(curl_exec($ch));
        $header  = curl_getinfo($ch);
        curl_close($ch);        
        $header['Content'] = $content;
        // return $header;
        //================================================================================//
        //================================================================================//
        return (gettype($header['Content']) == 'object') ? (($header['Content']->accept) ? (($header['Content']->status == "Success") ? true:"file not found"):false):false;
    }

    /**
     * Crypter Parameters
     * Must be enabled open ssl module
     * */ 
    private static function cdncrypt($clear, $ckey = 'des_key', $base64 = true)
    {
        if (!is_string($clear) || !strlen($clear)) return '';        
        $opts   = defined('OPENSSL_RAW_DATA') ? OPENSSL_RAW_DATA : true;
        $iv     = self::GenBytes(openssl_cipher_iv_length('AES-256-CBC'), true);
        $cipher = openssl_encrypt($clear, 'AES-256-CBC', $ckey, $opts, $iv);

        if ($cipher === false) return false;
        $cipher = $iv . $cipher;
        return $base64 ? base64_encode($cipher):$cipher;
    }

    /**
     * Generator Initial Vector
     * Must be enabled open ssl module
     * */ 
    private static function GenBytes($length, $raw = false)
    {
        $hextab  = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $tabsize = strlen($hextab);

        // Use PHP7 true random generator
        if ($raw && function_exists('random_bytes')) {
            return random_bytes($length);
        }

        if (!$raw && function_exists('random_int')) {
            $result = '';
            while ($length-- > 0) {
                $result .= $hextab[random_int(0, $tabsize - 1)];
            }

            return $result;
        }

        $random = openssl_random_pseudo_bytes($length);

        if ($random === false && $length > 0) {
            throw new Exception("Failed to get random bytes");
        }

        if (!$raw) {
            for ($x = 0; $x < $length; $x++) {
                $random[$x] = $hextab[ord($random[$x]) % $tabsize];
            }
        }

        return $random;
    }
}