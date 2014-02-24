<?php
/**
 * User: daisy
 * Date: 14-1-9
 * Time: 上午9:58
 */

namespace service;


use util\Mongo;

class Job {
    public function gets($category, $num, $after = 0) {
        $jobs = Mongo::job("jobs");
        $cursor = $jobs->find(
            array(
                "category" => new \MongoInt32($category),
            ),
            array(
                "title" => true,
                "pubTime" => true,
                "link" => true,
                "img" => true,
                "id" => true,
            )
        )->sort(array("pubTime" => -1));
        $items = array();
        foreach ($cursor as $doc) {
            if ($after > 0 && $doc['pubTime'] < $after) {
                continue;
            }
            $id = $doc['id'];
            $count = count($items);
            $item["title"] = $doc["title"];
            $item["url"] = "http://telework.duapp.com/#/jobs/$category/$id";
            $item["picUrl"] = isset($doc["img"]) ? $doc["img"] : "";
            $item['id'] = $id;
            $item['pubTime'] = date("Y-m-d H:i", $doc['pubTime']);
            $item['source'] = 'weworkremotely.com';
            $items[] = $item;
            if ($count >= $num - 1) {
                break;
            }
        }
        return $items;
    }

    public function get($id) {
        $jobs = Mongo::job('jobs');
        return $jobs->findOne(
            array('id' => $id),
            array(
                'title' => true,
                'content' => true,
                'pubTime' => true,
            )
        );
    }
} 