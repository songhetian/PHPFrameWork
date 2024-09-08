<?php

namespace app\controllers;

use app\core\Controller;

class siteController extends Controller {

    public function actionHome(): void {
        $params = [
            'name' => 'hesitating'
        ];
        echo $this->render('home', $params);
    }

    public function actionContact(): int {
        return 1123;
    }

    public function handelContact(): string {
        return "post";
    }

}