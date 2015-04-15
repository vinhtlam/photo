<html>
	<head>
		<title>Arrays</title>
	</head>
	<body>
	<?php
	$numbers = array(1,2,3,4,5,6);
	print_r($numbers);
	echo "<br /><br />";

	//shift first element
	//and returns it.
	$a = array_shift($numbers);
	echo "a:" . $a . "<br />";
	print_r($numbers);
	echo "<br /><br />";

	//prepends an element to an array
	//returns the element count.

	$b = array_unshift($numbers,'first');
	echo "b:". $b . "<br />";
	print_r($numbers);
	echo "<br /><br />";	

	$c = array_pop($numbers);
	echo "c:". $c . "<br />";
	print_r($numbers);
	echo "<br /><br />";

	$d = array_push($numbers, 'last');
	echo "c:". $c . "<br />";
	print_r($numbers);
	echo "<br /><br />";
	?>
	</body>
</html>