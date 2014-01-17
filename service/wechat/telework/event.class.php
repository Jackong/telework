<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 下午8:42
 */

namespace service\wechat\telework;


use service\User;
use service\wechat\Handler;

class Event extends Handler {
    private $user;

    public function __construct() {
        $this->user = new User();
    }


    public function handle(\SimpleXMLElement $subject) {
        $fromUserName = $subject->FromUserName;
        $event = (string)$subject->Event;
        if (!method_exists($this->user, $event)) {
            return null;
        }
        return $this->$event($fromUserName, "wechat");
    }
} 