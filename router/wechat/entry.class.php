<?php
/**
 * User: daisy
 * Date: 13-12-24
 * Time: 下午8:56
 */

namespace router\wechat;


use router\Router;
use util\Input;
use util\Log;

class Entry extends Router {
    const TOKEN = "RemoteWork";

    public function get() {
        if ($this->checkSign()) {
            return Input::get("echostr");
        }
        return null;
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

    public function post() {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        Log::Trace($postStr);
        //extract post data
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $hndName = "\\service\\wechat\\telework\\" . ucfirst($postObj->MsgType);
            /**
             * @var $handler \service\wechat\Handler
             */
            $handler = new $hndName();
            if ($handler->needCheck() && !$this->checkSign()) {
                return null;
            }
            return $handler->handle($postObj);
        }
        return null;
    }

} 