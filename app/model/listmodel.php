<?php

class ListModel
{

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function showUserLists()
    {
        if (isset($_GET['sort_list']) and !empty($_GET['sort_list'])) {
            $sort_parameter = strip_tags($_GET['sort_list']);
            $sort_order     = TaskOps::sort_lists($sort_parameter);
            $sort_order     = 'l.list' . $sort_order;
        } else {
            $sort_order = 'l.list_name';
        }

        $sql = "SELECT  l.list_id, l.list_name, l.list_time_created,  COUNT(t.task_id) AS number_of_tasks,
                COALESCE(SUM(t.task_completed = 0),0) AS number_of_uncompleted_tasks
                FROM list AS l
                LEFT JOIN task AS t ON l.list_id = t.list_id
                WHERE l.user_id = :user_id
                GROUP BY l.list_id
                ORDER BY $sort_order";

        $query = $this->db->prepare($sql);
        $query->execute(array(':user_id' => $_SESSION['user_id']));

        return $query->fetchAll();

    }

    public function createNewTodoList()
    {
        if (empty($_POST['list_name']) or !isset($_POST['list_name'])) {
            $_SESSION['feedback_negative'][] = "List name field is empty";
            return false;
        } else {

            $list_time_created = date("Y-m-d H:i:s");

            $sql   = "INSERT INTO list(list_name, list_time_created, user_id) VALUES (:list_name,:list_time_created,:user_id)";
            $query = $this->db->prepare($sql);
            $query->execute(array(':list_name' => $_POST['list_name'], ':list_time_created' => $list_time_created, ':user_id' => $_SESSION['user_id']));

            $last_inserted_id = $this->db->lastInsertId();

            if ($last_inserted_id) {
                $_SESSION['feedback_positive'][] = "New list created";
                return $last_inserted_id;
            } else {
                $_SESSION['feedback_positive'][] = "List with that name already exists!";
                return false;
            }
        }
        return false;
    }

    public function deleteList($list_id)
    {

        $sql   = "DELETE FROM list WHERE list_id = :list_id AND user_id = :user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':list_id' => $list_id, ':user_id' => $_SESSION['user_id']));

        $count = $query->rowCount();

        if (1 == $count) {
            $_SESSION['feedback_positive'][] = "List deleted";
            return true;
        } else {
            $_SESSION['feedback_negative'][] = "List delete operation failed!";
            return false;
        }
        return false;

    }

}
