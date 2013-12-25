<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 下午8:42
 */

namespace service\wechat\telework;


use service\wechat\Handler;
use util\Log;

class Event extends Handler {
    public function handle(\SimpleXMLElement $subject) {
        $toUserName = $subject->ToUserName;
        $fromUserName = $subject->FromUserName;
        $createTime = $subject->CreateTime;
        $event = $subject->Event;
        Log::Debug("$toUserName, $fromUserName, $createTime, $event");
    }

} 