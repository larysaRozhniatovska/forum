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
    protected function redirectToTheme(string $login): void
    {
        $themes = $this->themeModel->allThemes();
        foreach ($themes as &$theme) {
//            var_dump($theme['time']);
            $date = $theme['time'];
            $date = new DateTime($date,  new DateTimeZone('UTC'));
            $date->setTimezone(new DateTimeZone(date_default_timezone_get()));
            $theme['time']=$date->format('Y-m-d H:i:s');
//            var_dump($theme['time']);
        }
        $this->view->render('themes', [
            'title' => 'Themes',
            'login' => $login,
            'themes' => $themes,
        ]);
    }
}