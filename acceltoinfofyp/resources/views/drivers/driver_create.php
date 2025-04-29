

<!DOCTYPE html>
<html>
<head>
<title>Add Driver to Database</title>
</head>
<body>
<form action = "/insertDriver" method = "post">
	<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
	<table>
	<tr>
	<td> Driver Name</td>
	<td><input type='text' name='name' /></td>
	<tr>
	<td>Current Team</td>
	<td><input type='text' name='team' /></td>
	<tr>
	<td colspan = '2'>
	<input type = 'submit' value = "Add Driver"/>
	</td>
	</tr>
	</table>
</form>
</body>
</html>