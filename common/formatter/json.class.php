<?php
/**
 * User: daisy
 * Date: 13-12-21
 * Time: 下午9:56
 */

namespace common\formatter;


use common\Formatter;

class Json implements Formatter{
    public function output($content) {
        if (is_array($content) || is_object($content)) {
            echo json_encode($content);
            return;
        }
        echo $content;
    }

} 