<?php
/**
 * User: daisy
 * Date: 13-12-21
 * Time: 下午9:56
 */

namespace common\formatter;


use common\Formatter;
use common\Template;

class Text implements Formatter{
    public function output($content) {
        if (is_array($content)) {
            list($tpl, $args) = $content;
            $template = new Template(
                $tpl,
                $args
            );
            $template->render();
            return;
        }
        echo $content;
    }

} 