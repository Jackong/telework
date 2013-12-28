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

class Event extends Handler {
    public function handle(\SimpleXMLElement $subject) {
        $fromUserName = $subject->FromUserName;
        $createTime = $subject->CreateTime;
        $event = (string)$subject->Event;
        if (!method_exists($this, $event)) {
            return null;
        }
        return $this->$event($fromUserName, $createTime);
    }

    private function subscribe($userId, $createTime){
        $collection = Mongo::collection("subscribe");
        $collection->update(array("id" => $userId), array("createTime" => $createTime, "type" => "subscribe"), array("upsert" => true));
        Log::Trace($userId, $createTime);
        return $this->text($userId, "欢迎关注，远程工作为您服务，请回复你要订阅的职位，将为你第一时间呈送。" . \Wording::$developing);
    }

    private function unsubscribe($userId, $createTime){
        $collection = Mongo::collection("subscribe");
        $collection->update(array("id" => $userId), array("createTime" => $createTime, "type" => "unsubscribe"), array("upsert" => true));
        Log::Trace($userId, $createTime);
        return null;
    }
} 