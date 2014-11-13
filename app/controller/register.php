<?php

class Register extends Controller
{

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$register_model = $this->loadModel('RegisterModel');
		require 'app/view/register/register.php';

		Session::set('user_logged_in', true);

	}

	public function registerNewUser()
	{
	
	}



}