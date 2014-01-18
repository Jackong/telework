<?php
/**
 * User: daisy
 * Date: 14-1-16
 * Time: 下午9:30
 */

namespace router\light;


use glob\config\Loader;
use service\Job;
use service\User;
use Slim\Slim;
use util\Encrypt;
use util\Log;



class Confirm {

    public function confirm($id, $email, $category) {
        $deEmail = Encrypt::decrypt($id, Loader::load("sys|salt"));

        $ok = ($email === $deEmail);

        $app = Slim::getInstance();
        if ($ok) {
            $categoryName = Loader::load("source._37signals|categories.$category.lang.1");
            if (is_null($categoryName)) {
                $app->flash("failure", "抱歉，您订阅的职位不存在，请重新订阅。");
            } else {
                $app->flash("success", "恭喜您订阅成功，稍候将第一时间为您送上 $categoryName 相关信息。");
                $user = new \service\User();
                $user->subscribe(strtolower($email), "email", $category);
            }
        } else {
            $app->flash("failure", "订阅确认失败，这不是你的邮箱。");
        }

        Log::Trace($email, $ok);

        $categories = Loader::load("source._37signals|categories");
        foreach ($categories as $id => $cate) {
            $categories[$id] = $cate["lang"][1];
        }

        $job = new Job();
        $items = $job->gets(2, 10);
        $app->render('light/app.html', array('categories' => $categories, 'jobs' => $items));
    }
}


Slim::getInstance()->get('/confirm/:id/:email/:category', array(new Confirm(), 'confirm'))->conditions(
    array(
        'email' => '([\w\-]+\@[\w\-]+\.[\w\-]+)',
        'category' => '[0-9]{1}',
    )
);