<?php
/**
 * User: daisy
 * Date: 14-1-16
 * Time: 下午8:38
 */

namespace common;

class Logger {
    private $writer;
    private $level;
    public function __construct(Writer $writer, $level = 16) {
        $this->writer = $writer;
        $this->level = $level;
    }

    public function output($level, $messages) {
        if ($level > $this->level) {
            return;
        }
        @list(, , $caller) = debug_backtrace();
        $msgStr = "";
        foreach ($messages as $message) {
            $msgStr .= "|$message";
        }
        $class = isset($caller['class']) ? $caller['class'] : 'nilClass';
        $func = isset($caller['function']) ? $caller['function'] : 'nilFunc';
        $msg = sprintf("%d %s - %s:%s%s\n", $level, NOW, $class, $func, $msgStr);
        $this->writer->write($level, $msg);
    }
} 
