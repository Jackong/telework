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
use util\Output;

class Entry {
    const TOKEN = "RemoteWork";

    public function check() {
        if ($this->checkSign()) {
            Output::set(Input::get("echostr"));
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
        $myId = Input::get('ToUserName', "/^(" . Handler::MYID .")$/");
        $type = Input::get('MsgType');
        if ($myId != Handler::MYID) {
            Log::Warning($myId, Handler::MYID, $type);
            return;
        }

        $hndName = "\\service\\wechat\\telework\\" . ucfirst($type);
        /**
         * @var $handler \service\wechat\Handler
         */
        $handler = new $hndName();
        if ($handler->needCheck() && !$this->checkSign()) {
            return;
        }
        $env = Slim::getInstance()->environment();
        Output::set($handler->handle($env['slim.input']));
    }

}

$entry = new Entry();
Slim::getInstance()->get('/entry', array($entry, 'check'));
Slim::getInstance()->post('/entry', array($entry, 'interact'));