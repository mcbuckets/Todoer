<?php

class RegisterModel
{

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function registerNewUser()
    {

        if (empty($_POST['user_name'])) {
            $_SESSION['feedback_negative'][] = "Name field is empty or doesn't fit pattern";
        } elseif (empty($_POST['user_lastname'])) {
            $_SESSION['feedback_negative'][] = "Lastname field is empty or doesn't fit pattern";
        } elseif (empty($_POST['user_password'])) {
            $_SESSION['feedback_negative'][] = "Password field is empty";
        } elseif (empty($_POST['user_email'])) {
            $_SESSION['feedback_negative'][] = "Email field is empty!";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['feedback_negative'][] = "Entered email doesn't fit email pattern";
        } elseif (!empty($_POST['user_name'])
            and preg_match('/^[a-z\d]{2,30}$/i', $_POST['user_name'])
            and !empty($_POST['user_lastname'])
            and preg_match('/^[a-z\d]{2,60}$/i', $_POST['user_lastname'])
            and !empty($_POST['user_email'])
            and filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {

            $user_name          = strip_tags($_POST['user_name']);
            $user_lastname      = strip_tags($_POST['user_lastname']);
            $user_email         = strip_tags($_POST['user_email']);
            $user_password_hash = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

            $query = $this->db->prepare("SELECT user_id FROM user WHERE user_email = :user_email");
            $query->execute(array(':user_email' => $user_email));
            $count = $query->rowCount();

            if (1 == $count) {
                $_SESSION['feedback_negative'][] = "E-mail is already in use";
                return false;
            }

            $user_creation_time   = date("Y-m-d H:i:s");
            $user_activation_hash = sha1(uniqid(mt_rand(), true));

            $sql = "INSERT INTO user (user_name, user_lastname, user_password_hash, user_email, user_creation_time, user_activation_hash)
	                    VALUES (:user_name, :user_lastname, :user_password_hash, :user_email, :user_creation_time, :user_activation_hash)";

            $query = $this->db->prepare($sql);
            $query->execute(array(':user_name' => $user_name,
                ':user_lastname'                   => $user_lastname,
                ':user_password_hash'              => $user_password_hash,
                ':user_email'                      => $user_email,
                ':user_creation_time'              => $user_creation_time,
                ':user_activation_hash'            => $user_activation_hash));

            $count = $query->rowCount();
            if (1 != $count) {
                $_SESSION['feedback_negative'][] = "Registration failed!";
                return false;
            }

            $query = $this->db->prepare("SELECT user_id FROM user WHERE user_email = :user_email");
            $query->execute(array(':user_email' => $user_email));

            if (1 != $query->rowCount()) {
                $_SESSION['feedback_negative'][] = "Internal error! New user registartion failed!";
                return false;
            }

            $result_user_row = $query->fetch();
            $user_id         = $result_user_row->user_id;

            if ($this->sendVerificationEmail($user_id, $user_email, $user_activation_hash)) {
                $_SESSION['feedback_positive'][] = "Email sent to your address!";
                return true;
            } else {
                $query = $this->db->prepare("DELETE FROM user WHERE user_id = :last_inserted_id");
                $query->execute(array(':last_inserted_id' => $user_id));
                $_SESSION['feedback_negative'][] = "Email sending failed!";
                return false;
            }

            return true;

        } else {
            $_SESSION['feedback_negative'][] = "Unknown error!";
        }

        return false;
    }

    private function sendVerificationEmail($user_id, $user_email, $user_activation_hash)
    {
        $email = new PHPMailer;

        $email->From     = EMAIL_ACTIVATION_FROM_EMAIL;
        $email->FromName = EMAIL_ACTIVATION_FROM_NAME;
        $email->AddAddress($user_email);
        $email->Subject = EMAIL_ACTIVATION_SUBJECT;
        $email->Body    = EMAIL_ACTIVATION_CONTENT . EMAIL_ACTIVATION_URL . '/' . urlencode($user_id) . '/' . urlencode($user_activation_hash);

        if ($email->Send()) {
            return true;
        } else {
            $_SESSION['feedback_negative'][] = "Error sending verification e-mail: " . $email->ErrorInfo;
            return false;
        }

    }

    public function verifyNewUser($user_id, $user_verification_code)
    {
        $query = $this->db->prepare("UPDATE user
                                    SET user_active = 1, user_activation_hash = NULL
                                    WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash");

        $query->execute(array(':user_id' => $user_id, ':user_activation_hash' => $user_verification_code));

        if ($query->rowCount() == 1) {
            $_SESSION['feedback_positive'][] = "Account activated successfully";
            return true;
        } else {
            $_SESSION['feedback_negative'][] = "Activation failed or already activated account";
            return false;
        }
    }

}
