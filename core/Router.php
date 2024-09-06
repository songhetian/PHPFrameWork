<?php

namespace app\core;

class Router {

    protected array $routes = [];
    private Request $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function get(string $path, $callback): void {

        $this->routes['get'][$path] = $callback;
    }

    public function resolve(): void {
        $method = $this->request->getMethod();
        $path   = $this->request->getPath();

        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            echo 'Not Found';
            exit;
        }

        echo call_user_func($callback);
    }
}