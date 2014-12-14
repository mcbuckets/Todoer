<!DOCTYPE html>
<html>
<head>
	<title>Add view</title>
	<link rel="stylesheet" type="text/css" href="/app/resources/css/jquery.datetimepicker.css"/ >
	<link rel="stylesheet" href="/app/resources/css/style.css" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="/app/resources/javascript/jquery.datetimepicker.js"></script>
</head>
<body>
	<div id="addTask">
		<form action="<?php echo URL . 'task/add_new_task/' . $this->id;?>" method="POST" id="newTask">
			<label>Enter task name:</label>
			<input type="text" name="task_name" required>
			<label>Pick task deadline:</label>
			<input type="text" name="task_deadline" id="datetimepicker" required>
			<select name="task_priority" id="selectPriority" required>
				<option value="" selected="selected">Select priority:</option>
			    <option value="1">Low</option>
			    <option value="2">Normal</option>
			    <option value="3">High</option>
			</select>
			<input type="Submit" name="create" value="Create new task">
		</form>
	</div>
<script type="text/javascript">$('#datetimepicker').datetimepicker();</script>
</body>
</html>




