<?php
/**
 * User: daisy
 * Date: 14-1-5
 * Time: 下午8:37
 */

namespace router\light;


use glob\config\source\_37Signals;
use glob\config\Sys;
use service\User;
use Slim\Slim;
use util\Bcms;
use util\Encrypt;
use util\Input;


class Subscription {

    public function subscribe() {
        $email = Input::get("email", "/([\w\-]+\@[\w\-]+\.[\w\-]+)/");
        $category = Input::get("category", "/(.+?){1,15}/");

        $name = _37Signals::get('categories', $category, 'lang', 1);

        if (is_null($name)) {
            echo json_encode(array('success' => false));
            return;
        }

        $user = new User();
        $user->subscribe(strtolower($email), "email");

        $id = Encrypt::encrypt($email, Sys::get('salt'));
        $ok = Bcms::mail(
            "自由人远程职位订阅确认",
            "<!--HTML-->
            <!doctype html>
            <html>
            <head>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
            </head>
            <body>
            您好，您在<a href='http://telework.duapp.com/app/light'>自由人</a>上订阅了 '$name' 职位。<br>
            如有您需要的职位，我们将会第一时间通知你。请点击以下链接，确认激活订阅（如非本人操作，请匆点击）：<br>
            <a href='http://telework.duapp.com/light/confirm/$id/$email/$category'>确认订阅</a>
            </body>
            </html>",
            array($email));
        if ($ok) {
            echo json_encode(array("success" => true));
        }else {
            echo json_encode(array("success" => false));
        }
    }
}

Slim::getInstance()->post('/subscription', array(new Subscription(), 'subscribe'));