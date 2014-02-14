<?php
/**
 * User: daisy
 * Date: 14-2-11
 * Time: 下午10:29
 */

namespace test;

class MailTest extends \PHPUnit_Framework_TestCase {

    public function testSendMail() {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_URL, 'https://sendcloud.sohu.com/webapi/mail.send.json');
        //不同于登录SendCloud站点的帐号，您需要登录后台创建发信子帐号，使用子帐号和密码才可以进行邮件的发送。
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            array('api_user' => 'postmaster@confirm.sendcloud.org',
                'api_key' => 'N1QOPH9q',
                'from' => 'from@sendcloud.org',
                'fromname' => 'SendCloud团队',
                'to' => '42528131@qq.org;jackongc@gmail.com;jerkong@163.com',
                'subject' => 'php 调用WebAPI测试主题',
                'html' => '欢迎使用<a href="https://sendcloud.sohu.com">SendCloud</a>',
            )
        );

        $result = curl_exec($ch);

        if($result === false) //请求失败
        {
            echo 'last error : ' . curl_error($ch);
        }

        curl_close($ch);

        return $result;
    }
}
 