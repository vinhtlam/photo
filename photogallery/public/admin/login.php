<?php 	
require_once("../../includes/initialize.php");
require_once('../../includes/functions.php');

if($session->is_logged_in()) {
	redirect_to("index.php");
}

$username = "";
if(isset($_POST['submit'])){
		//Process the form -- valications
		// $required_fields = array("username", "password");
		// validate_presences($required_fields);

//if(empty($errors)) {
			//Attempt Login

	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);

	//Check database to see if username/password exists
	$found_user = User::authenticate($username, $password);

	if($found_user) {
	//success //mark as logged in
		$session->login($found_user);
		log_action('Login', "{$username} logged in.\n");
		redirect_to("index.php") ;
	} else {
	//failure username/password combo was not found in the database
		$message = "Username/password incorrect.";
		$message1 = $username . " attempt.\n";
		log_action('Failed login', $message1);
	}	
} else {
	//Form has not been submitted. (This is probably a GET request)
	$username = "";
	$password = "";
}	// end of if(isset($_POST['submit']) 

?>
<?php include_layout_template("admin_header.php"); ?>
<div id ="main">
	
	<div id="page">
	<?php //$message is just a variable, does't use the SESSION
			if(!empty($message)) {
				echo "<div class=\"message\">" . htmlentities($message) . "</div>";
			}
			//echo form_errors($errors); ?>
		<h2>Staff Login</h2>
		<form action="login.php" method="post">
		<table>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="username" value="<?php echo htmlentities($username) ?>" /></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" value="" /></td>
			</tr>
			<tr><td><input type="submit" name="submit" value="Submit" /></td></tr>
		</table>
		</form>
	</div>	
</div>
<?php include_layout_template("admin_footer.php"); ?>

<?php if(isset($database)) { $database->close_connection(); } ?>