<?php
/**
 * User: daisy
 * Date: 13-12-21
 * Time: 下午9:45
 */

namespace util;


use common\formatter\Json;
use common\formatter\Text;
use common\formatter\Xml;
use common\Formatter;

class Factory {
    /**
     * @param $accept
     * @return Formatter
     */
    public static function formatter($accept) {
        Log::Debug($accept);
        if (false !== strpos($accept, "text/html") || false !== strpos($accept, "text/javascript")) {
            return new Text();
        }
        if (false !== strpos($accept, "application/xml")) {
            return new Xml();
        }
        return new Json();
    }
} 