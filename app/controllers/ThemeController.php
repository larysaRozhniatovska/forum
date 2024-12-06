<?php

namespace app\controllers;

use app\core\AbstractController;
use DateTime;
use DateTimeZone;
class ThemeController extends AbstractController
{
    protected ?string $login;
    protected int $idUser = 0;
    public function __construct()
    {
        parent::__construct();
        $this->login = $this->session->get('login');
        if (!empty($this->login)) {
            $user = $this->userModel->getIdUser($this->login);
            if (!empty($user)) {
                $this->idUser = $user['id'];
            }
        }

    }

    /**
     * transferring data to the page and displaying themes.php
     * @return void
     * @throws \Exception
     */
    public function index() : void
    {
        $this->redirectToThemes($this->login);
    }
    /**
     * add Theme
     *  data reading, validation and saving
     *   Redirect to themes.php || or on error /index.php
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function addTheme() : void
    {
        $error = false;
        $title = filter_input(INPUT_POST, 'title');
        if (!empty($title)) {
            $title = stripcslashes($title);
            $title = htmlspecialchars($title, ENT_QUOTES);
        }else{
            $error = true;
        }
        $description = filter_input(INPUT_POST, 'description');
        if (!empty($description)) {
            $description = stripcslashes($description);
            $description = htmlspecialchars($description, ENT_QUOTES);
        }else{
            $error = true;
        }
        if(!$error){
            $data = [
                'title' => $title,
                'description' => $description,
                'idUser' => $this->idUser,
            ];
            //TODO validation
            $res = $this->themeModel->addTheme($data);
        }
        $this->backToThemes();
    }
    public function backToThemes() : void
    {
        $this->redirectToThemes($this->login);
    }
    /**
     * edit Theme
     *  data reading, validation and saving
     *   Redirect to theme.php
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function editTheme() : void
    {
        $idTheme = (int)filter_input(INPUT_POST, 'idEditTheme');
        if(!empty($idTheme)) {
            $theme = $this->themeModel->getAllById('themes',$idTheme);
            if($theme['user_id'] === $this->idUser) {
                $this->view->render('themesEdit', [
                    'title' => 'Edit Mess',
                    'theme' => $theme,
                ]);
            }else{
                $this->session->write('error', "You can't edit this theme");
                $this->backToThemes();
            }
        }



    }

    /**
     * update Theme from db
     *  data reading, validation and saving
     *   Redirect to theme.php
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function updateTheme() : void
    {
        $error = false;
        $idTheme = (int)filter_input(INPUT_POST, 'idTheme');
        $title = filter_input(INPUT_POST, 'title');
        if (!empty($title)) {
            $title = stripcslashes($title);
            $title = htmlspecialchars($title, ENT_QUOTES);
        }else{
            $error = true;
        }
        $description = filter_input(INPUT_POST, 'description');
        if (!empty($description)) {
            $description = stripcslashes($description);
            $description = htmlspecialchars($description, ENT_QUOTES);
        }else{
            $error = true;
        }
        if(!$error){
            $data = [
                'id' => $idTheme,
                'title' => $title,
                'description' => $description,
            ];
            //TODO validation
            $res = $this->themeModel->updateTheme($data);
        }
        $this->backToThemes();
    }

    /**
     * del Theme
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function delTheme() : void
    {
        $idTheme = (int)filter_input(INPUT_POST, 'idDelTheme');
        if(!empty($idTheme)) {
            $theme = $this->themeModel->getAllById('themes',$idTheme);
            if($theme['user_id'] === $this->idUser) {
                $res = $this->themeModel->delRow('themes', $idTheme);
            }else{
                $this->session->write('error', "You can't delete this theme");
            }
        }
        $this->backToThemes();
    }




    /**
     * select data & redirect to theme.php
     * @param string $idTheme
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    private function redirectToTheme(string $idTheme) : void
    {
        $theme = $this->themeModel->getAllById('themes',$idTheme);
        $messages = $this->themeModel->getMessagesOfTheme($idTheme);
        foreach ($messages as &$message) {
            $date = $message['created_at'];
            $date = new DateTime($date,  new DateTimeZone('UTC'));
            $date->setTimezone(new DateTimeZone(date_default_timezone_get()));
            $message['created_at']=$date->format('Y-m-d H:i:s');
        }
        $this->view->render('theme', [
            'title' => 'Theme',
            'login' => $this->login,
            'theme' => $theme,
            'messages' => $messages,
        ]);
    }

    /**
     *  transferring data to the page and displaying theme.php
     * @throws \Couchbase\QueryErrorException
     */
    public function viewTheme() : void
    {
        $idTheme = (int)filter_input(INPUT_POST, 'idTheme');
        $this->session->write('theme', $idTheme);
        $this->redirectToTheme($idTheme);
    }
    public function backToTheme() : void
    {
        $idTheme = (int)$this->session->get('theme');
        $this->redirectToTheme($idTheme);
    }

    /**
     * add Message
     *  data reading, validation and saving
     *   Redirect to theme.php
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function addMessage() : void
    {
        $error = false;
        $idTheme = (int)filter_input(INPUT_POST, 'idTheme');
        $text = filter_input(INPUT_POST, 'message');
        if (!empty($description)) {
            $description = stripcslashes($description);
            $description = htmlspecialchars($description, ENT_QUOTES);
        }else{
            $error = true;
        }
        if(!$error){
            $data = [
                'text' => $text,
                'idTheme' => $idTheme,
                'idUser' => $this->idUser,
            ];
            //TODO validation
            $res = $this->themeModel->addMessage($data);
        }
        $this->backToTheme();
    }

    /**
     *  del Message
     * @return void
     */
    public function delMessage() : void
    {
        $idMessage = (int)filter_input(INPUT_POST, 'idDelMessage');
        $res = $this->themeModel->delRow('messages', $idMessage);
        $this->backToTheme();
    }

    /**
     * edit Message
     *   data reading, validation and saving
     *    Redirect to theme.php
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function editMessage() : void
    {
        $idMessage = (int)filter_input(INPUT_POST, 'idEditMessage');
        $message = $this->themeModel->getAllById('messages',$idMessage);
        $this->view->render('messageEdit', [
            'title' => 'Edit Mess',
            'message' => $message,
        ]);
    }

    /**
     * update Message from db
     *  data reading, validation and saving
     *   Redirect to theme.php
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function updateMessage() : void
    {
        $error = false;
        $idMessage = (int)filter_input(INPUT_POST, 'idMessage');
        $description = filter_input(INPUT_POST, 'message');
        if (!empty($description)) {
            $description = stripcslashes($description);
            $description = htmlspecialchars($description, ENT_QUOTES);
        }else{
            $error = true;
        }
        if(!$error){
            $data = [
                'id' => $idMessage,
                'text' => $description,
            ];
            //TODO validation
            $res = $this->themeModel->updateMessage($data);
        }
        $this->backToTheme();
    }


}