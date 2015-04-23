<?php

function script_zero_from_date ($marked_string = ""){
	// 1st remove marked 0
	$no_zero = str_replace("*0", "", $marked_string);
	// 2nd remove any remaining mark
	$cleaned_str = str_replace("*", "", $no_zero);

	return $cleaned_str;
}

function redirect_to($location=NULL) {
	if ($location!= NULL){
		header("Location: {$location}");
		exit;
	}
}

function output_message($message=""){
	if(!empty($message))
		{	return "<p class =\"message\"> {$message} </p>";
	}else{
		return "";
	}
}

function __autoload($class_name) {
	$class_name = strtolower($class_name);
	$path = LIB_PATH.DS."{$class_name}.php";
	if(file_exists($path)) {
		require_once($path);
	}else{
		die("The file {$class_name}.php could not be found.");
	}
}

function include_layout_template($template="") {
	include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}


function log_action($action, $message="") {
	
	//$record =  date("d/m/Y h:i:s a", time()). " :" . $action . " " . $message ;
	$logfile = SITE_ROOT.DS.'logs'.DS.'user.log';
	$new = file_exists($logfile) ? false : true;

	if($handle = fopen($logfile, 'a')){	//append
		$timestamp = strftime("%d-%m-%Y %H:%M:%S", time());
		$content = "{$timestamp} | {$action}: {$message}\n";
		fwrite($handle, $content);
		fclose($handle);
		if($new) { chmod($logfile, 0755);}

	} else {
		echo "Could not open file for writing";
	}
}

function datetime_to_text($datetime="") {
	$unixdatetime = strtotime($datetime);
	return strftime("%B %d %Y at %I:%M %p", $unixdatetime);
}

?>