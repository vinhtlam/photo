<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php 	confirm_logged_in(); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php 	find_seleted_page(false); ?>

<?php 
	if(isset($current_subject)) {
		$subject_id = $current_subject["id"];
	} else {
		// subject ID was missing or invalid or 
		// subject couldn't be found in database
		redirect_to("manage_content.php");
	}

	if(isset($_POST['submit'])){
		//process the form
		//$subject_id = $current_subject["id"];
		$menu_name = mysql_prep($_POST["menu_name"]);
		$position = (int) $_POST["position"];
		$visible = (int) $_POST["visible"];
		$content = mysql_prep($_POST["content"]);

	//valications
	$required_fields = array("menu_name", "position", "visible");
	validate_presences($required_fields);

	$fields_with_max_lengths = array("menu_name" => 30);
	validate_max_lengths($fields_with_max_lengths);

	if(!empty($errors)) {
		$_SESSION["errors"] = $errors;
		redirect_to("manage_content.php");
	} 

	$query = "INSERT INTO pages (";
	$query .= " subject_id, menu_name, position, visible, content ";
	$query .= ") VALUES (";
	$query .= " {$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}'";
	$query .= ")";
	
	$result = mysqli_query($connection, $query);

	if($result){
		// echo "Success!<br />";
		$_SESSION["message"] = "Page successful created.";
		redirect_to("manage_content.php");
	} else {
		//failure
		$_SESSION["message"] = "Page creation failed. Result " . $result;
		 die ("Database query failed. ". mysqli_error($connection));
		 //redirect_to("manage_content.php");
	}
} else {
	//This is probably a GET request
	redirect_to("new_page.php");
}
	
?>


<?php
	//5. Close connection & check connection
	if(isset($connection)){
		mysqli_close($connection);
	}

?>