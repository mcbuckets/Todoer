<?php

class Controller
{

    protected $db;

    public function __construct()
    {
        Session::init();

        try {
            $this->db = new Database();
        } catch (Exception $e) {
            die('Database connection could not be established!');
        }

        $this->view = new View();
    }

    public function loadModel($model_name)
    {
        require 'app/model/' . strtolower($model_name) . '.php';

        return new $model_name($this->db);

    }
}
