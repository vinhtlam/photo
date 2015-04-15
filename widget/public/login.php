<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
	$username = "";
	if(isset($_POST['submit'])){
		//Process the form

		//valications
		$required_fields = array("username", "password");
		validate_presences($required_fields);

		if(empty($errors)) {
			//Attempt Login
			$username = ($_POST["username"]);
			$password = ($_POST["password"]);

			$found_admin = attempt_login($username, $password);

			if($found_admin) {
				//success
				//mark as logged in
				$_SESSION["admin_id"] = $found_admin["id"];
				$_SESSION["username"] = $found_admin["username"];
				redirect_to("admin.php") ;
			} else {
				//failure
				$_SESSION["message"] = "Username/password incorrect.";
			}
		}
	} else {
		//This is probably a GET request
	}	// end of if(isset($_POST['submit']) 

?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layout/header.php"); ?>
<div id ="main">
	
	<div id="page">
	<?php //$message is just a variable, does't use the SESSION
			if(!empty($message)) {
				echo "<div class=\"message\">" . htmlentities($message) . "</div>";
			}
		?>
		<?php 	echo form_errors($errors); ?>
		<h2>Login</h2>
		<form action="login.php" method="post">
			<p>Username:	<input type="text" name="username" value="<?php echo htmlentities($username) ?>" />
			</p>
			<p>Password:	<input type="password" name="password" value="" />
			</p>
			<input type="submit" name="submit" value="Submit" />
		</form>
	</div>	
</div>
<?php include("../includes/layout/footer.php"); ?>
