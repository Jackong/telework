<?php
/**
 * User: daisy
 * Date: 13-12-21
 * Time: 下午9:56
 */

namespace common\formatter;


use common\Formatter;

class Text implements Formatter{
    public function output($content) {
        echo $content;
    }

} 