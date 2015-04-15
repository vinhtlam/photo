<?php
	require_once("included_functions.php");
	require_once("validation_functions.php");

	$errors = array();
	$message= "";

	if(isset($_POST['submit'])){
		//form was submitted
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
		
		//validation
		$fields_required = array("username", "password");
		foreach($fields_required as $field){
			$item = trim($_POST[$field]);
			if(!has_presence($item)){
				$errors[$field] = ucfirst($field) . " can't be blank.";
			}
		}

		//using an associ. array
		$fields_max_lengths = array("username" => 30, "password" => 8);
		validate_max_lengths($fields_max_lengths);

		if(empty($errors)){
			//try to login
			if($username =="vinh" && $password=="123"){
				//successful login
				redirect_to("basic.html");
			} else {		
			$message = "Username /password do not match.";
			}	
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
		<?php echo form_errors($errors); ?>
		<form action="form_validation.php" method="post"> <br />
		Username : <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" /> <br />
		Password : <input type="password" name="password" value="" /> <br />
		<br />
		<input type="submit" name="submit" value="Submit" />
		</form>
	
	</body>
</html>