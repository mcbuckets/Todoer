<?php

class Controller
{

	protected $db;

	public function __construct()
	{
		Session::init();
		$this->openDatabaseConnection();
		if (isset($_SESSION['user_logged_in'])) {
            header('location: ' . URL . 'dashboard');
        }
	}

	private function openDatabaseConnection()
	{

		$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

		$this->db = new PDO(DB_TYPE.':host'.DB_HOST.';dbname'.DB_NAME, DB_USER, DB_PASS, $options);
	}

	public function loadModel($model_name)
	{
		require 'app/model/'.strtolower($model_name).'.php';

		return new $model_name($this->db);

	}
}