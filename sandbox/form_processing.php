<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://wwww.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Single Form</title>
	</head>
	<body>
		
		<pre>
		<?php
			print_r($_POST);
		?>
		</pre>

		<form action="form_single.php" method="post">
		Username: <input type="text" name="username" value="" /> <br />
		Password: <input type="password" name="password" value="" /> <br />
		<br />
		<input type="submit" name="submit" value="Submit" />
		</form>

	</body>
</html>