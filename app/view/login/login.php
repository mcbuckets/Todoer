<!DOCTYPE html>
<html>
<head>
    <title>Todoer-login</title>
	<link rel="stylesheet" href="/app/resources/css/loginstyle.css" type="text/css">
	<meta charset="UTF-8">
</head>
<body>

    <p id="clkReg"><a href="<?php echo URL;?>register">Click to register</a></p>

	<section id= "main">
        <form action="<?php echo URL;?>login/login_submit" method="post" id="form">
            <p class="field">
                <input type="text" name="user_email" id="username" placeholder="Please enter your email" required>
                <i class="icon-user icon-large"></i>
            </p>
            <p class="field">
                <input type="password" name="user_password"  id="password" placeholder="Please enter your password" required>
                <i class="icon-lock icon-large"></i>
            </p>
            <p id="submitHolder">
                <button type="submit" name="login" id="submit"><i class="icon-arrow-right icon-large"></i></button>
            </p>
        </form>
    </section>

    <div id="dispMsg">
<?php
$this->renderFeedback();
?>
    </div>
</body>
</html>