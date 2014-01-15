<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 下午8:42
 */

namespace service\wechat\telework;


use service\Subscriber;
use service\wechat\Handler;

class Event extends Handler {
    public function handle(\SimpleXMLElement $subject) {
        $fromUserName = $subject->FromUserName;
        $createTime = $subject->CreateTime;
        $event = (string)$subject->Event;
        $subscriber = new Subscriber();
        if (!method_exists($subscriber, $event)) {
            return null;
        }
        return $this->$event($fromUserName, "wechat", null, $createTime);
    }
} 