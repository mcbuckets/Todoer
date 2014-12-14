<?php

class Task extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    public function index()
    {
        header('location:' . URL . 'dashboard');
    }

    /**
     * @param $list_id
     */
    public function show_list($list_id)
    {
        if (isset($list_id)) {

            $task_model = $this->loadModel('TaskModel');
            $check      = $task_model->checkUserPermission($list_id);

            if ($check) {
                $tasks               = $task_model->showTasks($list_id);
                $this->view->tasks   = $tasks;
                $this->view->list_id = $list_id;
                $this->view->render('task/task');
            } else {

                header('location:' . URL . 'dashboard/index');
            }
        } else {
            header('location:' . URL . 'dashboard/index');
        }
    }

    public function mark_completed($list_id, $task_id)
    {
        if (isset($list_id) and isset($task_id)) {

            $task_model = $this->loadModel('TaskModel');
            $task_model->markTaskComplete($task_id);

            header('location:' . URL . 'task/show_list/' . $list_id);
        } else {
            header('location:' . URL . 'dashboard/index');
        }
    }

    public function delete_task($list_id, $task_id)
    {
        if (isset($task_id) and isset($list_id)) {

            $task_model = $this->loadModel('TaskModel');
            $task_model->deleteTask($task_id);

            header('location:' . URL . 'task/show_list/' . $list_id);

        } else {
            header('location:' . URL . 'dashboard/index');
        }
    }

    public function add_task($list_id)
    {
        if (isset($list_id)) {
            $this->view->id = $list_id;
            $this->view->render('task/add');
        } else {
            header('location:' . URL . 'dashboard/index');
        }

    }

    public function add_new_task($list_id)
    {
        if (isset($list_id)) {
            $task_model = $this->loadModel('TaskModel');
            $task_model->addNewTask($list_id);

            header('location:' . URL . 'task/show_list/' . $list_id);
        } else {
            header('location:' . URL . 'dashboard/index');
        }
    }

    public function edit_task($list_id, $task_id)
    {
        if (isset($list_id) and isset($task_id)) {

            $task_model          = $this->loadModel('TaskModel');
            $edit_task           = $task_model->getTaskData($task_id);
            $this->view->list_id = $list_id;
            $this->view->task    = $edit_task;
            $this->view->render('task/edit');

        } else {
            header('location:' . URL . 'dashboard/index');
        }
    }

    public function update_task($list_id, $task_id)
    {
        if (isset($list_id) and isset($task_id)) {

            $task_model = $this->loadModel('TaskModel');
            $task_model->updateTask($task_id);

            header('location:' . URL . 'task/show_list/' . $list_id);
        } else {
            header('location:' . URL . 'dashboard/index');
        }
    }
}
