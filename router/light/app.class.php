<?php
/**
 * User: daisy
 * Date: 14-1-5
 * Time: 下午8:37
 */

namespace router\light;


use router\Router;
use util\Log;

class App extends Router {
    public function get() {
        Log::Debug("entry to get");
        return array(
            "light/app",
            array(
                "text" => "hello light app"
            )
        );
    }

} 