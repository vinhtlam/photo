<html>
	<head>
		<title>Variable Scope</title>
	</head>
	<body>
	<?php
	
	class Person {
		function say_hello(){
			echo "HEllo from inside a class. ". get_class($this) ."<br />";
		}
		function hello(){
			$this->say_hello();
		}
	}

	$person = new Person();
	$person->say_hello();
	$person->hello();

	?>
	</body>
</html>