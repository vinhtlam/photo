<html>
	<head>
		<title>Variable Scope</title>
	</head>
	<body>
	<?php
	
	class Person {
		function say_hello(){
			echo "HEllo from inside a class. <br />";
		}

	}
	
	$methods = get_class_methods('Person');
	foreach($methods as $method){
		echo $method . "<br />";
	}

	if(method_exists('Person', 'say_hello')) {
		echo "Method does exist. <br />";
	} else {
		echo "Method does not exist.<br />";
	}


	?>
	</body>
</html>