<?php

class Register extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $this->view->render('register/register');
    }

    public function register_submit()
    {
        $register_model          = $this->loadModel('RegisterModel');
        $registration_successful = $register_model->registerNewUser();
        if ($registration_successful == true) {
            header('location: ' . URL . 'register/');
        } else {
            header('location: ' . URL . 'register/register');
        }
    }

    public function verify($user_id, $user_verification_code)
    {
        if (isset($user_id) && isset($user_verification_code)) {
            $register_model = $this->loadModel('RegisterModel');
            $register_model->verifyNewUser($user_id, $user_verification_code);
            $this->view->render('register/verify');
        } else {
            header('location:' . URL . 'register/');
        }
    }

}
