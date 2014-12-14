<!DOCTYPE html>
<html>
<head>
	<title>Dashboard view</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/app/resources/css/dashstyle.css" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<body>

	<div id="container">
		<div  id="greetingMsg">
<?php echo "Hello, " . $_SESSION['user_name'] . '!';?>
		</div>
		<div id="header">
			<div id="menu">
				<a href="<?php echo URL;?>dashboard/create_list">Create new list</a>
			</div>
			<div id="manipulate">
				<form action="<?php echo URL;?>login/logout">
					<input type="Submit" name="Logout" value="Logout" id="btnLogout">
				</form>
				<form action="<?php URL;?>dashboard" method="GET" id="select">
					<select name="sort_list" id="selectSortList">
						<option value="" selected="selected">Sort by:</option>
					    <option value="byName">Name</option>
					    <option value="byTime">Date</option>
					</select>
				</form>
			</div>
		</div>
		<table  cellspacing='0'><tr><th>List Name</th><th>Time Created</th><th>Number of Tasks</th><th>Number of Uncompleted Tasks</th><th>Progress in percentage</th></tr>

<?php

$counter = 0;

if (!empty($this->list)) {
    foreach ($this->list as $key => $value) {

        $list_time_created = strtotime($value->list_time_created);
        $progress          = (0 < $value->number_of_tasks) ? round(((($value->number_of_tasks - $value->number_of_uncompleted_tasks) / $value->number_of_tasks) * 100), 2) : '0';

        if ($counter % 2 == 0) {
            echo '<tr class="even">';
            echo '<td><a href="' . URL . 'task/show_list/' . $value->list_id . '">' . $value->list_name . '</a></td><td>' . date('l jS \of F Y h:i:s A', $list_time_created) . '</td><td>' . $value->number_of_tasks . '</td><td>' . $value->number_of_uncompleted_tasks . '</td><td>' . $progress . ' %</td>';
            echo '<td><a href="' . URL . 'dashboard/delete_list/' . $value->list_id . '">Delete';
            echo '</tr>';
        } else {
            echo '<tr>';
            echo '<td><a href="' . URL . 'task/show_list/' . $value->list_id . '">' . $value->list_name . '</a></td><td>' . date('l jS \of F Y h:i:s A', $list_time_created) . '</td><td>' . $value->number_of_tasks . '</td><td>' . $value->number_of_uncompleted_tasks . '</td><td>' . $progress . '</td>';
            echo '<td><a href="' . URL . 'dashboard/delete_list/' . $value->list_id . '">Delete';
            echo '</tr>';
        }
    }
} else {
    echo "Create your first todo list!";
}
?>
</div>
<div id="dispMsg">
<?php $this->renderFeedback();?>
</div>
<script type="text/javascript" src="/app/resources/javascript/main.js"></script>

</body>
</html>
