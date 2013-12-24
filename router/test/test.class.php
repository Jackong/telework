<?php
namespace router\test;

use router\Router;
use util\Input;
use util\Log;

class Test extends Router {

	public function get() {
        Log::Notice("test get");
        return "hello jackong";
    }

	public function post() {
        Log::Notice("test post");
        return Input::get("param");
	}
}
