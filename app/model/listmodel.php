<?php

class ListModel
{

    public function __construct($db)
    {
        $ths->db = $db;
    }

    public function showUserLists()
    {
        $sql   = "SELECT list_id,list_name, list_time_created FROM list WHERE user_id = :user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':user_id' => $_SESSION['user_id']));

        return $query->fetchAll();

    }

    public function createNewTodoList()
    {
        if (empty($_POST['list_name'])) {
            $_SESSION['feedback_negative'][] = "List name field is empty";
            return false;
        } else {

            $list_time_created = time();

            $sql   = "INSERT INTO list(list_name, list_time_created, user_id) VALUES (:list_name,:list_time_created,:user_id)";
            $query = $this->db->prepare($sql);
            $query->execute(array(':list_name' => htmlentities($_POST['list_name']), ':list_time_created' => $list_time_created, ':user_id' => $_SESSION['user_id']));
            $_SESSION['feedback_positive'][] = "New list created";
            return true;
        }
        return false;
    }

    public function deleteList($list_id)
    {

        $sql   = "DELETE FROM list WHERE list_id = :list_id AND user_id = :user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':list_id' => $list_id, ':user_id' => $_SESSION['user_id']));

        $count = $query->rowCount();

        if ($count == 1) {
            $_SESSION['feedback_positive'][] = "List deleted";
            return true;
        } else {
            $_SESSION['feedback_negative'][] = "List delete operation failed!";
        }
        return false;

    }

}
