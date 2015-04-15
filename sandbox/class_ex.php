<html>
	<head>
		<title>Variable Scope</title>
	</head>
	<body>
	<?php
	
	class Person {


	}
	
	// $classes = get_declared_classes();
	// foreach ($classes as $class) {
	// 	# code...
	// 	echo $class . "<br />";
	// }

if(class_exists("Person")){
	echo "That class has been defined. <br />";
} else {
	echo "Class not defined! <br />";
}


	?>
	</body>
</html>