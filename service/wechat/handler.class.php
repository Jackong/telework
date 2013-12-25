<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 上午9:12
 */

namespace service\wechat;



abstract class Handler {
    const MYID = "gh_299b93ffdf95";

    public abstract function handle(\SimpleXMLElement $subject);

    public function needCheck() {
        return false;
    }

    protected function text($userId, $content) {
        $tpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                </xml>";
        return sprintf($tpl, $userId, self::MYID, TIME, $content);
    }
} 