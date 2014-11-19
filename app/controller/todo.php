<?php

class Todo extends Controller
{

    public function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    public function index($list_id)
    {
    	$todo_model = $this->loadModel('TodoModel');
    	$this->view->todo = $todo_model->showTasks($list_id);
    	$this->view->render('dashboard/todo');
    }

    
}
