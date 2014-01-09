<?php
/**
 * User: daisy
 * Date: 14-1-9
 * Time: 上午9:58
 */

namespace service;


use util\Mongo;

class Job {
    public function gets($category, $num) {
        $jobs = Mongo::job("jobs");
        $cursor = $jobs->find(
            array(
                "category" => new \MongoInt32($category),
            ),
            array(
                "title" => true,
                "description" => true,
                "pubTime" => true,
                "id" => true,
            )
        )->sort(array("pubTime" => -1));

        $items = array();
        foreach ($cursor as $doc) {
            $count = count($items);
            $item["title"] = $doc["title"];
            $item["description"] = $doc["description"] . "\n" . date("Y-m-d H:i", $doc["pubTime"]);
            $item["url"] = "http://bcs.duapp.com/telework-jobs/${doc['id']}.html";
            $item["picUrl"] = "http://telework.duapp.com/images/remote$count.jpeg";
            $items[$doc["id"]] = $item;
            if ($count >= $num - 1) {
                break;
            }
        }
        return $items;
    }
} 