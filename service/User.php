<?php
/**
 * User: daisy
 * Date: 14-1-17
 * Time: 上午8:42
 */

namespace service;


use util\Mongo;

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
    }

    public function subscribers($category, $from) {
        $cursor = $this->user->find(array('category' => $category, 'from' => $from))->sort(array('time' => -1));
        $ids = array();
        foreach ($cursor as $doc) {
            $ids[] = $doc['id'];
        }
        return $ids;
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

    public function unsubscribe($id, $from) {
        $this->user->update(
            array(
                "id" => $id,
                "from" => $from
            ),
            array(
                "status" => self::STATUS_UNSUBSCRIBE,
            )
        );
    }
} 