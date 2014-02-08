<?php
/**
 * User: daisy
 * Date: 14-2-8
 * Time: 下午5:04
 */

namespace util;


use glob\config\Service;

class Mail {
    public static function confirm($body, array $to) {
        return static::mail(Service::get('bcms', 'queues', 'confirm'), "自由人远程职位订阅确认", $body, $to);
    }

    public static function publish($body, array $to) {
        return static::mail(Service::get('bcms', 'queue', 'subscription'), '最新自由人远程职位', $body, $to);
    }

    public static function mail($id, $subject, $body, array $to, $from = "no-reply@telework.com") {
        $bcms = Bcms::instance();
        $ret = $bcms->mail($id, $body, $to, array(
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