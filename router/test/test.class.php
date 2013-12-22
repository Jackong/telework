<?php
namespace router\test;

use common\Router;

class Test extends Router {

	public function get() {
		return "hello jackong";
	}

	public function post() {
		return $this->input("param");
	}
}
