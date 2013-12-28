<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 下午8:42
 */

namespace service\wechat\telework;


use service\wechat\Handler;
use util\Log;
use util\Mongo;

class Text extends Handler {
    public function handle(\SimpleXMLElement $subject) {
        $userId = $subject->FromUserName;
        $createTime = $subject->CreateTime;
        $content = $subject->Content;
        $this->registerHunter($userId, $createTime, $content);
        return $this->huntJob($userId, $content);
    }

    private function registerHunter($userId, $createTime, $content) {
        $hunter = Mongo::collection("hunter");
        $hunter->update(array("id" => $userId), array("createTime" => $createTime, "content" => $content), array("upsert" => true));
    }

    private function huntJob($userId, $content){
        return $this->text($userId, "非常抱歉，暂时没有关于<$content>的招聘，以后若有相关招聘，我们将第一时间通知你，祝一切顺利。");
    }
} 