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
        $list_model->createNewTodoList();

        header('location:' . URL . 'dashboard');
    }

    public function delete_list($list_id)
    {
        if (isset($list_id)) {
            $list_model = $this->loadModel('ListModel');
            $list_model->deleteList($list_id);
        }

        header('location:' . URL . 'dashboard/index');
    }

    public function view_list($list_id)
    {
        if (isset($list_id)) {
            $list_model       = $this->loadModel('ListModel');
            $this->view->list = $list_model->viewList($list_id);
        }
        header('location:' . URL . 'dashboard/list');

    }

}
