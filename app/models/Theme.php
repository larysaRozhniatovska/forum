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

    public function getMessagesOfTheme(int $idTheme) : array
    {
        $query = "SELECT messages.*,users.login FROM messages,users
                  WHERE messages.theme_id = {$idTheme} AND  messages.user_id = users.id;";
        return $this->queryAll($query);
    }

    /**
     * add tneme
     * @param array $data
     * @return bool
     * @throws \Couchbase\QueryErrorException
     */
    public function addTheme(array $data) : bool
    {
        $curDateTime =  gmdate("YmdHis");
//        $query = "INSERT INTO {$this->table}(title, description, created_at, user_id) VALUES
//                    ( '{$data['title']}','{$data['description']}','{$curDateTime}','{$data['user_id']}');" ;
        $query = "INSERT INTO {$this->table}(title, description, created_at, user_id) VALUES ( ?,?,?,?);" ;
        /* создание подготавливаемого запроса */
        $stmt = mysqli_prepare($this->db,$query);
        /* связывание параметров с метками */
        $stmt->bind_param("sssi", $data['title'],$data['description'],$curDateTime,$data['idUser']);
        /* выполнение запроса */
        $stmt->execute();
        $res = true;
        if ($stmt->errno != 0) {
            $res = false;
        }
        $stmt->close();
        return $res;

    }

    /**
     * update theme
     * @param array $data
     * @return bool
     * @throws \Couchbase\QueryErrorException
     */
    public function updateTheme(array $data) : bool
    {
//        $query = "INSERT INTO {$this->table}(title, description, created_at, user_id) VALUES
//                    ( '{$data['title']}','{$data['description']}','{$curDateTime}','{$data['user_id']}');" ;
        $query = "UPDATE themes SET title=?,description=? WHERE id = ?;" ;
        /* создание подготавливаемого запроса */
        $stmt = mysqli_prepare($this->db,$query);
        /* связывание параметров с метками */
        $stmt->bind_param("ssi", $data['title'],$data['description'],$data['id']);
        /* выполнение запроса */
        $stmt->execute();
        $res = true;
        if ($stmt->errno != 0) {
            $res = false;
        }
        $stmt->close();
        return $res;

    }
    /**
     * add message
     * @param array $data
     * @return bool
     * @throws \Couchbase\QueryErrorException
     */
    public function addMessage(array $data) : bool
    {
        $curDateTime =  gmdate("YmdHis");
//        $query = "INSERT INTO {$this->table}(title, description, created_at, user_id) VALUES
//                    ( '{$data['title']}','{$data['description']}','{$curDateTime}','{$data['user_id']}');" ;
        $query = "INSERT INTO messages(text, created_at,theme_id, user_id) VALUES ( ?,?,?,?);" ;
        /* создание подготавливаемого запроса */
        $stmt = mysqli_prepare($this->db,$query);
        /* связывание параметров с метками */
        $stmt->bind_param("ssii", $data['text'],$curDateTime,$data['idTheme'],$data['idUser']);
        /* выполнение запроса */
        $stmt->execute();
        $res = true;
        if ($stmt->errno != 0) {
            $res = false;
        }
        $stmt->close();
        return $res;

    }
    /**
     * update message
     * @param array $data
     * @return bool
     * @throws \Couchbase\QueryErrorException
     */
    public function updateMessage(array $data) : bool
    {
//        $query = "INSERT INTO {$this->table}(title, description, created_at, user_id) VALUES
//                    ( '{$data['title']}','{$data['description']}','{$curDateTime}','{$data['user_id']}');" ;
        $query = "UPDATE messages SET text=? WHERE id = ?;" ;
        /* создание подготавливаемого запроса */
        $stmt = mysqli_prepare($this->db,$query);
        /* связывание параметров с метками */
        $stmt->bind_param("si", $data['text'],$data['id']);
        /* выполнение запроса */
        $stmt->execute();
        $res = true;
        if ($stmt->errno != 0) {
            $res = false;
        }
        $stmt->close();
        return $res;

    }
}