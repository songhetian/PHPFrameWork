<?php

namespace app\core;

class Controller {
//    protected static Controller $controller;
//
//    public function __construct() {
//        self::$controller = $this;
//    }
//
//    public static function __callStatic(string $name, array $arguments) {
//        // TODO: Implement __callStatic() method.
//        $functionName = 'action'.ucfirst($name);
//        return call_user_func_array([self::$controller, $functionName], $arguments);
//    }

    public function render($view, $params): string {
        return Application::$app->router->renderView($view, $params);
    }
}