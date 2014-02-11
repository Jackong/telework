<?php
/**
 * User: daisy
 * Date: 14-1-17
 * Time: 上午8:42
 */

namespace service;


use util\Mongo;
use util\Redis;

class User {

    const TYPE_SUBSCRIBER = 1;


    const STATUS_SUBSCRIBE = 0;
    const STATUS_UNSUBSCRIBE = 1;

    const FROM_EMAIL = "email";
    const FROM_WECHAT = "wechat";
    /**
     * @var \MongoCollection
     */
    private $user;

    public function __construct() {
        $this->user = Mongo::user("user");
        $this->rSubscriber = Redis::select('subscriber');
    }

    public function subscribers($category, $from) {
        return $this->rSubscriber->sMembers("$category:$from");
    }

    public function subscribe($id, $from, $category = null) {
        $newObj = array(
            "id" => $id,
            "time" => TIME,
            "from" => $from,
            "type" => self::TYPE_SUBSCRIBER,
            'status' => self::STATUS_SUBSCRIBE,
        );
        if (!is_null($category)) {
            $newObj["category"] = $category;
            $this->rSubscriber->sAdd("$category:$from", $id);
        }
        $this->user->update(
            array(
                "id" => $id,
                "from" => $from
            ),
            $newObj,
            array(
                "upsert" => true
            )
        );
    }

    public function unsubscribe($id, $from, $category = self::FROM_WECHAT) {
        $this->user->update(
            array(
                "id" => $id,
                "from" => $from
            ),
            array(
                "status" => self::STATUS_UNSUBSCRIBE,
            )
        );
        $this->rSubscriber->sRem("$category:$from", $id);
    }
} 