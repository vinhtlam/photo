<?php

$name = 'test';
$value = 'hello';
$expire = time() + (60*60*24*7); 	//add second
setcookie($name, $value, $expire);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://wwww.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Cookies</title>
	</head>
	<body>
		<?php
		$test = isset($_COOKIE['test']) ? $_COOKIE['test'] : "" ;
		echo $test;
		?>

		
	</body>
</html>