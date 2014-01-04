<?php
/**
 * User: daisy
 * Date: 14-1-4
 * Time: 下午2:35
 */

namespace common;


class Template {
    private $args;
    private $file;

    public function __get($name) {
        return $this->args[$name];
    }

    public function __construct($file, $args = array()) {
        $this->file = $file;
        $this->args = $args;
    }

    public function render() {
        include PROJECT . "/tpl/" . $this->file . ".php";
    }
} 