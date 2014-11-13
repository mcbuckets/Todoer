<?php


class LoginModel
{

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function logout()
	{
		Session::destroy();
	}

}