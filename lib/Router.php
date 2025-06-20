<?php
class Router {
    private array $routes = [];

    public function add(string $method, string $path, callable $handler): void {
        $method = strtoupper($method);
        $this->routes[$method][$path] = $handler;
    }

    public function dispatch(string $method, string $path): void {
        $method = strtoupper($method);
        $path = '/' . trim($path, '/');
        if ($path === '/'){ $path = '/'; }
        if (isset($this->routes[$method][$path])) {
            call_user_func($this->routes[$method][$path]);
            return;
        }
        http_response_code(404);
        echo 'Not Found';
    }
}
