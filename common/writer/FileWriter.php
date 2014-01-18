<?php
/**
 * User: daisy
 * Date: 14-1-18
 * Time: 下午8:26
 */

namespace common\writer;


use common\Writer;

class FileWriter implements Writer{
    private $resource;

    public function __construct($file) {
        $this->resource = fopen($file, 'a');
    }

    public function __destruct() {
        fclose($this->resource);
    }

    public function write($level, $message) {
        fwrite($this->resource, $message);
    }
} 