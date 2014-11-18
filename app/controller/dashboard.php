<?php

class Dashboard extends Controller
{

    public function __construct()
    {
        
        Auth::handleLogin();
    }

    public function index()
    {

        $list_model = $this->loadModel('ListModel');
        require 'app/view/dashboard/index.php';

    }

}
