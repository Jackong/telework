<?php
/**
 * User: daisy
 * Date: 13-12-28
 * Time: 上午9:16
 */

require_once __DIR__ . "/../../bootstrap.php";

class Handler implements \service\crawler\Handler {
    public function handle($data, $category) {
        $info = \glob\config\source\_37Signals::$categories[$category]["lang"];
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
        $jobList = array();
        foreach ($items as $item) {
            if (!isset($item->guid) || !isset($item->title) || !isset($item->description)) {
                \cron\Log::Warning($category, "bad data for job", json_encode($item));
                continue;
            }
            $guid = (string) $item->guid;
            $title = (string) $item->title;
            $content = (string) $item->description;
            $link = (string) $item->link;
            $pubTime = strtotime((string) $item->pubDate);
            $description = $this->getDescription($content);
            $id = md5($guid);
            $jobs->update(
                array("id" => $id,),
                array(
                    "id" => $id,
                    "category" => $category,
                    "title" => $title,
                    "description" => $description,
                    "link" => $link,
                    "pubTime" => $pubTime,
                    "time" => TIME,
                ),
                array("upsert" => true)
            );
            $jobList[$id] = array(
                "title" => $title,
                "content" => $content,
                "link" => $link,
                "pubTime" => $pubTime,
            );
        }
        $this->upload2Bcs($category, $jobList);
        \cron\Log::Trace($category, "the number of items are collected actually", count($jobList));
    }

    private function getDescription($content) {
        $description = "";
        if (preg_match("/<div>(.+?)<\\/div>/", $content, $matches)) {
            $description = (preg_replace("/(<.+?>).+?(<\\/.+?>)/", "", $matches[1])) . "\n";
        }
        return $description;
    }

    private function upload2Bcs($category, $jobs) {
        $bcs = \util\Bcs::instance();
        $opt["acl"] = \BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_READ;
        $opt ['curlopts'] = array (
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 1800 );
        foreach ($jobs as $id => $job) {
            if (false == file_put_contents(PROJECT . "/static/job.html", $job["content"])) {
                \cron\Log::Warning($category, $id, "can not put content to file");
                continue;
            }
            $response = $bcs->create_object(
                "telework-jobs",
                "/$id.html",
                PROJECT . "/static/job.html",
                $opt
            );
            if (!$response->isOK()) {
                \cron\Log::Warning($category, $id, "bcs can not create object");
            }
        }

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

foreach (\glob\config\source\_37Signals::$categories as $category => $_) {
    $crawler->crawl(\glob\config\source\_37Signals::$host . "/categories/$category/jobs.rss", $category);
}

