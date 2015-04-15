<?php
//is presence, empty() would consider "0" to be empty
function has_presence($value){
	return isset($value) && $value !== "";
}
	
// * string length still within max length
function has_max_length($value, $max){
	return (strlen($value) <= $max);
}

//* inclusion in a set
function has_inclusion_in($value, $set){
	return in_array($value,$set);
}

function validate_max_lengths($fields_max_lengths){
	global $errors;
	//use assoc. array
	foreach($fields_max_lengths as $field => $max){
		$item = trim($_POST[$field]);
		if(!has_max_length($item, $max)){
			$errors[$field] = ucfirst($field) . " is too long.";
		}
	}
}


function form_errors($errors=array()){
	$output = "";
	if(!empty($errors)){
		$output .= "<div class=\"error\">";
		$output .= "Please fix the following errors:";
		$output .= "<ul>";

		foreach ($errors as $key => $error) {
			$output .= "<li>{$error}</li>";
		}

		$output .= "</ul>";
		$output .= "</div>";
	}
	return $output;
}

?>