<?php
/**
 * User: daisy
 * Date: 13-12-21
 * Time: 下午9:56
 */

namespace common\parser;


use common\Parser;

class Json implements Parser{
    public function encode($content) {
        if (!is_array($content) && !is_object($content)) {
            $content = array('data' => $content);
        }
        return json_encode($content);
    }

    public function decode($content) {

    }
} 