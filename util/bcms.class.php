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
        $config = Loader::load('service|bcms');
        static::$bcms = new \Bcms($config["accessKey"], $config["secretKey"], $config['host']);
        return static::$bcms;
    }

    public static function mail($subject, $body, array $to, $from = "no-reply@telework.com") {
        $bcms = self::instance();
        $ret = $bcms->mail(Loader::load('service|bcms.queues.mail'), $body, $to, array(
            \Bcms::MAIL_SUBJECT => $subject,
            \Bcms::FROM => $from,
        ));
        if ($ret === false) {
            Log::Warning($bcms->getRequestId(), $bcms->errno(), $bcms->errmsg());
            return false;
        }
        return true;
    }
} 