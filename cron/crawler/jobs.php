<?php
/**
 * User: daisy
 * Date: 13-12-28
 * Time: 上午9:16
 */

require_once __DIR__ . "/../../bootstrap.php";

class Handler implements \service\crawler\Handler {
    public function handle($data, $category) {
        $info = _37Signals::$categories[$category];
        $jobsXml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
        $channel = $jobsXml->channel;
        if (!$this->checkTitle($channel->title, $info[0])) {
            return;
        }
        $this->collect($category, $channel->item);
    }

    private function collect($category, $items) {
        \cron\Log::Trace($category, "the number of items will be collected", count($items));
        $jobs = \util\Mongo::job("jobs");
        $actual = 0;
        foreach ($items as $item) {
            if (!isset($item->guid) || !isset($item->title) || !isset($item->description)) {
                \cron\Log::Warning($category, "bad data for job", json_encode($item));
                continue;
            }
            $jobs->update(
                array("guid" => (string) $item->guid),
                array(
                    "category" => $category,
                    "title" => (string) $item->title,
                    "description" => (string) $item->description,
                    "link" => (string) $item->link,
                    "time" => (string) $item->pubDate,
                ),
                array("upsert" => true)
            );
            $actual++;
        }
        \cron\Log::Trace($category, "the number of items are collected actually", $actual);
    }

    private function checkTitle($title, $enInfo) {
        \cron\Log::Trace($enInfo, $title);
        if (strpos($title, $enInfo) === false) {
            \cron\Log::Warning($enInfo, $title);
            return false;
        }
        return true;
    }
}

$crawler = new \service\crawler\Crawler(new Handler());

foreach (_37Signals::$categories as $category => $info) {
    $crawler->crawl(_37Signals::$host . "/categories/$category/jobs.rss", $category);
}

