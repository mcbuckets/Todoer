<?php 

class Home extends Controller
{

	public function index()
	{
		echo "Controller home, method index";
		require 'app/view/home/index.php';

	}
}