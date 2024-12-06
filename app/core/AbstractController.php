<?php

namespace app\core;
use app\models\Theme;
use app\models\User;
use DateTime;
use DateTimeZone;

abstract class AbstractController implements controllable
{
    protected User $userModel;
    protected Theme $themeModel;

    public View $view;
    protected Session $session;
    public function __construct()
    {
        $this->view = new View();
        $this->session = new Session();
        $this->userModel = new User();
        $this->themeModel = new Theme();
    }

    /**
     * select data & redirect to themes.php
     * @param string $login
     * @return void
     * @throws \Exception
     */
    protected function redirectToThemes(string $login): void
    {
        $themes = $this->themeModel->allThemes();
        foreach ($themes as &$theme) {
            $date = $theme['time'];
            $date = new DateTime($date,  new DateTimeZone('UTC'));
            $date->setTimezone(new DateTimeZone(date_default_timezone_get()));
            $theme['time']=$date->format('Y-m-d H:i:s');
        }
        $error = $this->session->get('error');
        $this->view->render('themes', [
            'title' => 'Themes',
            'login' => $login,
            'themes' => $themes,
            'error' => $error,
        ]);
    }
}