<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php 	confirm_logged_in(); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
	if(isset($_POST['submit'])){
		//valications
		$required_fields = array("username", "password");
		validate_presences($required_fields);

		$fields_with_max_lengths = array("username" => 20);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)) {
			//process the form
			$username = mysql_prep($_POST["username"]);
			$hashed_password = password_encrypt($_POST["password"]);

			$query = "INSERT INTO admins (";
			$query .= "username,hashed_password";
			$query .= ") VALUES (";
			$query .= " '{$username}', '{$hashed_password}' ";
			$query .= ")";
			
			$result = mysqli_query($connection, $query);

			if($result && mysqli_affected_rows($connection)==1){
				// echo "Success!<br />";
				$_SESSION["message"] = "User created.";
				redirect_to("manage_admin.php") ;
			} else {
				//failure
				$message = "User creation failed.";
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
		<h2>Create new admin</h2>
		<form action="new_admin.php" method="post">
			<p>Username:	<input type="text" name="username" value="" />
			</p>
			<p>Password:	<input type="password" name="password" value="" />
			</p>
			<input type="submit" name="submit" value="Create User" />
		</form>
		<br />
		<a href="manage_admin.php">Cancel</a>
	</div>	
</div>
<?php include("../includes/layout/footer.php"); ?>
