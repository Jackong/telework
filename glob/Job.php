<?php
/**
 * User: daisy
 * Date: 13-12-28
 * Time: 下午12:36
 */

namespace glob;


use glob\config\source\_37Signals;

class Job {
    public static function huntJobText() {
        $categories = "";
        foreach (_37Signals::get('categories') as $category => $info) {
            if (isset($info["support"]) && !$info["support"]) {
                continue;
            }
            $categories .= $category . "：" . $info["lang"][1] . "\n";
        }
        return "\n请选择你的职业领域并回复相应数字：\n职业领域：\n"
        . $categories
        . "\n如：想找 编程开发 领域的职位，则回复\"2\"\n"
        . "反馈请直接回复，谢谢。自由人：http://telework.duapp.com";
    }
} 