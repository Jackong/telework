<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 下午8:42
 */

namespace service\wechat\telework;


use glob\config\Loader;
use service\Job;
use service\User;
use service\wechat\Handler;
use util\Log;

class Text extends Handler {

    /**
     * @var \service\User
     */
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function handle(\SimpleXMLElement $subject) {
        $userId = $subject->FromUserName;
        $content = $subject->Content;
        $category = $this->getCategory(trim($content));
        if (0 == $category) {
            Log::Notice($userId, "feedback", $content);
            return $this->text($userId, "谢谢您的反馈，我们将尽快处理。" . \glob\Job::huntJobText());
        }
        $this->user->subscribe($userId, "wechat", $category);
        return $this->huntJob($userId, $category);
    }

    private function getCategory($content) {
        if (!is_numeric($content)) {
            return 0;
        }
        $category = intval($content);
        if (is_null($this->category($category))) {
            return 0;
        }
        return $category;
    }

    private function huntJob($userId, $category) {
        $job = new Job();
        $items = $job->gets($category, 10);
        if (empty($items)) {
            Log::Debug($userId, "can not found any job", $category);
            $job = $this->category("$category.lang.1");
            return $this->text($userId, "非常抱歉，暂时没有关于<$job>的招聘，稍后若有相关招聘，我们将第一时间为您送达，祝一切顺利。");
        }
        Log::Trace($userId, "found jobs", $category, count($items));
        return $this->news($userId, $items);
    }

    private function category($category) {
        return Loader::load("source._37signals|categories.$category");
    }
} 