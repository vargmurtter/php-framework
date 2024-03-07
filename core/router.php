<?php

class Router
{
    private string $default_key;
    private array $routes = array();

    function __construct(string $default_key = "home")
    {
        $this->default_key = $default_key;
    }

    public function bind(string|null $uri, callable $view_method): void 
    {
        $this->routes[$uri] = $view_method;
    }

    public function route(): void 
    {
        $request_uri = $_SERVER['REQUEST_URI'];
        $request = mb_split('/', $request_uri);
        $key = $request[1];
        if (empty($key)) $key = $this->default_key;
        $params = array_slice($request, 2);
        if (!array_key_exists($key, $this->routes)) {
            $this->routes[null]($params);
        } else {
            $this->routes[$key]($params);
        }
    }
}

?>