<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 下午8:42
 */

namespace service\wechat\telework;


use glob\config\source\_37Signals;
use service\wechat\Handler;
use util\Log;
use util\Mongo;

class Text extends Handler {
    public function handle(\SimpleXMLElement $subject) {
        $userId = $subject->FromUserName;
        $createTime = $subject->CreateTime;
        $content = $subject->Content;
        $category2Job = $this->getCategoryAndJob($content);
        if (!$category2Job) {
            Log::Debug($userId, "wrong request job format");
            return $this->text($userId, "你回复的格式有误，请确认其正确性。" . \glob\config\Job::huntJobText());
        }
        $this->registerHunter($userId, $createTime, $category2Job[0], $category2Job[1]);
        return $this->huntJob($userId, $category2Job[0], $category2Job[1]);
    }

    private function getCategoryAndJob(&$content) {
        $content = str_replace("：", ":", $content);
        $request = explode(":", $content);
        if (count($request) < 2) {
            return false;
        }
        if (!isset(_37Signals::$categories[$request[0]])) {
            return false;
        }
        if (mb_strlen($request[1]) > 15) {
            return false;
        }
        return $request;
    }

    private function registerHunter($userId, $createTime, $category, $job) {
        $hunter = Mongo::user("hunter");
        $hunter->update(
            array("id" => $userId),
            array(
                "id" => $userId,
                "createTime" => $createTime,
                "category" => $category,
                "job" => $job
            ),
            array("upsert" => true)
        );
        Log::Trace($userId, "register hunter for", $category, $job);
    }

    private function huntJob($userId, $category, $job) {
        $jobs = Mongo::job("jobs");
        $condition = "function(){
                    return this.title.indexOf('$job') > 0;
                }";
        $cursor = $jobs->find(
            array(
                "category" => $category,
                '$where' => $condition,
            ),
            array(
                "title" => true,
                "description" => true,
                "pubTime" => true,
                "link" => true,
            )
        );

        if (empty($cursor)) {
            Log::Debug($userId, "can not found any job", $category, $job);
            return $this->text($userId, "非常抱歉，暂时没有关于<$job>的招聘，稍后若有相关招聘，我们将第一时间为您送达，祝一切顺利。");
        }
        $items = array();
        foreach ($cursor as $doc) {
            $item["title"] = $doc["title"];
            $item["description"] = date("Y-m-d H:i", $doc["pubTime"]) . ":" . substr($doc["description"], 0, 25);
            $item["link"] = $doc["link"];
            $item["picUrl"] = "http://telework.duapp.com/static/default.jpeg";
            $items[] = $item;
        }
        Log::Trace($userId, "found jobs", $category, $job, count($items));
        return $this->news($userId, $items);
    }

} 