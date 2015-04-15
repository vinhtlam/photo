<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://wwww.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Single Form</title>
	</head>
	<body>
		<?php
		require_once('validation_functions.php');

		$errors = array();

		//$username = trim($_POST["username"]);
		$username = trim("");

		if(!has_presence($username)){
			$errors['username'] = "Username can't be blank.";
		} else {
			echo "{$username} logged in.";
		}

		?>

		<?php echo form_errors($errors); ?>
	</body>
</html>