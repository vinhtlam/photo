<?php require_once("../../includes/initialize.php"); ?>

<?php
	
	$session->logout();
	redirect_to("../index.php");

?>

<?php 
	//v2: destroy session
	//assume noting else in session to keep
/*	session_start();
	$_SESSION = array();
	if(isset($COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy();
	redirect_to("login.php");*/
?>
