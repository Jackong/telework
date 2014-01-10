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
        $main = Input::get("main", "/^(hunt|recruit)$/", "hunt");
        if ($main == "hunt") {
            $job = new Job();
            $items = $job->gets(2, 12);
            $mainTpl = new Template("light/hunt", array("items" => $items));
        } else {
            $mainTpl = new Template("light/recruit");
        }

        $sign = new Template("sign");
        return array(
            "light/app",
            array(
                "sign" => $sign,
                "main" => $mainTpl,
            )
        );
    }

} 