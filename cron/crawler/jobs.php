<?php
/**
 * User: daisy
 * Date: 13-12-28
 * Time: 上午9:16
 */
require_once __DIR__ . '/../env.php';

class Handler implements \service\crawler\Handler {
    public function handle($data, $category) {
        $info = \glob\config\source\_37Signals::get('categories', $category, 'lang');
        $jobsXml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
        $channel = $jobsXml->channel;
        if (!$this->checkTitle($channel->title, $info[0])) {
            return;
        }
        $this->collect($category, $channel->item);
    }

    private function collect($category, $items) {
        \util\Log::Trace($category, "the number of items are found", count($items));
        $jobs = \util\Mongo::job("jobs");
        $count = 0;
        foreach ($items as $item) {
            if (!isset($item->guid) || !isset($item->title) || !isset($item->description)) {
                \util\Log::Warning($category, "bad data for job", json_encode($item));
                continue;
            }
            $guid = (string) $item->guid;
            $title = (string) $item->title;
            $content = (string) $item->description;
            $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');
            $link = (string) $item->link;
            $pubTime = strtotime((string) $item->pubDate);
            $img = $this->getImg($content);
            $id = md5($guid);
            $jobs->update(
                array(
                'id' => $id,
                ),
                array(
                    "id" => $id,
                    "category" => $category,
                    "title" => $title,
                    "content" => $content,
                    "link" => $link,
                    "img" => $img,
                    "pubTime" => $pubTime,
                    "time" => TIME,
                ),
                array(
                    "upsert" => true
                )
            );
            $count++;
        }
        \util\Log::Trace($category, "the number of items are collected", $count);
    }

    private function getImg($content) {
        if (preg_match("/<img.+?src=\"(.+?)\"/", $content, $matches)) {
            return $matches[1];
        }
        return "";
    }

    private function checkTitle($title, $enInfo) {
        \util\Log::Trace($enInfo, $title);
        if (strpos($title, $enInfo) === false) {
            \util\Log::Warning($enInfo, $title);
            return false;
        }
        return true;
    }
}

$crawler = new \service\crawler\Crawler(new Handler());

$_37signals = \glob\config\source\_37Signals::get();
foreach ($_37signals["categories"] as $category => $_) {
    $crawler->crawl($_37signals["host"] . "/categories/$category/jobs.rss", $category);
}

