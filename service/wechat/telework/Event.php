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
use util\Input;

class Event extends Handler {
    private $user;

    public function __construct() {
        $this->user = new User();
    }


    public function handle() {
        $fromUserName = Input::get('FromUserName');
        $event = Input::get('Event');
        if (!method_exists($this->user, $event)) {
            return null;
        }
        $this->$event($fromUserName, "wechat");
        return Job::huntJobText();
    }
} 