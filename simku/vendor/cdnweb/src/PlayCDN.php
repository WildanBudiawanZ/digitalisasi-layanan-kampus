<?php
/**
 * @copyright 2023 CDN Service (playdb.id)
 * @author xtrarom (xtrarom@desible.net)
 * @Version 1.0.2
 */

namespace CDNWeb;

interface PlayCDN
{
    public function APIUrl($ID);
    public function APIId($ID);
    public function APIKey($ID);
    public function MaxSize($size);
    public function Validate($Content);
    public function SendFile($FileName, $FileUpload);
    public function UpdateFile($UnlinkFile, $FileName, $FileUpload);
    public function DeleteFile($UnlinkFile);
}