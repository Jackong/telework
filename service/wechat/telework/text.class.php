<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 下午8:42
 */

namespace service\wechat\telework;


use glob\config\source\_37Signals;
use service\Job;
use service\wechat\Handler;
use util\Log;
use util\Mongo;

class Text extends Handler {
    public function handle(\SimpleXMLElement $subject) {
        $userId = $subject->FromUserName;
        $createTime = $subject->CreateTime;
        $content = $subject->Content;
        $category = $this->getCategory(trim($content));
        if (0 == $category) {
            Log::Notice($userId, "feedback", $content);
            return $this->text($userId, "谢谢您的反馈，我们将尽快处理。" . \glob\config\Job::huntJobText());
        }
        $this->registerHunter($userId, $createTime, $category);
        return $this->huntJob($userId, $category);
    }

    private function getCategory($content) {
        if (!is_numeric($content)) {
            return 0;
        }
        $category = intval($content);
        if (!isset(_37Signals::$categories[$category])) {
            return 0;
        }
        return $category;
    }

    private function registerHunter($userId, $createTime, $category) {
        $hunter = Mongo::user("hunter");
        $hunter->update(
            array("id" => $userId),
            array(
                "id" => $userId,
                "createTime" => $createTime,
                "category" => $category,
            ),
            array("upsert" => true)
        );
        Log::Trace($userId, "register hunter for", $category);
    }

    private function huntJob($userId, $category) {
        $job = new Job();
        $items = $job->gets($category, 10);
        if (empty($items)) {
            Log::Debug($userId, "can not found any job", $category);
            $job = _37Signals::$categories[$category]["lang"][1];
            return $this->text($userId, "非常抱歉，暂时没有关于<$job>的招聘，稍后若有相关招聘，我们将第一时间为您送达，祝一切顺利。");
        }
        Log::Trace($userId, "found jobs", $category, count($items));
        return $this->news($userId, $items);
    }

} 