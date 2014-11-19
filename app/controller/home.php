<?php

class Home extends Controller
{

    public function index()
    {
        echo "Controller home, method index";

        if (isset($_SESSION['user_logged_in'])) {
            header('location: ' . URL . 'dashboard');
        } else {
            $this->view->render('home/index');
        }
    }
}
