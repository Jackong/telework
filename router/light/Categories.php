<?php
/**
 * User: daisy
 * Date: 14-1-28
 * Time: 上午10:15
 */

namespace router\light;


use glob\config\source\_37Signals;
use Slim\Slim;
use util\Output;

class Categories {
    public function all() {
        $categories = array();
        foreach (_37Signals::get('categories') as $id => $category) {
            $categories[] = array('id' => $id, 'name' => $category['lang'][1]);
        }

        Output::set(array('categories' => $categories));
        Output::ok();
    }
}

Slim::getInstance()->get('/categories', array(new Categories(), 'all'));