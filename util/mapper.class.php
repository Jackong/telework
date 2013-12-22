<?php
/**
 * User: daisy
 * Date: 13-12-21
 * Time: 下午8:58
 */

namespace util;

use common\Exception;

class Mapper {
    public static function handle($url, $method) {
        try {
            list($path) = explode("?", $url);
            list(, $routerDir, $routerName) = explode("/", $path);
            $routerClass = "\\router\\$routerDir\\$routerName";
            $router = new $routerClass();
            $invoke = strtolower($method);
            $response = $router->$invoke();
        } catch (Exception $e) {
            $response = array("code" => $e->getCode(), "msg" => $e->getMessage());
        }
        return $response;
    }
}