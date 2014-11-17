<?php

class ListModel
{

	public function __constuct($db)
	{

		try{
			$this->db = $db;
		}catch(PDOException $e){
			exit('Database connection problem!');
		}

	}




}