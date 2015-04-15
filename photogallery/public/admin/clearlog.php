<?php
require_once('../../includes/initialize.php');

	if(clear_log()){
		$message = "Log succesful cleared.";
	} else {
		$message = "Log clear failed.";
	}
	$session->message = $message;
	redirect_to("index.php");

?>