<?php

namespace app\controllers;

use app\core\AbstractController;
use app\core\Validators;

class UserController extends AbstractController
{

    protected $titleIndex = 'Sign In';

    public function index(): void
    {

    }
    /**
     * sign Out sign out of mode admin
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function signOutUser(): void
    {
        $this->session->delete('login');
        $this->view->render('index', [
            'title' => $this->titleIndex,
        ]);
    }



    /**
     *  UserController login
     *   data reading, validation and saving
     *    Redirect to themes.php || or on error /index.php
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function loginUser() : void
    {
        $data = [
            'login' => filter_input(INPUT_POST, 'login'),
            'password' => filter_input(INPUT_POST, 'pass'),
        ];
        $strError = conf('ERROR_LOGIN');
        $error = Validators::validateInfoUser($data);
        if (!$error) {
            $this->view->render('index', [
                'title' => $this->titleIndex,
                'errorsLogin' => $strError,
            ]);
        }else
        {
            $res = $this->userModel->validationLoginUser($data['login'], $data['password']);
            if ($res === false) {
                var_dump('res validator error',$res);
                $this->view->render('index', [
                    'title' => $this->titleIndex,
                    'errorsLogin' =>$strError,
                ]);
            } else {
                $this->session->write('login', $data['login']);
                $this->redirectToThemes($data['login']);
            }
        }

    }
    /**
     * User registration
     *  data reading, validation and saving
     *   Redirect to themes.php || or on error /index.php
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function addUser() : void
    {
        $data = [
            'login' => filter_input(INPUT_POST, 'reglogin'),
            'password' => filter_input(INPUT_POST, 'regpass'),
            'repassword' =>  filter_input(INPUT_POST, 'reregpass'),
        ];
        $strError = conf('ERROR_ADD');
        $error = Validators::validateInfoUser($data);
        if (!$error) {
            $this->view->render('index', [
                'title' => $this->titleIndex,
                'errorsAdd' => $strError,
            ]);
        }else
        {
            $res = $this->userModel->validationAddUser($data['login']);
            if ($res === false) {
                $this->view->render('index', [
                    'title' => $this->titleIndex,
                    'errorsAdd' => $strError,
                ]);
            }else {
                $res = $this->userModel->addUser($data['login'], $data['password']);
                //TODO  $res error add in db
                $this->session->write('login', $data['login']);
                $this->redirectToThemes($data['login']);
            }
        }
    }

}