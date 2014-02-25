<?php
/**
 * User: daisy
 * Date: 14-1-20
 * Time: 上午8:44
 */

namespace router\light;


use Slim\Slim;
use util\Input;
use util\Log;
use util\Mongo;
use util\Output;

class Feedback {
    public function submit() {
        $contact = Input::get('contact', '/[0-9]{4,11}|([\w\-]+\@[\w\-]+\.[\w\-]+)/', "匿名");
        $content = Input::get('content', '/(.+?){5,255}/');
        Mongo::user('feedback')->insert(array(
            'contact' => $contact,
            'content' => $content,
        ));
        Log::Notice($_SERVER['REMOTE_ADDR'],  $_SERVER['HTTP_USER_AGENT'], $_SERVER['HTTP_REFERER']);
        Output::ok();
    }
}

Slim::getInstance()->post('/feedback', array(new Feedback(), 'submit'));