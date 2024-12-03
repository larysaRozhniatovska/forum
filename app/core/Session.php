<?php

namespace app\core;

class Session
{
    private $properties = [];

    public function __construct()
    {
        session_start();
        $this->read(['errorsAdd','errorsLogin', 'messageNoUser', 'login']);
    }

    /**
     * reade once properties from session
     * @param array $keys
     * @return void
     */
    private function read(array $keys):void
    {
        foreach ($keys as $key){
            if(!empty($_SESSION[$key])){
                $this->properties[$key] = $_SESSION[$key];
                if($key != 'login')
                    unset($_SESSION[$key]);
            }
        }
    }

    /**
     * delete once properties from session
     * @param string $key
     * @return void
     */
    public function delete(string $key): void
    {
        if(!empty($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }

    /**
     * write once properties
     * @param string $key
     * @param mixed $data
     * @return void
     */
    public function write(string $key,mixed $data): void{
        $_SESSION[$key] = $data;
    }
    /**
     * return once properties
     * @param string $property
     * @return string|null
     */
    public function get(string $property) : string | null
    {
        if(isset($this->properties[$property])){
            return $this->properties[$property];
        }
        return null;
    }
}