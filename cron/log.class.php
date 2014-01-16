<?php
/**
 * User: daisy
 * Date: 13-12-28
 * Time: 上午10:17
 */

namespace cron;


use common\Logger;

class Log extends Logger {
    public static function file() {
        return  "/home/bae/log/cron.log";
    }

} 