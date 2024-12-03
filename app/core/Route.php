<?php

namespace app\core;

class Route
{
    const CONTROLLER_NAMESPACE = '\app\controllers\\';
    const DEFAULT_NAME = 'index';
    private $url = '';
    private $urlComponents = [];
    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->loadUrlComponents();
        $this->init();
    }
    /**
     * Init application
     * @return void
     */
    public function init() : void
    {
        $controllerName = $this->getUrlComponent(0);
        $action = $this->getUrlComponent(1);
        $controllerClass = self::CONTROLLER_NAMESPACE . ucfirst($controllerName) . 'Controller';
        if(!class_exists($controllerClass)) {
            self::notFound();
        }
        $controller = new $controllerClass();
        if(!method_exists($controller, $action)) {
            self::notFound();
        }
        if(!($controller instanceof controllable)){
            throw new \InvalidArgumentException();
        }
        $controller->$action();
    }

    /**
     * splits url into components
     * @return void
     */
    private function loadUrlComponents() : void
    {
        $this->url = strtolower($this->url);
        $this->urlComponents = explode('/', $this->url);
        //delete first elements witch always empty
        array_shift($this->urlComponents);
    }

    /**
     *returns a component by index
     * @param int $index
     * @return string
     */
    private function getUrlComponent(int $index) : string
    {
        $component = 'index';
        if(!empty($this->urlComponents[$index])) {
            $component = $this->urlComponents[$index];
        }
        return $component;
    }
    /**
     * Generate 404 status
     * @return never
     */
    public static function notFound() : never
    {
        http_response_code(404);
        exit();
    }
    /**
     * Create url for controller and action
     * @param string $controller
     * @param string $action
     * @return string
     */
    public static function url(string $controller = self::DEFAULT_NAME, string $action = self::DEFAULT_NAME) : string
    {
        return '/' . $controller . '/' . $action;
    }
    /**
     * redirect to specify url
     * @param string $url
     * @return never
     */
    public static function redirect(string $url = '/') : never
    {
        header('Location: ' . $url );
        exit();
    }
}