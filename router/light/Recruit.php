<?php
/**
 * User: daisy
 * Date: 14-1-5
 * Time: 下午8:37
 */

namespace router\light;


use Slim\Slim;
use util\Input;

class Recruit {
    public function post() {
        $company = Input::get('company');
        $homepage = Input::get('homepage');
        $logo = Input::get('logo', null, "");
        $category = Input::get('category');
        $position = Input::get('position');
        $description = Input::get('description');
        $delivery = Input::get('delivery');
    }
}

Slim::getInstance()->post('/recruit', array(new Recruit(), 'post'));