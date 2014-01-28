<?php
/**
 * User: daisy
 * Date: 14-1-27
 * Time: 下午3:20
 */

namespace util;

class Output {
    const CODE_OK = 0;
    const CODE_FAILURE = 1;

    private static $content = array();

    public static function set($content, $replace = false) {
        if ($replace) {
           static::$content = $content;
        } else {
            if (!is_array($content)) {
                $content = array('data' => $content);
            }
            static::$content = array_merge(static::$content, $content);
        }
    }

    public static function ok($msg = null) {
        static::result($msg, self::CODE_OK);
    }

    public static function error($msg = null, $code = self::CODE_FAILURE) {
        static::result($msg, $code);
    }

    private static function result($msg, $code) {
        static::set(array('code' => $code));
        if (!is_null($msg)) {
            static::set(array('msg' => $msg));
        }
    }

    public static function get() {
        return static::$content;
    }
} 