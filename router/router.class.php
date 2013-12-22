<?php
namespace router;
class Router {
    public function __construct() {
        $this->status();
    }

	public function get() {
        $this->status(405);
    }

	public function post() {
        $this->status(405);
    }

	public function put() {
        $this->status(405);
    }

	public function delete() {
        $this->status(405);
    }

    private function status($code = 200) {
        $status = array(
            200 => "OK",
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        $msg = isset($status[$code]) ? $status[$code] : $status[500];
        header("HTTP/1.1 $code $msg");
    }
}
