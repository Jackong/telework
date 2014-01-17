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
use service\User;
use util\Encrypt;
use util\Input;
use util\Log;

class Confirm extends Router {

    /**
     * @var User
     */
    private $user;

    public function init() {
        $this->user = new User();
    }

    public function get() {
        $_SERVER["HTTP_ACCEPT"] = "text/html";

        $id = Input::get("id");
        $email = Input::get("email", "/([\w\-]+\@[\w\-]+\.[\w\-]+)/");
        $position = Input::get("position", "/(.+?){1,15}/");

        $ok = $this->checkSign($id, $email);

        if ($ok) {
            $this->user->subscribe(strtolower($email), "email", $position);
        }

        Log::Trace($email, $ok);

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
                "tips" => $this->getTips($ok, $position),
                "categories" => $categories,
            )
        );
    }

    private function checkSign($id, $email) {
        $deEmail = Encrypt::decrypt($id, Loader::load("sys|salt"));
        return ($email === $deEmail);
    }

    private function getTips($ok, $position) {
        if ($ok) {
            $category = Loader::load("source._37signals|categories.$position.lang.1");
            if (is_null($category)) {
                return '<div id="failure" class="alert alert-danger">抱歉，您订阅的职位不存在，请重新订阅。</div>';
            }
            return '<div id="success" class="alert alert-success">恭喜您订阅成功，稍候将第一时间为您送上 "' . $category . '" 相关信息。</div>';
        }

        return '<div id="failure" class="alert alert-danger">订阅确认失败，这不是你的邮箱。</div>';
    }
} 