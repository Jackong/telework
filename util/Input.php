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
        $app = Slim::getInstance();
        $request = array_merge($_REQUEST, json_decode($app->request()->getBody(), true));
        if (!isset($request[$name])) {
            if (is_null($default)) {
                static::invalid($app, $name);
            }
            return $default;
        }
        $value = $request[$name];
        if (!empty($value) && is_null($pattern)) {
            return $value;
        }
        if (empty($value)) {
            static::invalid($app, $name);
        }
        if (preg_match($pattern, $value, $matches)) {
            return $value;
        }
        static::invalid($app, $name);
    }

    private static function invalid(Slim $app, $name) {
        $msg = "invalid parameter $name";
        $request = $app->request();
        Log::Warning($request->getIp(), $request->getUserAgent(), $request->getResourceUri(), $msg);
        $app->halt(400, $msg);
    }
}