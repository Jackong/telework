<?php
/**
 * User: daisy
 * Date: 13-12-24
 * Time: 下午8:56
 */

namespace router\wechat;


use router\Router;
use util\Input;

class Entry extends Router {
    const TOKEN = "RemoteWork";
    public function get() {
        $echostr = Input::get("echostr");
        $signature = Input::get("signature");
        $timestamp = Input::get("timestamp");
        $nonce = Input::get("nonce");

        \Log::Trace("$echostr, $signature, $timestamp, $nonce");
        if ($this->checkSign($signature, $timestamp, $nonce)) {
            return $echostr;
        }
        return null;
    }

    private function checkSign($signature, $timestamp, $nonce) {
        $tmpArr = array(self::TOKEN, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        return $tmpStr == $signature;
    }
} 