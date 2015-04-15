<?php
//1. connect database
	
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
		//2. perform database query
		$query = "SELECT * ";
		$query .= "FROM subjects ";
		$query .= "WHERE visible = 1 ";
		$query .= "ORDER BY position ASC";
		$result = mysqli_query($connection, $query);
		if(!$result){
			die ("Database query failed.");
		}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://wwww.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>BD</title>
	</head>
	<body>
		
		<ul>
		<?php
			//3. Use return data
			while($subjects = mysqli_fetch_assoc($result)){
				//output data from each row
		?>
			<li><?php echo $subjects["menu_name"] . " (" . $subjects["id"] . ")"; ?> 		
			</li>

		<?php
			}
		?>
		</ul>

		<?php
			//4. release returned data
			mysqli_free_result($result);
		?>
	</body>
</html>

<?php
	//5. Close connection
	mysqli_close($connection);

?>