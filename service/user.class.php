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
    /**
     * @var \MongoCollection
     */
    private $user;

    public function __construct() {
        $this->user = Mongo::user("user");
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