<!DOCTYPE html>
<html>
<head>
	<title>Todoer-register</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/app/resources/css/regstyle.css" type="text/css">
</head>
<body>
	<a href="<?php echo URL;?>" id="gotoLogin">Go to login page</a>
	<section id= "main">
		<form action="<?php echo URL;?>register/register_submit" method="POST" id="form">
			<p class="field"><input type="text" name="user_name" id="login_input_name" placeholder="Please enter your name (2 < chars < 30, letters only)"required></p>
			<p class="field"><input type="text" name="user_lastname" id="login_input_lastname" placeholder="Please enter your lastname (2 < chars < 60, letters only):" required></p>
		    <p class="field"><input type="email" name="user_email" id="login_input_email" placeholder="Please enter your e-mail:" required /></p>
			<p class="field"><input id="login_input_password_new" type="password" name="user_password" pattern=".{6,}" placeholder="Please enter your password (min. 6 chars):" required autocomplete="off" /></p>
			<input type="Submit" id="bttn" value="Submit" class="myButton" />
		</form>
	</section>
	<div id="dispMsg"><?php $this->renderFeedback();?></div>
</body>
</html>
