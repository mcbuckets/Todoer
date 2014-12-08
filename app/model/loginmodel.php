<?php

class LoginModel
{

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function loginUser()
    {

        if (!isset($_POST['user_email']) or empty($_POST['user_email'])) {
            $_SESSION['feedback_negative'][] = "Username field is empty!";
            return false;
        }
        if (!isset($_POST['user_password']) or empty($_POST['user_password'])) {
            $_SESSION['feedback_negative'][] = "Password field is empty!";
            return false;
        }

        $query = $this->db->prepare("SELECT user_id,
    									  user_name,
    									  user_password_hash,
    									  user_email,
                                          user_active
									FROM  user
									WHERE user_email = :user_email");

        $query->execute(array(':user_email' => $_POST['user_email']));

        $count = $query->rowCount();

        if ($count != 1) {
            $_SESSION['feedback_negative'][] = "Login failed! Username does not exist!";
            return false;
        }

        $result = $query->fetch();

        if (password_verify($_POST['user_password'], $result->user_password_hash)) {

            if ($result->user_active != 1) {
                $_SESSION['feedback_negative'][] = "Your account is not activated! Please activate your account!";
                return false;
            }

            Session::init();
            Session::set('user_logged_in', true);
            Session::set('user_id', $result->user_id);
            Session::set('user_name', $result->user_name);

            $user_last_login_timestamp = time();

            $query = $this->db->prepare("UPDATE user SET user_last_login_timestamp = :user_last_login_timestamp WHERE user_id = :user_id");
            $query->execute(array(':user_id' => $result->user_id, ':user_last_login_timestamp' => $user_last_login_timestamp));

            return true;

        } else {
            $_SESSION['feedback_negative'][] = "Login failed! Wrong password!";
            return false;
        }

        return false;
    }

    public function logout()
    {
        Session::destroy();
    }

}
