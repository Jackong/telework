<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 上午9:12
 */

namespace service\wechat;



abstract class Handler {
    public abstract function handle(\SimpleXMLElement $subject);

    public function needCheck() {
        return false;
    }
} 