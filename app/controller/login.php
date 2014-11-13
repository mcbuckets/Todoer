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

	public function logout()
	{
		$login_model = $this->loadModel('LoginModel');

	
			$login_model->logout();
	
		header('location:'.URL);
	}



}