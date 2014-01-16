<?php
/**
 * User: daisy
 * Date: 14-1-15
 * Time: 上午8:52
 */

namespace service;


use util\Log;
use util\Mongo;

class Subscriber {
    public function subscribe($userId, $from, $createTime = TIME){
        $this->updateStatus($userId, $from, true, $createTime);
        Log::Trace($userId, $from, $createTime);
    }

    public function unsubscribe($userId, $from, $createTime = TIME){
        $this->updateStatus($userId, $from, false, $createTime);
        Log::Trace($userId, $from, $createTime);
    }

    public function registerHunter($userId, $category, $createTime = TIME) {
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

    private function updateStatus($userId, $from, $status, $createTime) {
        $collection = Mongo::user("subscribe");
        $newObj = array(
                "id" => $userId,
                "createTime" => $createTime,
                "type" => $from,
                "status" => $status
            );
        $collection->update(
            array(
                "id" => $userId
            ),
            $newObj,
            array(
                "upsert" => true
            )
        );
    }
} 