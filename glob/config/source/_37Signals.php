<?php
/**
 * User: daisy
 * Date: 13-12-28
 * Time: 上午9:50
 */
namespace glob\config\source;

use glob\config\Config;

class _37Signals extends Config{
    protected function prod() {
        return array(
            "host" => "https://weworkremotely.com",
            "categories" => array(
                "1" => array(
                    "lang" => array("Design", "设计"),
                ),
                "2" => array(
                    "lang" => array("Programming", "编程开发"),
                ),
                "3" => array(
                    "lang" => array("Business/Exec", "商务师"),
                ),
                "4" => array(
                    "lang" => array("Miscellaneous", "杂项"),
                ),
                "5" => array(
                    "lang" => array("Copywriter", "广告文字撰稿人"),
                ),
                "6" => array(
                    "lang" => array("System administration", "系统管理员"),
                ),
                "7" => array(
                    "lang" => array("Customer Service/Support", "客服支持"),
                ),
            ),
        );
    }
}