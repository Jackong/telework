<?php
/**
 * User: daisy
 * Date: 13-12-21
 * Time: 下午8:58
 */

namespace common;


class Mapper {
    public function handle($url, $method) {
        try {
            $response = $this->route($url, $method);
        } catch (Exception $e) {
            $response = array("code" => $e->getCode(), "msg" => $e->getMessage());
        }
        return $response;
    }

    private function route($url, $method) {
        list($path) = explode("?", $url);
        list(, $routerDir, $routerName) = explode("/", $path);
        $routerClass = "\\router\\$routerDir\\$routerName";
        $router = new $routerClass();
        $invoke = strtolower($method);
        return $router->$invoke();
    }
}