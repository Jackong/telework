<?php
namespace router\test;

use router\Router;
use util\Input;

class Test extends Router {

	public function get() {
        return "hello jackong";
    }

	public function post() {
        logger()->Debug("get param");
        return Input::get("param");
	}
}
