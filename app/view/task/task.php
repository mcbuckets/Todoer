<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="/app/resources/css/style.css" type="text/css">
	<title>Task view</title>
	<meta charset="UTF-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="/app/resources/javascript/main.js"></script>
</head>
<body>

    <div id="response">
    	<div id="header">

            <div id="menu">
                <a href="<?php echo URL . 'task/add_task/' . $this->list_id;?>">Add new task</a>
                <a href="<?php echo URL;?>dashboard">Go to dashboard</a>
            </div>
            <div id="manipulate">
                <form action="<?php echo URL;?>login/logout" id="logout">
                    <input type="Submit" name="Logout" value="Logout" id="btnLogout">
                </form>
        		<form action="<?php echo URL . 'task/show_list/' . $this->tasks[0]->list_id;?>" method="GET" id="sortTasks">
        			<select name="sort_task" id="selectSortTask">
        				<option value="" selected="selected">Sort by:</option>
        			    <option value="byName">Name</option>
        			    <option value="byDeadline">Deadline</option>
        			    <option value="byPriority">Priority</option>
        			    <option value="byStatus">Status</option>
        			</select>
        	    </form>
            </div>
        </div>
    <table cellspacing='0'><tr><th>Task Name</th><th>Task Priority</th><th>Task Deadline</th><th>Until Deadline/Overdue</th><th>Status</th><th>Operations</th></tr>
<?php

$counter = 0;

if ($this->tasks) {

    foreach ($this->tasks as $key => $value) {

        $task_deadline = new DateTime($value->task_deadline, new DateTimeZone('Europe/Zagreb'));
        $time_now      = new DateTime('NOW', new DateTimeZone('Europe/Zagreb'));
        $overdue_until = $time_now->diff($task_deadline);

        $priority = TaskOps::get_priority($value->task_priority);
        $status   = TaskOps::get_status($value->task_completed);

        if ($counter % 2 == 0) {
            echo '<tr class="even">';
            echo '<td>' . $value->task_name . '</td><td>' . $priority . '</td><td>';
            echo $task_deadline->format('l jS \of F Y h:i:s A');
            echo '</td><td>';
            echo $overdue_until->format('%R %a day/s, %h hours, %i minutes');
            echo '</td><td>' . $status . '</td>';
            echo '<td><a href="' . URL . 'task/edit_task/' . $value->list_id . '/' . $value->task_id . '" id="editLink">Edit</td>';
            echo '<td><a href="' . URL . 'task/delete_task/' . $value->list_id . '/' . $value->task_id . '" id="deleteLink">Delete</td>';
            echo '<td><a href="' . URL . 'task/mark_completed/' . $value->list_id . '/' . $value->task_id . '" id="completedLink">Completed</td>';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<td>' . $value->task_name . '</td><td>' . $priority . '</td><td>';
            echo $task_deadline->format('l jS \of F Y h:i:s A');
            echo '</td><td>';
            echo $overdue_until->format('%R %a day/s, %h hours, %i minutes');
            echo '</td><td>' . $status . '</td>';
            echo '<td><a href="' . URL . 'task/edit_task/' . $value->list_id . '/' . $value->task_id . '" id="editLink">Edit</td>';
            echo '<td><a href="' . URL . 'task/delete_task/' . $value->list_id . '/' . $value->task_id . '" id="deleteLink">Delete</td>';
            echo '<td><a href="' . URL . 'task/mark_completed/' . $value->list_id . '/' . $value->task_id . '" id="completedLink">Completed</td>';
            echo '</tr>';

        }
        $counter++;
    }
} else {
    echo "<br><br>Add tasks!";
}?>
<div id="dispMsg">
<?php
$this->renderFeedback();
?>
</div>
</body>
</html>
