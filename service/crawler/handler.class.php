<?php
/**
 * User: daisy
 * Date: 13-12-28
 * Time: 上午9:36
 */

namespace service\crawler;


interface Handler {
    public function handle($data, $info);
}