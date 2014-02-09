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

    const CODE_SUCCESS = 0;
    const CODE_INFO = 1;
    const CODE_WARNING = 2;
    const CODE_DANGER = 3;

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

    public static function success($msg) {
        static::tips($msg, static::CODE_SUCCESS);
    }

    public static function info($msg) {
        static::tips($msg, static::CODE_INFO);
    }

    public static function warning($msg) {
        static::tips($msg, static::CODE_WARNING);
    }

    public static function danger($msg) {
        static::tips($msg, static::CODE_DANGER);
    }

    public static function tips($msg, $type) {
        static::result($msg, $type);
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