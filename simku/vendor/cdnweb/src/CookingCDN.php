<?php
/**
 * @copyright 2023 CDN Service (playdb.id)
 * @author xtrarom (xtrarom@desible.net)
 * @Version 1.0.2
 */

namespace CDNWeb;

use Exception;

class CookingCDN extends BakeCDN implements PlayCDN 
{
    /**
     * Default Max File Size
     */
    private $ContentSize = 5000000;

    /**
     * Set Accumulator API
     */
    public function APIUrl($url)
    {
        BakeCDN::$API_Url = $url;
        return $this;
    }

    public function APIId($ID)
    {
        BakeCDN::$API_ID = $ID;
        return $this;
    }

    public function APIKey($key)
    {
        BakeCDN::$API_Key = $key;
        return $this;
    }

    /**
     * Set Max File Size
     */
    public function MaxSize($size)
    {
        $this->ContentSize = $size;
        return $this;
    }

    /**
     * Validation mime type to allow
     */
    public function Validate($Content)
    {
        try {
            if($Content["size"] >= $this->ContentSize) throw new Exception("File size terlalu besar !...");
            if(!((!empty($Content["name"])) && (($Content["type"] == "image/jpeg")
            || ($Content["type"] == "application/pdf") || ($Content["type"] == "image/jpg") || ($Content["type"] == "image/png") 
            || ($Content["type"] == "image/gif") || ($Content["type"] == "image/mpga") || ($Content["type"] == "image/wav") 
            || ($Content["type"] == "video/mp4") || ($Content["type"] == "video/ogv") || ($Content["type"] == "video/webm")
            || ($Content["type"] == "text/plain") || ($Content["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") 
            || ($Content["type"] == "application/msword") || ($Content["type"] == "application/pdf") 
            || ($Content["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
            || ($Content["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation"))))
            {
                throw new Exception("Mime type tidak di ijinkan !...");
            }
        }
        catch(Exception $e) {
            echo 'Error: ' .$e->getMessage();
            exit();
        }
    }

    /**
     * Sending File to CDN Server
     */
    public function SendFile($FileName, $FileUpload)
    {
        if(!empty(BakeCDN::$API_ID) && !empty(BakeCDN::$API_Key))
        {
            if(isset($FileUpload['tmp_name']))
            {            
                $file_path = realpath($FileUpload['tmp_name']);
                $FiletoSending = (function_exists('curl_file_create')) ? curl_file_create($file_path):'@' . realpath($file_path);
                
                $ReqParams = [];
                $ReqParams['requesting'] = 'Upload';
                $ReqParams['file_name'] = $FileName;
                $ReqParams['api_keys'] = BakeCDN::$API_Key;
    
                return (!empty($FileName)) ? BakeCDN::ObjFileRequest($ReqParams, $FiletoSending):false;
            }
            else return false;
        }
        else return false;
    }

    /**
     * Update File on CDN Server
     */
    public function UpdateFile($UnlinkFile, $FileName, $FileUpload)
    {
        if(!empty(BakeCDN::$API_ID) && !empty(BakeCDN::$API_Key))
        {
            if(isset($FileUpload['tmp_name']))
            {
                $file_path = realpath($FileUpload['tmp_name']);
                $FiletoSending = (function_exists('curl_file_create')) ? curl_file_create($file_path):'@' . realpath($file_path);
                
                $ReqParams = [];
                $ReqParams['requesting'] = 'Update';
                $ReqParams['unlink_file'] = $UnlinkFile;
                $ReqParams['file_name'] = $FileName;
                $ReqParams['api_keys'] = BakeCDN::$API_Key;

                return (!empty($UnlinkFile) && !empty($FileName)) ? BakeCDN::ObjFileRequest($ReqParams, $FiletoSending):false;
            }
            else return false;
        }
        else return false;
    }

    /**
     * Delete File on CDN Server
     */
    public function DeleteFile($UnlinkFile)
    {
        if(!empty(BakeCDN::$API_ID) && !empty(BakeCDN::$API_Key))
        {
            if(isset($UnlinkFile))
            {
                $ReqParams = [];
                $ReqParams['requesting'] = 'Delete';
                $ReqParams['unlink_file'] = $UnlinkFile;
                $ReqParams['api_keys'] = BakeCDN::$API_Key;

                return (!empty($UnlinkFile)) ? BakeCDN::ObjFileRequest($ReqParams, "none"):false;
            }
            else return false;
        }
        else return false;
    }
}