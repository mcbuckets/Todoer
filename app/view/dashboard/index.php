<!DOCTYPE html>
<html>
<head>
	<title>Dashboard view</title>
</head>
<body>
	<?php $this->renderFeedback(); ?>
	<form action="<?php echo URL;?>/login/logout">
		<input type="Submit" name="Logout" value="Logout">
	</form>

	<br><br>
	<form action="<?php echo URL;?>dashboard/create_list" method="POST">
		<label>Enter list name</label>
		<input type="text" name="list_name">
		<input type="Submit" name="Create" value="Create new list"> 
	</form>
	<?php 
		if($this->list){
			foreach($this->list as $key => $value){
				echo '<tr>';
                echo '<td><a href="'. URL . 'todo/' . $value->list_id.'">'.$value->list_name.'</a></td>';
                echo '<td><a href="'. URL . 'dashboard/delete_list/' . $value->list_id.'">     Delete</a></td>';
                echo '</tr>';
			}
		}else echo "Create your todo list!";
	?>
</body>
</html>
