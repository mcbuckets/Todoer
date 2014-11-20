<!DOCTYPE html>
<html>
<head>
	<title>Todo view</title>
</head>
<body>
	<?php $this->renderFeedback(); ?>
	<form action="<?php echo URL;?>/login/logout">
		<input type="Submit" name="Logout" value="Logout">
	</form>

	<br><br>

	<?php
		if($this->tasks){
			foreach($this->tasks as $key => $value){
				echo '<tr>';
                echo '<td>'.$value->task_name.'</td>';
                echo '<td><a href="'. URL . 'dashboard/edit_task/' . $value->task_id.'">Edit task</a></td>';
                echo '<td><a href="'. URL . 'dashboard/delete_task/' . $value->task_id.'">Delete task</a></td>';
                echo '</tr>';
			}
		}else echo "Add tasks!";

	?>
</body>
</html>
