<html>
	<head>
		<title>Dates and Times</title>
	</head>
	<body>

<?php

class car {
	var $wheel = 4;
	var $door	= 5;

	function wheeldoor(){
		return $this->wheel + $this->door;
	}
}

class compactcar extends car{
	var $door = 2;

	function wheeldoor(){
		return $this->wheel + $this->door + 1;
	}

}

$car1 = new car();
$car2 = new compactcar();

echo $car1->wheel . "<br />";
echo $car1->door . "<br />";
echo $car1->wheeldoor() . "<br />";
echo "<br />";

echo $car2->wheel . "<br />";
echo $car2->door . "<br />";
echo $car2->wheeldoor() . "<br />";
echo "<br />";

echo "Car parent: " . get_parent_class('car') ."<br />";
echo "CompactCar parent: " . get_parent_class('compactcar') ."<br />";
echo "<br />";

echo is_subclass_of('car', 'car') ? 'true': 'false' ."<br />";
echo "<br />"; 

echo is_subclass_of('compactcar', 'car') ? 'true': 'false' ."<br />";
echo "<br />"; 

echo is_subclass_of('car', 'compactcar') ? 'true': 'false' ."<br />";
echo "<br />"; 

?>

</body>
</html>