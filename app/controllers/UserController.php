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
        $login = filter_input(INPUT_POST, 'login');
        if(!empty($login)) {
            $login = trim($login);
            $login = strip_tags($login);
            $login = stripcslashes($login);
            $login = htmlspecialchars($login);
        }
        $password = filter_input(INPUT_POST, 'pass');
        if(!empty($password)) {
            $password = trim($password);
            $password = strip_tags($password);
            $password = stripcslashes($password);
            $password = htmlspecialchars($password);
        }
        $data = [
            'login' => $login,
            'password' => $password,
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
                $this->redirectToTheme($data['login']);
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
        $login = filter_input(INPUT_POST, 'reglogin');
        if(!empty($login)) {
            $login = trim($login);
            $login = strip_tags($login);
            $login = stripcslashes($login);
            $login = htmlspecialchars($login);
        }
        $password = filter_input(INPUT_POST, 'regpass');
        if(!empty($password)) {
            $password = trim($password);
            $password = strip_tags($password);
            $password = stripcslashes($password);
            $password = htmlspecialchars($password);
        }
        $repassword = filter_input(INPUT_POST, 'reregpass');
        if(!empty($repassword)) {
            $repassword = trim($repassword);
            $repassword = strip_tags($repassword);
            $repassword = stripcslashes($repassword);
            $repassword = htmlspecialchars($repassword);
        }
        $data = [
            'login' => $login,
            'password' => $password,
            'repassword' => $repassword,
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
                $this->redirectToTheme($data['login']);
            }
        }
    }

}