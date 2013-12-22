<?php
namespace router\test;

use router\Router;
use util\Input;

class Test extends Router {

	public function get() {
		return "hello jackong";
	}

	public function post() {
		return Input::get("param");
	}
}
