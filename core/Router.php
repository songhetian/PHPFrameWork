<?php

namespace app\core;

class Router {

    public Request  $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response) {
        $this->request  = $request;
        $this->response = $response;
    }

    public function get(string $path, $callback): void {

        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback): void {

        $this->routes['post'][$path] = $callback;
    }

    public function resolve(): mixed {
        $method = $this->request->getMethod();
        $path   = $this->request->getPath();

        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView('_404');

        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
//        if (is_array($callback)) {
//            new $callback[0];
//        }
        //不用静态方法的方式
        if (is_array($callback)) {
            $callback[0] = new $callback[0];
            $callback[1] = $this->getMethod($callback[1]);
        }

        return call_user_func($callback);
    }

    private function getMethod($view): string {
        return 'action'.ucfirst($view);
    }

    public function renderView($view, $params): string {
        $layoutContent = $this->layoutContent();
        $viewContent   = $this->renderOnlyView($view, $params);
        return str_replace("{{content}}", $viewContent, $layoutContent);

    }

    protected function layoutContent(): false|string {
        ob_start();
        include_once Application::$ROOT_DIR."/views/layout/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params): false|string {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/".$view.".php";
        return ob_get_clean();
    }
}