<?php
/**
 * User: daisy
 * Date: 14-1-5
 * Time: 下午8:37
 */

namespace router\light;


use router\Router;
use util\Input;

class Subscription extends Router {
    public function post() {
        $email = Input::get("email");
        $position = Input::get("position");
        return "OK";
    }

} 