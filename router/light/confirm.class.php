<?php
/**
 * User: daisy
 * Date: 14-1-16
 * Time: 下午9:30
 */

namespace router\light;


use common\Template;
use glob\config\Loader;
use router\Router;
use service\Job;
use service\Subscriber;
use util\Encrypt;
use util\Input;
use util\Log;

class Confirm extends Router {
    public function get() {
        $id = Input::get("id");
        $email = Input::get("email", "/([\w\-]+\@[\w\-]+\.[\w\-]+)/");
        $position = Input::get("position", "/(.+?){1,15}/");
        $deEmail = Encrypt::decrypt($id, Loader::load("sys|salt"));
        $ok = ($email === $deEmail);
        $tips = '<div id="failure" class="alert alert-danger">订阅确认失败，这不是你的邮箱。</div>';
        if ($ok) {
            $category = Loader::load("source._37signals|categories.$position.lang.1");
            $tips = '<div id="success" class="alert alert-success">恭喜您订阅成功，稍候将第一时间为您送上 ' . $category . ' 相关信息。</div>';
            $subscriber = new Subscriber();
            $subscriber->registerHunter($email, $category);
        }
        Log::Trace($_SERVER["REMOTE_ADDR"], $_SERVER['HTTP_USER_AGENT'], $email, $deEmail);
        $_SERVER["HTTP_ACCEPT"] = "text/html";

        $categories = Loader::load("source._37signals|categories");
        foreach ($categories as $id => $category) {
            $categories[$id] = $category["lang"][1];
        }

        $job = new Job();
        $items = $job->gets(2, 10);
        $jobs = new Template("light/jobs", array("items" => $items));
        return array(
            "light/app",
            array(
                "jobs" => $jobs,
                "tips" => $tips,
                "categories" => $categories,
            )
        );
    }
} 