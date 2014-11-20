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
        $list_model = $this->loadModel('ListModel');
        $this->view->render('dashboard/createlist');
    }

    public function delete_list($list_id)
    {
        if (isset($list_id)) {
            $list_model = $this->loadModel('ListModel');
            $list_model->deleteList($list_id);
        }

        header('location:' . URL . 'dashboard/index');
    }

    public function show_list($list_id)
    {
        if(isset($list_id))
        {
            $list_model = $this->loadModel('ListModel');
            $this->view->tasks = $list_model->showTasks($list_id);
            $this->view->render('dashboard/todo');
        }
        else{
            header('location:'.URL.'dashboard/index');
        }
    }

}
