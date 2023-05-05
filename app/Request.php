<?php

namespace App;

class Request
{
    public string $method;
    public $entityBody;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->entityBody = file_get_contents('php://input');
    }

    public function get($key, $default = null)
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }

    public function post($key, $default = null)
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    public function all()
    {
        return array_merge($_GET, $_POST);
    }

    public function has($key)
    {
        return isset($_GET[$key]) || isset($_POST[$key]);
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function path()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}