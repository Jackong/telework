<?php
/**
 * User: daisy
 * Date: 14-1-27
 * Time: 下午3:36
 */

namespace common\middleware;


use Slim\Middleware;
use util\Output;

class Response extends Middleware {

    /**
     * @var array
     */
    protected $parsers;
    protected $default;
    /**
     * Constructor
     * @param $default
     * @param array $parsers
     */
    public function __construct($default, $parsers = array())
    {
        $this->default = $default;
        $this->parsers = array_merge($parsers);
    }

    /**
     * Call
     *
     * Perform actions specific to this middleware and optionally
     * call the next downstream middleware.
     */
    public function call()
    {
        $app = $this->app;

        // Run inner middleware and application
        $this->next->call();
        $mediaType = $app->request()->getMediaType();
        $response = $app->response();
        $parser = $this->parser($mediaType);
        $response->setBody($parser->parse(Output::get()));
        $response->header("Content-Type", $mediaType);
    }

    /**
     * @param $mediaType
     * @return \common\Parser
     */
    private function parser($mediaType) {
        $handler = isset($this->parsers[$mediaType]) ? $this->parsers[$mediaType] : $this->default;
        return $handler();
    }

} 