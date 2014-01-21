<?php
/**
 * User: daisy
 * Date: 14-1-20
 * Time: 上午8:44
 */

namespace router\light;


use Slim\Slim;
use util\Input;
use util\Mongo;

class Feedback {
    public function submit() {
        $contact = Input::get('contact', '/[0-9]{4,11}|([\w\-]+\@[\w\-]+\.[\w\-]+)/');
        $content = Input::get('content', '/(.+?){5,255}/');
        Mongo::user('feedback')->insert(array(
            'contact' => $contact,
            'content' => $content,
        ));
    }
}

Slim::getInstance()->post('/feedback', array(new Feedback(), 'submit'));