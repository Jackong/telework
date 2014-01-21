<?php
/**
 * User: daisy
 * Date: 13-12-22
 * Time: 下午7:11
 */

namespace util;

use Slim\Slim;

class Input {

    public static function get($name, $pattern = null, $default = null) {
        if (!isset($_REQUEST[$name])) {
            if (is_null($default)) {
                Slim::getInstance()->halt(400, "invalid parameter $name");
            }
            return $default;
        }
        $value = $_REQUEST[$name];
        if (!empty($value) && is_null($pattern)) {
            return $value;
        }
        if (empty($value)) {
            Slim::getInstance()->halt(400, "invalid parameter $name");
        }
        if (preg_match($pattern, $value, $matches)) {
            return $value;
        }
        Slim::getInstance()->halt(400, "invalid parameter $name");
    }
}