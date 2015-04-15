<?php

$errors = array();

function fieldname_as_text($fieldname) {

	$fieldname = str_replace("_", " ", $fieldname);
	$fieldname = ucfirst($fieldname);
	return $fieldname;
}

//is presence, empty() would consider "0" to be empty
function has_presence($value){
	return isset($value) && $value !== "";
}
	
// * string length still within max length
function has_max_length($value, $max){
	return (strlen($value) <= $max);
}

function validate_presences($required_fields) {

	global $errors;
	foreach ($required_fields as $field) {
		$value = trim($_POST[$field]);
		if(!has_presence($value)) {
			$errors[$field] = fieldname_as_text($field). " can't be blank";
		}
	}
}

function validate_max_lengths($fields_max_lengths){
	global $errors;
	//use assoc. array
	foreach($fields_max_lengths as $field => $max){
		$item = trim($_POST[$field]);
		if(!has_max_length($item, $max)){
			$errors[$field] = fieldname_as_text($field) . " is too long.";
		}
	}
}

//* inclusion in a set
function has_inclusion_in($value, $set){
	return in_array($value,$set);
}

?>