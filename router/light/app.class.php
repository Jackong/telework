<?php
/**
 * User: daisy
 * Date: 14-1-5
 * Time: 下午8:37
 */

namespace router\light;


use common\Template;
use router\Router;
use service\Job;
use util\Input;

class App extends Router {
    public function get() {
        $_SERVER["HTTP_ACCEPT"] = "text/html";
        $job = new Job();
        $items = $job->gets(2, 10);
        $jobs = new Template("light/jobs", array("items" => $items));
        return array(
            "light/app",
            array(
                "jobs" => $jobs,
            )
        );
    }

} 