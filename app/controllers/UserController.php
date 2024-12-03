<?php

namespace app\controllers;

use app\core\AbstractController;
use app\models\User;
use app\models\Theme;

class UserController extends AbstractController
{
    protected User $userModel;
    protected Theme $themeModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
        $this->themeModel = new Theme();
    }
    public function index(): void
    {

    }
    /**
     * UserController login
     *  data reading, validation and saving
     *   Redirect to note_page.php || or on error /index_page.php
     * @return void
     */
    public function loginUser() : void
    {
        $data = [
            'login' => filter_input(INPUT_POST, 'login'),
            'password' => filter_input(INPUT_POST, 'pass'),
        ];

//        if (empty($data['login'])) {
//            $this->response->render('index',[
//                'messageNoUser' => 'No user entered',
//            ]);
//        }else {
//            $res = $this->users->validationLoginUser($data['login'],$data['password']);
//            if (!empty($res)){
//                $this->response->render('index', ['errorsLogin' => $res]);
//            }else
             {
                $this->session->write('login', $data['login']);
               // $notes = $this->notesManager->notesUser($data['login']);
                $this->view->render('theme', [
                    'login' => $data['login'],
                    //'notes' => $notes,
                ]);
            }

    }

}