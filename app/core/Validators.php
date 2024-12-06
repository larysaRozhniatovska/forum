<?php

namespace app\core;

class Validators
{
      /**check login size $min ... $max
     * @param $login
     * @param $min
     * @param $max
     * @return bool
     */
    protected static function isSizeValid( $value, $min, $max ):bool
    {
        if(!empty($value)) {
            $len = strlen($value);
            return $len >= $min && $len <= $max;
        }else{
            return false;
        }
    }

    /**
     * email verification
     * @param $email
     * @return bool
     */
    protected static function isEmailValid($email):bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * password verification
     * @param $password
     * @return array
     */
    protected static function isPasswordValid($password):array
    {
        $errors = [];

        if (!preg_match('/[\.:,;\?!@#\$%\^&\*_\-\+=]/', $password)){
            $errors[] = 'Special characters check failed';
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = 'The password must contain at least one capital letter';
        }

        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = 'The password must contain at least one lowercase letter';
        }
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = 'The password must contain at least one number';
        }
        return  $errors;
    }

    /**
     * checking passwords for compliance
     * @param $value
     * @param $value1
     * @return bool
     */
    protected static function isPassword2Valid($value,$value1): bool {
        return $value === $value1;
    }
    /**
     * check all info User
     * @param array $data
     * @return bool
     */
    public static function validateInfoUser(array $data): bool
    {
        $login = $data['login'];
        if(!empty($login)) {
            $login = trim($login);
            $login = strip_tags($login);
            $login = stripcslashes($login);
            $login = htmlspecialchars($login);
        }
        if ( !self::isSizeValid($login, 4, 100)){
            return false;
        }
        if (array_key_exists('email', $data)) {
            if (!self::isEmailValid($data['email'])){
                return false;
            }
        }
        $password = '';
        if (array_key_exists('password', $data)) {
            $password = $data['password'];
            if(!empty($password)) {
                $password = trim($password);
                $password = strip_tags($password);
                $password = stripcslashes($password);
                $password = htmlspecialchars($password);
            }
            if ( !self::isSizeValid($password, 4, 200)){
                return false;
            }
//            $temp = self::isPasswordValid($data['password']);
//            if (!empty($temp)){
//                return false;
//            }
        }
        if (array_key_exists('repassword', $data)) {
            $repassword = $data['repassword'];
            if(!empty($repassword)) {
                $repassword = trim($repassword);
                $repassword = strip_tags($repassword);
                $repassword = stripcslashes($repassword);
                $repassword = htmlspecialchars($repassword);
            }
            if (!self::isPassword2Valid($password, $repassword )){
                return false;
            }
        }
        return true;
    }
}