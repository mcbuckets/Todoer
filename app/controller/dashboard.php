<?php

class Dashboard extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    public function index()
    {
        $list_model       = $this->loadModel('ListModel');
        $this->view->list = $list_model->showUserLists();
        $this->view->render('dashboard/index');
    }

    public function create_list()
    {
        $this->view->render('dashboard/createlist');
    }

    public function new_list()
    {

        $list_model      = $this->loadModel('ListModel');
        $new_todo_listid = $list_model->createNewTodoList();

        if ($new_todo_listid) {
            header('location:' . URL . 'task/show_list/' . $new_todo_listid . '');
        } else {
            header('location:' . URL . 'dashboard/index');
        }
    }

    public function delete_list($list_id)
    {
        if (isset($list_id)) {

            $list_model = $this->loadModel('ListModel');
            $list_model->deleteList($list_id);
        }

        header('location:' . URL . 'dashboard/index');
    }

}
