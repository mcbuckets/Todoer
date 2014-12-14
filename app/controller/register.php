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

        header('location: ' . URL . 'register');
    }

    public function verify_user($user_id, $user_verification_code)
    {
        if (isset($user_id) and isset($user_verification_code)) {

            $register_model = $this->loadModel('RegisterModel');
            $register_model->verifyNewUser($user_id, $user_verification_code);
            $this->view->render('register/verify');

        } else {
            header('location:' . URL . 'register');
        }
    }

}
