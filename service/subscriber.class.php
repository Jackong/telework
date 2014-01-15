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
    public function subscribe($userId, $from, $subject, $createTime = TIME){
        $this->updateStatus($userId, $from, true, $createTime, $subject);
        Log::Trace($userId, $from, $createTime);
    }

    public function unsubscribe($userId, $from, $createTime = TIME){
        $this->updateStatus($userId, $from, false, $createTime);
        Log::Trace($userId, $from, $createTime);
    }

    private function updateStatus($userId, $from, $status, $createTime, $subject = null) {
        $collection = Mongo::user("subscribe");
        $newObj = array(
                "id" => $userId,
                "createTime" => $createTime,
                "type" => $from,
                "status" => $status
            );
        if (!is_null($subject)) {
            $newObj["subject"] = $subject;
        }
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