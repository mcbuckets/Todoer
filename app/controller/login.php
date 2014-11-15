<?php

class Login extends Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$login_model = $this->loadModel('LoginModel');
		require 'app/view/login/login.php';
	}

	public function register()
	{
		$login_model = $this->loadModel('LoginModel');
		require 'app/view/login/register.php';
	}

	public function register_submit()
	{
		$login_model = $this->loadModel('LoginModel');
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
	
		header('location:'.URL.'login');
	}



}