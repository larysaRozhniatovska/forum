<?php

namespace app\controllers;
use app\core\AbstractController;

class IndexController extends AbstractController
{
    public function index(): void
    {
        $this->view->render('index', [
            'title' => 'Sign In',
        ]);
    }



}