<?php
/**
 * User: daisy
 * Date: 13-12-22
 * Time: 下午7:33
 */

namespace util;


use common\Logger;
use glob\config\Loader;

require_once PROJECT . "/lib/service/log/BaeLog.class.php";

class Log extends Logger {
    public static function file() {
        return "/home/bae/log/user.log";
    }

    public static function level() {
        return Loader::load("service|log.level");
    }
}