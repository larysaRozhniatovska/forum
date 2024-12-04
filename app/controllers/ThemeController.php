<?php

namespace app\controllers;

use app\core\AbstractController;

class ThemeController extends AbstractController
{
    protected ?string $login;
    protected int $user_id = 0;
    public function __construct()
    {
        parent::__construct();
        $this->login = $this->session->get('login');
        if (!empty($this->login)) {
            $user = $this->userModel->getIdUser($this->login);
            if (!empty($user)) {
                $this->user_id = $user['id'];
            }
        }

    }
    public function index() : void
    {
        // TODO: Implement index() method.
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
        $title = filter_input(INPUT_POST, 'title');
        $title = stripcslashes($title);
        $title = htmlspecialchars($title, ENT_QUOTES);
        $description = filter_input(INPUT_POST, 'description');
        $description = stripcslashes($description);
        $description = htmlspecialchars($description, ENT_QUOTES);

        $data = [
            'title' => $title,
            'description' => $description,
            'user_id' => $this->user_id,
        ];
        //TODO validation
        $res = $this->themeModel->addTheme($data);
        $this->redirectToTheme($this->login);

    }
}