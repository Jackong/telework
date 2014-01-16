<?php
/**
 * User: daisy
 * Date: 14-1-5
 * Time: 下午8:37
 */

namespace router\light;


use glob\config\Loader;
use router\Router;
use service\Subscriber;
use util\Bcms;
use util\Encrypt;
use util\Input;

class Subscription extends Router {
    public function post() {
        $email = Input::get("email", "/([\w\-]+\@[\w\-]+\.[\w\-]+)/");
        $position = Input::get("position", "/(.+?){1,15}/");

        $subscriber = new Subscriber();
        $subscriber->subscribe(strtolower($email), $position, "email");
        $id = Encrypt::encrypt($email, Loader::load("sys|salt"));
        Bcms::mail(
            "自由人远程职位订阅确认",
            "<!--HTML-->您好，您在<a href='http://telework.duapp.com/app/light'>自由人</a>上订阅了 $position 职位。<br>
            如有您需要的职位，我们将会第一时间通知你。请点击以下链接，确认激活订阅（如非本人操作，请匆点击）：<br>
            <a href='http://telework.duapp.com/light/confirm?id=$id&email=$email'>确认订阅</a>",
            array($email));
        return true;
    }

} 