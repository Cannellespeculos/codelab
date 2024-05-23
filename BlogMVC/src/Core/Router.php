<?php
namespace Cannelle\BlogMvc\Core;

class Router {

    private $url;
    private $routes = [];

    function __construct($url) {
        $this->url = $url;
    }

    function get($path, $callable) {
        $route = new Route($path, $callable);
        $this->routes['GET'][] = $route;
        return $route;

    }

    function post($path, $callable) {
        $route = new Route($path, $callable);
        $this->routes['POST'][] = $route;
        return $route;
    }
}
?>