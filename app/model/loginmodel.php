<?php


class LoginModel
{

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function registerNewUser()
	{
		$user_name = strip_tags($_POST['user_name']);
        $user_email = strip_tags($_POST['user_email']);
        $user_password_hash = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

        $query = $this->db->prepare("SELECT * FROM user WHERE user_name = :user_name");
        $query->execute(array(':user_name' => $user_name));
        $count = $query->rowCount();

        if($count == 1){
        	$_SESSION["feedback_negative"][] = "Username already taken!";
        	return false;
        }

        $query = $this->db->prepare("SELECT user_id FROM user WHERE user_email = :user_email");
        $query->execute(array(':user_email' => $user_email));
        $count = $query->rowCount();

        if($count == 1){
        	$_SESSION["feedback_negative"][] = "E-mail is already taken";
        	return false;
        }

        $user_creation_timestamp = time();

        $sql = "INSERT INTO user (user_name, user_password_hash, user_email, user_creation_timestamp)
                    VALUES (:user_name, :user_password_hash, :user_email, :user_creation_timestamp)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':user_name' => $user_name,
                              ':user_password_hash' => $user_password_hash,
                              ':user_email' => $user_email,
                              ':user_creation_timestamp' => $user_creation_timestamp));
        
        $count = $query->rowCount();

        if($count != 1){
        	$_SESSION["feedback_negative"][] = "Registration failed!";
        	return false;
        }
        return true;

	}

	public function logout()
	{
		Session::destroy();
	}



}