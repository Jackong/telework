<?php
/**
 * User: daisy
 * Date: 13-12-21
 * Time: 下午9:45
 */

namespace common;


use common\formatter\Json;
use common\formatter\Xml;

class Factory {
    /**
     * @param $accept
     * @return Formatter
     */
    public static function formatter($accept) {
        if (false !== strpos("application/xml", $accept)) {
            return new Xml();
        }
        return new Json();
    }
} 