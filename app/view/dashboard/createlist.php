<!DOCTYPE html>
<html>
<head>
	<title>Create list</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/app/resources/css/style.css" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<body>
	<div id="createListContainer">
		<form action="<?php echo URL;?>dashboard/new_list" method="POST" id="form">
			<label>Enter list name:</label>
			<input type="text" name="list_name" autofocus required>
			<input type="Submit" name="create" value="Create new list" id="createlistBtn">
		</form>
	</div>
</body>
</html>