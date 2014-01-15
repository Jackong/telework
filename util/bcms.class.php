<?php
/**
 * User: daisy
 * Date: 14-1-15
 * Time: 下午10:49
 */

namespace util;

use glob\config\Loader;

require_once PROJECT . "/lib/service/bcms/Bcms.class.php";

class Bcms {
    private static $bcms;

    /**
     * @return \Bcms
     */
    public static function instance() {
        if (isset(static::$bcms)) {
            return static::$bcms;
        }
        $host = "bcms.api.duapp.com";
        $service = Loader::load("service");
        static::$bcms = new \Bcms($service["ak"], $service["sk"], $host);
        return static::$bcms;
    }

    public static function mail($subject, $body, array $to, $from = "service@telework.com") {
        $bcms = self::instance();
        $ret = $bcms->mail("a532ac7436c3b7003791b4d2f9d0153b", $body, $to, array(
            \Bcms::MAIL_SUBJECT => $subject,
        ));
        if ($ret === false) {
            Log::Warning($bcms->getRequestId(), $bcms->errno(), $bcms->errmsg());
            return false;
        }
        return true;
    }
} 