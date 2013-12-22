<?php
/**
 * User: daisy
 * Date: 13-12-22
 * Time: 下午7:11
 */

namespace util;

use common\Exception;

class Input {

    public static function get($name, $pattern = null, $default = null) {
        if (!isset($_REQUEST[$name])) {
            if (is_null($default)) {
                throw new Exception("invalid parameter $name", Exception::INVALID_INPUT);
            }
            return $default;
        }
        $value = $_REQUEST[$name];
        if (is_null($pattern)) {
            return $value;
        }
        if (preg_match($pattern, $value, $matches)) {
            return $value;
        }
        throw new Exception("invalid parameter $name", Exception::INVALID_INPUT);
    }
}