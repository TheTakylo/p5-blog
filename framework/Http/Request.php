<?php

namespace Framework\Http;

use Framework\Http\DataRequest\GetRequest;
use Framework\Http\DataRequest\PostRequest;
use Framework\Http\DataRequest\ServerRequest;

class Request
{

    public $get;
    public $post;
    public $server;

    const ALLOWED_METHOD = ['POST', 'GET', 'PUT', 'DELETE'];

    public function __construct()
    {
        $this->get = new GetRequest($_GET);
        $this->post = new PostRequest($_POST);
        $this->server = new ServerRequest($_SERVER);
    }

    public function getPath()
    {
        return parse_url($this->server->get('REQUEST_URI'), PHP_URL_PATH) ?? '/';
    }

    public function getMethod()
    {
        if (!$this->server->has('REQUEST_METHOD')) {
            throw new \Exception('No request method found');
        }

        if ($method = $this->post->get('_method')) {
            if (in_array($method, Request::ALLOWED_METHOD)) {
                return $method;
            }
        }

        return $this->server->get('REQUEST_METHOD');
    }

    public function getReferer()
    {
        return $this->server->get('HTTP_REFERER');
    }

    static function all()
    {
        return new static();
    }

}