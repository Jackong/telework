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
        if (isset($_REQUEST[$name])) {
            $value = $_REQUEST[$name];
        } else {
            $env = $app->environment();
            $request = $env['slim.input'];
            $value = isset($request[$name]) ? $request[$name] : null;
        }
        if (is_null($value)) {
            if (is_null($default)) {
                static::invalid($app, $name);
            }
            return $default;
        }
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