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
                "link" => true,
                "img" => true,
                "id" => true,
            )
        )->sort(array("pubTime" => -1));

        $items = array();
        foreach ($cursor as $doc) {
            $count = count($items);
            $item["title"] = $doc["title"];
            $item["description"] = $doc["description"];
            $item["url"] = $doc["link"];
            $item["picUrl"] = isset($doc["img"]) ? $doc["img"] : "";
            $item['id'] = $doc["id"];
            $item['pubTime'] = date("Y-m-d H:i", $doc['pubTime']);
            $item['source'] = 'weworkremotely.com';
            $items[] = $item;
            if ($count >= $num - 1) {
                break;
            }
        }
        return $items;
    }
} 