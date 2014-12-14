<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

define('URL', '/');

define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'todoer');
define('DB_USER', 'root');
define('DB_PASS', 'toor');

define("EMAIL_ACTIVATION_URL", URL . "register/verify_user");
define("EMAIL_ACTIVATION_FROM_EMAIL", "no-reply@todoer.com");
define("EMAIL_ACTIVATION_FROM_NAME", "Todo app");
define("EMAIL_ACTIVATION_SUBJECT", "Account activation for todo app");
define("EMAIL_ACTIVATION_CONTENT", "Please click on this link to activate your account: ");
