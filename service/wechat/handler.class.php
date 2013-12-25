<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 上午9:12
 */

namespace service\wechat;



interface Handler {
    public function handle(\SimpleXMLElement $subject);
} 