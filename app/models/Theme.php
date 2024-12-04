<?php

namespace app\models;

use app\core\AbstractDB;

class Theme extends AbstractDB
{
    protected string $table = 'themes';

    public function allThemes() : array
    {
        $query = "SELECT themes.id, themes.title, themes.description, themes.created_at as time, users.login 
                    FROM themes INNER JOIN users ON themes.user_id=users.id;";
        return $this->queryAll($query);
    }
    /**
     * add user
     * @param array $data
     * @return bool
     * @throws \Couchbase\QueryErrorException
     */
    public function addTheme(array $data) : bool
    {
        $curDateTime =  gmdate("YmdHis");
//        var_dump($curDateTime);
        $query = "INSERT INTO {$this->table}(title, description, created_at, user_id) VALUES
                    ( '{$data['title']}','{$data['description']}','{$curDateTime}','{$data['user_id']}');" ;
        return $this->queryBool($query);

    }

}