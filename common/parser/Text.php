<?php
/**
 * User: daisy
 * Date: 14-1-28
 * Time: 下午2:22
 */

namespace common\parser;


use common\Parser;

class Text implements Parser {
    public function encode($content)
    {
        echo $content;
    }

    public function decode($content)
    {
        // TODO: Implement decode() method.
    }

} 