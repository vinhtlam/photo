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

	$person = new Person();
	$person2 = new Person();

	echo get_class($person). "<br />";

	if (is_a($person, 'PErson')){
		echo "Yup, it is a Person.<br />";
	} else {
		echo "Not a person.<br />";
	}

	$person->say_hello();

	?>
	</body>
</html>