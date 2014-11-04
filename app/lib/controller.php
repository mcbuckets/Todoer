<?php


class Controller
{

	public $db;

	public function __construct()
	{
		$this->openDatabaseConnection();
	}

	private function openDatabaseConnection()
	{

		$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRORMODE_WARNING);

		$this->db = new PDO(DB_TYPE.':host'.DB_HOST.';dbname'.DB_NAME, DB_USER, DB_PASS, $options);
	}

	public function loadModel($model_name)
	{
		require 'app/models/'.strtolower($model_name).'.php';

		return new $model_name($this->db);

	}

}