<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php 	confirm_logged_in(); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php 
	$admin = find_admin_by_id($_GET["userid"]);
	if(!$admin) {
		// admin ID was missing or invalid or 
		// admin couldn't be found in database
		redirect_to("manage_admin.php");
	}
?>

<?php
	if(isset($_POST['submit'])){
		//valications
		$required_fields = array("username", "password");
		validate_presences($required_fields);

		$fields_with_max_lengths = array("username" => 20);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)) {
			//process the form
			$id = $admin["id"];
			$username = mysql_prep($_POST["username"]);
			$hashed_password = password_encrypt($_POST["password"]);

			$query = "UPDATE admins SET ";
			$query .= "username = '{$username}', ";
			$query .= "hashed_password = '{$hashed_password}' ";
			$query .= "WHERE id = {$id} ";
			$query .= "LIMIT 1";
			
			$result = mysqli_query($connection, $query);

			if($result && mysqli_affected_rows($connection)==1){
				// echo "Success!<br />";
				$_SESSION["message"] = "User updated.";
				redirect_to("manage_admin.php") ;
			} else {
				//failure
				$message = "User update failed." . mysqli_error($connection) ;
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
		<h2>Edit admin user</h2>
		<form action="edit_admin.php?userid=<?php echo htmlentities($admin["id"])?>" method="post">
			<p>Username:	<input type="text" name="username" value="<?php echo htmlentities($admin["username"]); ?>" />
			</p>
			<p>Password:	<input type="password" name="password" value="" />
			</p>
			<input type="submit" name="submit" value="Edit Admin" />
		</form>
		<br />
		<a href="manage_admin.php">Cancel</a>
	</div>	
</div>
<?php include("../includes/layout/footer.php"); ?>
