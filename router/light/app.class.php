<?php
/**
 * User: daisy
 * Date: 14-1-5
 * Time: 下午8:37
 */

namespace router\light;


use common\Template;
use glob\config\Loader;
use router\Router;
use service\Job;
use util\Input;
use util\Log;

class App extends Router {
    public function get() {
        $_SERVER["HTTP_ACCEPT"] = "text/html";

        Log::Trace($_SERVER["REMOTE_ADDR"], $_SERVER['HTTP_USER_AGENT']);
        $job = new Job();
        $items = $job->gets(2, 10);
        $jobs = new Template("light/jobs", array("items" => $items));
        $categories = Loader::load("source._37signals|categories");
        foreach ($categories as $id => $category) {
            $categories[$id] = $category["lang"][1];
        }

        return array(
            "light/app",
            array(
                "categories" => $categories,
                "jobs" => $jobs,
                "tips" => ''
            )
        );
    }

} 