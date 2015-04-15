<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php 	confirm_logged_in(); ?>

<?php 
	if (isset($_GET["userid"])) {
		$admin = find_admin_by_id($_GET["userid"]);
	}else {
		// admin ID was missing or invalid or 
		// admin couldn't be found in database
		redirect_to("manage_admin.php");
	}
		
	$id = $admin["id"];
	$query = "DELETE FROM admins WHERE id = {$id} LIMIT 1";
	$result = mysqli_query($connection, $query);

	//CHECK does it change sth
	if($result && mysqli_affected_rows($connection)==1 ){
		// echo "Success!<br />";
		$_SESSION["message"] = "Admin deleted.";
		redirect_to("manage_admin.php");
	} else {
		//failure
		$_SESSION["message"] = "Admin deletion failed.";
		redirect_to("manage_admin.php");
	}
?>
