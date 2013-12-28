<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 下午8:42
 */

namespace service\wechat\telework;


use service\wechat\Handler;
use util\Mongo;

class Text extends Handler {
    public function handle(\SimpleXMLElement $subject) {
        $userId = $subject->FromUserName;
        $createTime = $subject->CreateTime;
        $content = $subject->Content;
        if (!$this->checkJob($content)) {
            return $this->text($userId, "你回复的格式有误，请确认其正确性。" . \glob\config\Job::huntJobText());
        }
        $this->registerHunter($userId, $createTime, $content);
        return $this->huntJob($userId, $content);
    }

    private function checkJob($content) {
        str_replace("：", ":", $content);
        $request = explode(":", $content);
        if (count($request) < 2) {
            return false;
        }
        $category = $request[0];
        $job = $request[1];
    }

    private function registerHunter($userId, $createTime, $content) {
        $hunter = Mongo::user("hunter");
        $hunter->update(array("id" => $userId), array("createTime" => $createTime, "content" => $content), array("upsert" => true));
    }

    private function huntJob($userId, $content){
        return $this->text($userId, "非常抱歉，暂时没有关于<$content>的招聘，以后若有相关招聘，我们将第一时间通知你，祝一切顺利。");
    }
} 