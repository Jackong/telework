<?php
/**
 * User: daisy
 * Date: 14-1-16
 * Time: 下午9:30
 */

namespace router\light;


use glob\config\source\_37Signals;
use glob\config\Sys;
use service\Job;
use Slim\Slim;
use util\Encrypt;
use util\Log;
use util\Output;


class Confirm {

    public function confirm($id, $email, $category) {

        $ok = md5($email . Sys::get('salt')) === $id;

        if ($ok) {
            $categoryName = _37Signals::get('categories', $category, 'lang', 1);
            if (is_null($categoryName)) {
                Output::error("抱歉，没有您要订阅的职位，请重新订阅。");
            } else {
                Output::ok("恭喜您订阅成功，稍候将第一时间为您送上 $categoryName 相关信息。");
                $user = new \service\User();
                $user->subscribe(strtolower($email), "email", $category);
            }
        } else {
            Output::error("订阅确认失败，这不是你的邮箱。");
        }

        Log::Trace($ok, $email);

        $categories = _37Signals::get('categories');
        foreach ($categories as $id => $cate) {
            $categories[$id] = $cate["lang"][1];
        }
    }
}


Slim::getInstance()->get('/confirm/:id/:email/:category', array(new Confirm(), 'confirm'))->conditions(
    array(
        'email' => '([\w\-]+\@[\w\-]+\.[\w\-]+)',
        'category' => '[0-9]{1}',
    )
);