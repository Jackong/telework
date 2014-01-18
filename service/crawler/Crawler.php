<?php
/**
 * User: daisy
 * Date: 13-12-28
 * Time: 上午9:31
 */

namespace service\crawler;


class Crawler {
    private $handler;

    public function __construct(Handler $handler) {
        $this->handler = $handler;
    }

    public function crawl($url, $info) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);

        curl_close($ch);

        $this->handler->handle($output, $info);
    }
}