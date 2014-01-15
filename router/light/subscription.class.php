<?php
/**
 * User: daisy
 * Date: 14-1-5
 * Time: 下午8:37
 */

namespace router\light;


use router\Router;
use service\Subscriber;
use util\Input;

class Subscription extends Router {
    public function post() {
        $email = Input::get("email", "/([\w\-]+\@[\w\-]+\.[\w\-]+)/");
        $position = Input::get("position", "/(.+?){1,15}/");
        $subscriber = new Subscriber();
        $subscriber->subscribe(strtolower($email), $position, "email");
        //todo: send validate email
        return "OK";
    }

} 