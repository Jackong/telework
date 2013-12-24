<?php
namespace router\test;

use router\Router;
use util\Input;

class Test extends Router {

	public function get() {
        return "hello jackong";
    }

	public function post() {
        \Log::Trace("good");
        return Input::get("param");
	}
}
