<?php
/**
 * User: daisy
 * Date: 14-1-5
 * Time: 下午8:37
 */

namespace router\light;


use router\Router;
use service\Job;

class App extends Router {
    public function get() {
        $_SERVER["HTTP_ACCEPT"] = "text/html";
        $job = new Job();
        $items = $job->gets(2, 4);
        return array(
            "light/app",
            array(
                "items" => $items,
            )
        );
    }

} 