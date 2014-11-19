<p>Register controller radi!</p>
<?php $this->renderFeedback(); ?>
<p>Enter your data:</p>
<form action="<?php echo URL;?>login/register_submit" method="POST">
	<label for="login_input_username">
		Please enter your username (min. 2 max. 64 chars and only letters and numbers):
	</label><br>
	<input type="text" name="user_name" id="login_input_username" pattern="[a-zA-Z0-9]{2,64}" required><br>
	<label for="login_input_email">
		Please enter your e-mail:
	</label><br>
    <input type="email" name="user_email" id="login_input_email" required /><br>
    <label for="login_input_password">
		Please enter your password:
	</label><br>
	<input id="login_input_password_new" type="password" name="user_password" pattern=".{6,}" required autocomplete="off" /><br><br>
	<input type="Submit"/>
</form>