<?php

namespace app\core;
//use app\models\Note;

use app\core\Session;

abstract class AbstractController implements controllable
{
//    protected $model;
    public View $view;
    protected Session $session;
    public function __construct()
    {
        $this->view = new View();
        $this->session = new Session();
//        $this->model = new Note();
    }
}