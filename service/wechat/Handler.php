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

    protected function news($userId, $items) {
        $tpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[news]]></MsgType>
                    <ArticleCount>%s</ArticleCount>
                    <Articles>
                    %s
                    </Articles>
                </xml>";
        $articles = "";
        $itemTpl = "<item>
                        <Title><![CDATA[%s]]></Title>
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                    </item>";
        foreach ($items as $item) {
            $articles .= sprintf($itemTpl, $item["title"], $item["content"], $item["picUrl"], $item["url"]);
        }

        return sprintf($tpl, $userId, self::MYID, TIME, count($items), $articles);
    }
} 