<?php
namespace common;
class Router {
    public function __construct() {
        $this->status();
    }

    public function input($name, $pattern = null, $default = null) {
        if (!isset($_REQUEST[$name])) {
            if (is_null($default)) {
                $this->status(404);
                throw new Exception("invalid parameter $name", Exception::INVALID_INPUT);
            }
            return $default;
        }
        $value = $_REQUEST[$name];
        if (is_null($pattern)) {
            return $value;
        }
        if (preg_match($pattern, $value, $matches)) {
            return $value;
        }
        $this->status(404);
        throw new Exception("invalid parameter $name", Exception::INVALID_INPUT);
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
