<?php
	require_once("included_functions.php");

	if(isset($_POST['submit'])){
		//form was submitted
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		if($username =="vinh" && $password=="123"){
			//successful login
			redirect_to("basic.html");
		} else {		
		$message = "There was some errors";
		}	

	} else {
		$username = "";
		$message = "Please log in.";
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://wwww.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Single Form</title>
	</head>
	<body>
		<?php echo $message; ?><br />
		<form action="form_single.php" method="post"> <br />
		Username : <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" /> <br />
		Password : <input type="password" name="password" value="" /> <br />
		<br />
		<input type="submit" name="submit" value="Submit" />
		</form>
	
	</body>
</html>