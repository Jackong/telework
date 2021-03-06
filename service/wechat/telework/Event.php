<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 下午8:42
 */

namespace service\wechat\telework;


use glob\Job;
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
        $this->user->$event($fromUserName, User::FROM_WECHAT);
        return $this->text($fromUserName, "谢谢关注，远程工作为您服务:" . Job::huntJobText());
    }
} 