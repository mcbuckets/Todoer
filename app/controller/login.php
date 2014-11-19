<?php

class Login extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render('login/login');
    }

    public function login_submit()
    {

        $login_model      = $this->loadModel('LoginModel');
        $login_successful = $login_model->loginUser();

        if ($login_successful) {
            header('location:' . URL . 'dashboard');
        } else {
            header('location:' . URL . 'login/index');
        }
    }

    public function register()
    {
        $login_model = $this->loadModel('LoginModel');
        $this->view->render('login/register');
    }

    public function register_submit()
    {
        $login_model             = $this->loadModel('LoginModel');
        $registration_successful = $login_model->registerNewUser();

        if ($registration_successful == true) {
            header('location: ' . URL . 'login/index');
        } else {
            header('location: ' . URL . 'login/register');
        }
    }

    public function logout()
    {
        $login_model = $this->loadModel('LoginModel');
        $login_model->logout();

        header('location:' . URL . 'login');
    }

}
