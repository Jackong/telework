<?php
/**
 * User: daisy
 * Date: 13-12-24
 * Time: 下午8:56
 */

namespace router\wechat;


use service\wechat\Handler;
use Slim\Slim;
use util\Input;
use util\Log;

class Entry {
    const TOKEN = "RemoteWork";

    public function check() {
        if ($this->checkSign()) {
            echo Input::get("echostr");
        }
    }

    private function checkSign() {
        $echostr = Input::get("echostr");
        $signature = Input::get("signature");
        $timestamp = Input::get("timestamp");
        $nonce = Input::get("nonce");

        Log::Trace("$echostr, $signature, $timestamp, $nonce");
        $tmpArr = array(self::TOKEN, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        return $tmpStr == $signature;
    }

    public function interact() {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        Log::Trace($postStr);
        //extract post data
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            if (!isset($postObj->ToUserName) || $postObj->ToUserName != Handler::MYID) {
                return;
            }
            $hndName = "\\service\\wechat\\telework\\" . ucfirst($postObj->MsgType);
            /**
             * @var $handler \service\wechat\Handler
             */
            $handler = new $hndName();
            if ($handler->needCheck() && !$this->checkSign()) {
                return;
            }
            echo $handler->handle($postObj);
        }
    }

}

$entry = new Entry();
Slim::getInstance()->get('/entry', array($entry, 'check'));
Slim::getInstance()->post('/entry', array($entry, 'interact'));