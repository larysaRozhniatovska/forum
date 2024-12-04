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
        if ( !self::isSizeValid($data['login'], 4, 100)){
            return false;
        }
        if ( !self::isSizeValid($data['password'], 4, 200)){
            return false;
        }
        if (array_key_exists('email', $data)) {
            if (!self::isEmailValid($data['email'])){
                return false;
            }
        }
//        if (array_key_exists('password', $data)) {
//            $temp = self::isPasswordValid($data['password']);
//            if (!empty($temp)){
//                return false;
//            }
//        }
        if (array_key_exists('repassword', $data)) {
            if (!self::isPassword2Valid($data['password'], $data['repassword'])){
                var_dump($data['repassword']);
                return false;
            }
        }
        return true;
    }
}