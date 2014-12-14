<?php

class TaskModel
{

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function showTasks($list_id)
    {

        if (isset($_GET['sort_task']) and !empty($_GET['sort_task'])) {
            $sort_parameter = strip_tags($_GET['sort_task']);
            $sort_order     = TaskOps::sort_tasks($sort_parameter);
            $sort_order     = 't.task' . $sort_order;
        } else {
            $sort_order = 't.task_name';
        }

        $sql = "SELECT t.task_name, t.task_id, t.task_priority, t.task_deadline, t.task_completed, l.list_id
                FROM task AS t
                LEFT JOIN list AS l ON l.list_id = :list_id AND l.list_id = t.list_id
                WHERE l.user_id = :user_id
                ORDER BY $sort_order";

        $query = $this->db->prepare($sql);
        $query->execute(array(':list_id' => $list_id, ':user_id' => $_SESSION['user_id']));

        return $query->fetchAll();

    }

    public function addNewTask($list_id)
    {
        if (isset($_POST['task_name']) and isset($_POST['task_deadline']) and isset($_POST['task_priority'])) {

            $task_name     = strip_tags($_POST['task_name']);
            $task_deadline = strip_tags($_POST['task_deadline']);
            $task_priority = strip_tags($_POST['task_priority']);
            $list_id       = strip_tags($list_id);

            $sql = "INSERT INTO task (task_name, task_deadline, task_priority, list_id)
                    VALUES (:task_name, :task_deadline, :task_priority, :list_id)";

            $query = $this->db->prepare($sql);
            $query->execute(array(':task_name' => $task_name, ':task_deadline' => $task_deadline, ':task_priority' => $task_priority, ':list_id' => $list_id));

            if ($query->rowCount() == 1) {
                $_SESSION['feedback_positive'][] = "Task " . $task_name . " added";

                return true;
            } else {
                $_SESSION['feedback_negative'][] = "Adding new task operation failed!";
                return false;
            }

        }
        return false;
    }

    public function getTaskData($task_id)
    {
        if (isset($task_id)) {

            $sql   = "SELECT task_id, task_name, task_deadline, task_priority FROM task WHERE task_id = :task_id";
            $query = $this->db->prepare($sql);
            $query->execute(array(':task_id' => $task_id));

            if ($query->rowCount() == 1) {
                return $query->fetch();
            } else {
                return false;
            }
        }

        return false;
    }

    public function updateTask($task_id)
    {
        if (isset($task_id)) {

            if (isset($_POST['task_name']) and isset($_POST['task_deadline']) and isset($_POST['task_priority'])) {

                $task_name     = strip_tags($_POST['task_name']);
                $task_deadline = strip_tags($_POST['task_deadline']);
                $task_priority = strip_tags($_POST['task_priority']);

                $sql = "UPDATE task
                        SET task_name = :task_name, task_deadline = :task_deadline, task_priority = :task_priority
                        WHERE task_id = :task_id";

                $query = $this->db->prepare($sql);
                $query->execute(array(':task_name' => $task_name, ':task_deadline' => $task_deadline, ':task_priority' => $task_priority, ':task_id' => $task_id, ));

                if ($query->rowCount() == 1) {
                    $_SESSION['feedback_positive'][] = "Task updated";
                    return true;
                } else {
                    $_SESSION['feedback_negative'][] = "Task update operation failed!";
                    return false;
                }
            } else {
                $_SESSION['feedback_negative'][] = "There has been an error!";
                return false;
            }
        }

        return false;

    }

    public function deleteTask($task_id)
    {
        if (isset($task_id)) {
            $sql   = "DELETE FROM task WHERE task_id = :task_id";
            $query = $this->db->prepare($sql);
            $query->execute(array(':task_id' => $task_id));

            $count = $query->rowCount();

            if ($count == 1) {
                $_SESSION['feedback_positive'][] = "Task deleted";
                return true;
            } else {
                $_SESSION['feedback_negative'][] = "Task delete operation failed!";
                return false;
            }
        }
        return false;

    }

    public function markTaskComplete($task_id)
    {
        if (isset($task_id)) {

            $sql   = "UPDATE task SET task_completed = 1 WHERE task_id = $task_id";
            $query = $this->db->prepare($sql);
            $query->execute();

            $count = $query->rowCount();

            if (1 == $count) {
                $_SESSION['feedback_positive'][] = "Task completed!";
                return true;
            } else {
                $_SESSION['feedback_negative'][] = "Task already marked complete!";
                return false;
            }
        }

        return false;

    }

    public function checkUserPermission($list_id)
    {
        if (isset($list_id)) {

            $sql = "SELECT l.list_id
                    FROM list l
                    LEFT JOIN user u ON l.user_id = u.user_id AND l.list_id = $list_id
                    WHERE u.user_id = :user_id ";

            $query = $this->db->prepare($sql);
            $query->execute(array(':user_id' => $_SESSION['user_id']));

            $count = $query->rowCount();

            if (0 != $count) {
                return true;
            } else {
                $_SESSION['feedback_negative'][] = "You are not authorized to view that page. Get lost.";
                return false;
            }
        }

        return false;

    }
}
