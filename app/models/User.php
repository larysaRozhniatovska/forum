<?php
namespace app\models;
class User extends \app\core\AbstractDB
{
    protected string $table = 'users';
    /**
     * add if no users
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    protected function NotUser()
    {
        $users = $this->all();
        if (count($users) == 0) {
            $hash = password_hash("admin", PASSWORD_DEFAULT);
            $str = "INSERT INTO {$this->table}(login, password) VALUES ('admin','$hash')";
            $this->queryBool($str);
        }
    }


    /**
     * $login user id
     * @param string $login
     * @return bool|array
     * @throws \Couchbase\QueryErrorException
     */
    public function getIdUser(string $login) : bool | array
    {
        $query = "SELECT id FROM {$this->table} WHERE login = '{$login}' LIMIT 1";
        return $this->queryRow($query);
    }

    /**
     * add user
     * @param string $login
     * @param string $pass
     * @return bool
     * @throws \Couchbase\QueryErrorException
     */
    public function addUser(string $login, string $pass) : bool
    {
        if (!$this->validationAddUser($login))
            return false;
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $query = "INSERT INTO {$this->table}(login, password) VALUES ('{$login}','{$hash}')";
        return $this->queryBool($query);
    }
    /**
     * user validation on login
     * @param string $login
     * @param string $pass
     * @return bool
     * @throws \Couchbase\QueryErrorException
     */
    public function validationLoginUser(string $login, string $pass) : bool
    {
        $users = $this->all();
        $logins = array_column($users, 'login');
        $id = array_search($login,$logins);
        if ($id === false)
            return false;
        return password_verify($pass, $users[$id]['password']);
    }

    /**
     * user validation on login
     * @param string $login
     * @return bool true - exist login
     * @throws \Couchbase\QueryErrorException
     */
    public function validationAddUser(string $login) : bool
    {
        $users = $this->all();
        $logins = array_column($users, 'login');
        return !in_array($login, $logins);
    }
}