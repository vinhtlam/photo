<?php

$dbhost = "localhost";
$dbuser = "widget_cms";
$dbpass = "secretpassword";
$dbname = "widget_corp";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//test if connection occurred.
if(mysqli_connect_errno()){
	die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")"
	);
}
?>

<?php 
	$id = 5;
	$menu_name = "Delete me";
	$position =	5;
	$visible = 1;

	//2. perform database query
	$query = "UPDATE subjects SET ";
	$query .= "menu_name = '{$menu_name}', ";
	$query .= "position = {$position}, ";
	$query .= "visible = {$visible} ";
	$query .= "WHERE id = {$id}";

	$result = mysqli_query($connection, $query);

	if($result && mysqli_affected_rows($connection) == 1){
		//success -> redirect 
		//redirect_to("somepage.php");
		echo "Success!<br />";
	} else {
		//failure
		//$message = "Subject creation failed"
		die ("Database query failed. ". mysqli_error($connection));

	}

	$id = mysqli_insert_id($connection);
	if($id){
		echo "updated ID: ". $id;
	}	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://wwww.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>BD update
		</title>
	</head>
	<body>
		
		
	</body>
</html>

<?php
	//5. Close connection
	mysqli_close($connection);

?>