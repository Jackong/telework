<?php
namespace router\test;

use router\Router;
use util\Bcs;
use util\Input;
use util\Log;

class Test extends Router {

	public function get() {
        Log::Notice("test get");
        $body = Input::get("body");
        return array(
            "test",
            array(
                "title" => "php tpl",
                "body" => $body,
                "method" => "get"
            )
        );
    }

	public function post() {
        Log::Notice("test post");
        $body = Input::get("body");
        return array(
            "test",
            array(
                "title" => "php tpl",
                "body" => $body,
                "method" => "post"
            )
        );
	}
}
