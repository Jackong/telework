<?php
/**
 * User: daisy
 * Date: 14-2-8
 * Time: 下午5:04
 */

namespace util;


use glob\config\Service;

class Mail {
    public static function confirm($body, $to) {
        return static::sendCloud("自由人远程职位订阅确认", $body, $to);
    }

    public static function publish($body, array $to) {
       return static::mail(Service::get('bcms', 'queues', 'subscription'), '最新自由人远程职位', $body, $to);
    }

    public static function mail($id, $subject, $body, array $to, $from = "no-reply@telework.ws") {
        $bcms = Bcms::instance();
        $ret = $bcms->mail($id, "<!--HTML-->$body", $to, array(
            \Bcms::MAIL_SUBJECT => $subject,
            \Bcms::FROM => $from,
        ));
        if ($ret === false) {
            Log::Warning($bcms->getRequestId(), $bcms->errno(), $bcms->errmsg());
            return false;
        }
        return true;
    }

    public static function sendCloud($subject, $body, $to) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_URL, 'https://sendcloud.sohu.com/webapi/mail.send.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            array('api_user' => 'postmaster@confirm.sendcloud.org',
                'api_key' => 'N1QOPH9q',
                'from' => 'no-reply@telework.ws',
                'fromname' => '自由人',
                'to' => $to,
                'subject' => $subject,
                'html' => $body,
            )
        );

        $result = curl_exec($ch);

        if($result === false) {
            Log::Warning(curl_error($ch));
        }

        curl_close($ch);

        return $result;
    }
} 