<?php 

	$feedback = Session::get('feedback_negative');

	if(isset($_SESSION['feedback_negative']))
	{
		foreach ($feedback as $feedback ) {
			echo $feedback;
		}
	}
	Session::set('feedback_negative', null);
?>
<p>Login controller</p>
 <form action="<?php echo URL;?>login/login_submit" method="post">
	<label>
		Please enter your username (or email):
	</label><br>
	<input type="text" name="user_name" required><br>
    <label>
		Please enter your password:
	</label><br>
	<input type="password" name="user_password" required /><br><br>
	<input type="Submit"/>
 </form>
