<?php

class LoginModel
{

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function loginUser()
    {

        if (!isset($_POST['user_name']) or empty($_POST['user_name'])) {
            $_SESSION['feedback_negative'][] = "Username field is empty!";
            return false;
        }
        if (!isset($_POST['user_password']) or empty($_POST['user_password'])) {
            $_SESSION['feedback_negative'][] = "Password field is empty!";
            return false;
        }

        $sth = $this->db->prepare("SELECT user_id,
    									  user_name,
    									  user_password_hash,
    									  user_email
									FROM  user
									WHERE user_name = :user_name");

        $sth->execute(array(':user_name' => $_POST['user_name']));

        $count = $sth->rowCount();

        if ($count != 1) {
            $_SESSION['feedback_negative'][] = "Login failed! Username does not exist!";
            return false;
        }

        $result = $sth->fetch();

        if (password_verify($_POST['user_password'], $result->user_password_hash)) {

            // if ($result->user_active != 1) {
            //     $_SESSION['feedback_negative'][] = "Your account is not activated!";
            //     return false;
            // }

            Session::init();
            Session::set('user_logged_in', true);
            Session::set('user_id', $result->user_id);
            Session::set('user_name', $result->user_name);

            $user_last_login_timestamp = time();

            $sql = "UPDATE user SET user_last_login_timestamp = :user_last_login_timestamp WHERE user_id = :user_id";
            $sth = $this->db->prepare($sql);
            $sth->execute(array(':user_id' => $result->user_id, ':user_last_login_timestamp' => $user_last_login_timestamp));

            return true;

        } else {
            $_SESSION['feedback_negative'][] = "Login failed! Wrong password!";
            return false;
        }

        return false;
    }

    public function registerNewUser()
    {

        if (empty($_POST['user_name'])) {
            $_SESSION['feedback_negative'][] = "Username field is empty";
        } elseif (strlen($_POST['user_name']) > 64 or strlen($_POST['user_name']) < 2) {
            $_SESSION['feedback_negative'][] = "Password too short or too long!";
        } elseif (empty($_POST['user_password'])) {
            $_SESSION['feedback_negative'][] = "Password field is empty";
        } elseif (empty($_POST['user_email'])) {
            $_SESSION['feedback_negative'][] = "Email field is empty!";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['feedback_negative'][] = "Entered email doesn't fit email pattern";
        } elseif (!empty($_POST['user_name'])
             and strlen($_POST['user_name']) <= 64
             and strlen($_POST['user_name']) >= 2
             and !empty($_POST['user_password'])
             and !empty($_POST['user_email'])
             and filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $user_name          = strip_tags($_POST['user_name']);
            $user_email         = strip_tags($_POST['user_email']);
            $user_password_hash = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

            $query = $this->db->prepare("SELECT * FROM user WHERE user_name = :user_name");
            $query->execute(array(':user_name' => $user_name));
            $count = $query->rowCount();

            if ($count == 1) {
                $_SESSION["feedback_negative"][] = "Username already taken!";
                return false;
            }

            $query = $this->db->prepare("SELECT user_id FROM user WHERE user_email = :user_email");
            $query->execute(array(':user_email' => $user_email));
            $count = $query->rowCount();

            if ($count == 1) {
                $_SESSION["feedback_negative"][] = "E-mail is already taken";
                return false;
            }

            $user_creation_timestamp = time();

            $sql = "INSERT INTO user (user_name, user_password_hash, user_email, user_creation_timestamp)
	                    VALUES (:user_name, :user_password_hash, :user_email, :user_creation_timestamp)";
            $query = $this->db->prepare($sql);
            $query->execute(array(':user_name' => $user_name,
                ':user_password_hash'             => $user_password_hash,
                ':user_email'                     => $user_email,
                ':user_creation_timestamp'        => $user_creation_timestamp));

            $count = $query->rowCount();
            if ($count != 1) {
                $_SESSION["feedback_negative"][] = "Registration failed!";
                return false;
            }

            $resul_user_row = $query->fetch();
            $user_id        = $result_user_row->user_id;

            return true;

        } else {
            $_SESSION['feedback_negative'][] = "Unknown error!";
        }

        return false;
    }

    public function logout()
    {
        Session::destroy();
    }

}
