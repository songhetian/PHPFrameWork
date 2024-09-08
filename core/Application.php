<?php

namespace app\core;

class Application {
    public static string      $ROOT_DIR;
    public static Application $app;
    public Router             $router;
    public Request            $request;
    public Response           $response;

    public function __construct($rootPath) {

        $this->request  = new Request();
        $this->response = new Response();
        $this->router   = new Router($this->request, $this->response);
        self::$app      = $this;
        self::$ROOT_DIR = str_replace('\\', '/', $rootPath);
    }

    public function run(): void {
        echo $this->router->resolve();
    }
}