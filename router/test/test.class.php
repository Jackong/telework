<?php
namespace router\test;

use common\Router;

class Test extends Router {

	public function get() {
		return "hello daisy";
	}

	public function post() {
		return $this->input("param");
	}
}
