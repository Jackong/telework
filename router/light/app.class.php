<?php
/**
 * User: daisy
 * Date: 14-1-5
 * Time: 下午8:37
 */

namespace router\light;


use router\Router;

class App extends Router {
    public function get() {
        $_SERVER["HTTP_ACCEPT"] = "text/html";
        return array(
            "light/app",
            array(
                "text" => "hello light app"
            )
        );
    }

} 