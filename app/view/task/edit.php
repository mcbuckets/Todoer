<!DOCTYPE html>
<html>
<head>
	<title>Add view</title>
	<link rel="stylesheet" type="text/css" href="/app/resources/css/style.css"/ >
	<link rel="stylesheet" type="text/css" href="/app/resources/css/jquery.datetimepicker.css"/ >
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="/app/resources/javascript/jquery.datetimepicker.js"></script>
</head>
<body>
	<div id="editTask">
		<form action="<?php echo URL . 'task/update_task/' . $this->list_id . '/' . $this->task->task_id;?>" method="POST" id="newTask">
			<label>Enter task name:</label>
			<input type="text" name="task_name" value="<?php echo $this->task->task_name;?>"required>
			<label>Pick task deadline:</label>
			<input type="text" name="task_deadline" id="datetimepicker" value ="<?php echo $this->task->task_deadline;?>"required>
			<select name="task_priority" id="selectPriority" required>
			    <option value="1" <?php if ($this->task->task_priority == 1) {echo "selected='selected'";}
?>>Low</option>
			    <option value="2"  <?php if ($this->task->task_priority == 2) {echo "selected='selected'";}
?>>Normal</option>
			    <option value="3"  <?php if ($this->task->task_priority == 3) {echo "selected='selected'";}
?>>High</option>
			</select>
			<input type="Submit" name="create" value="Update task">
		</form>
	</div>
	<script type="text/javascript">$('#datetimepicker').datetimepicker();</script>
</body>
</html>

