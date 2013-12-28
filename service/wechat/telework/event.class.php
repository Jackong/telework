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
        $collection = Mongo::user("subscribe");
        $collection->update(array("id" => $userId), array("createTime" => $createTime, "type" => "subscribe"), array("upsert" => true));
        Log::Trace($userId, $createTime);
        $categories = "";
        foreach (\_37Signals::$categories as $category => $info) {
            if (isset($info["support"]) && !$info["support"]) {
                continue;
            }
            $categories .= $category . "：" . $info["lang"][1] . "\n";
        }

        return $this->text(
            $userId,
            "欢迎关注，远程工作为您服务。请选择你的职业领域并回复相应数字及职位：\n职业领域："
            . $categories
            . "\n如：想找编程领域的php职位，则回复\"2:php\"\n"
            . "将为你第一时间呈送。"
        );
    }

    private function unsubscribe($userId, $createTime){
        $collection = Mongo::user("subscribe");
        $collection->update(array("id" => $userId), array("createTime" => $createTime, "type" => "unsubscribe"), array("upsert" => true));
        Log::Trace($userId, $createTime);
        return null;
    }
} 