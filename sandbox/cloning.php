<?php

class Beverage {
	public $name;
	public $count;

	function __construct($def_name="Heiniken", $soluong=10){

		echo "Construct method <br />";
		$this->name = $def_name;
		$this->count = $soluong;
	}

	function __clone(){
		
		echo "Clone Bla bla bla. <br />";
	}

}

$bia1 = new Beverage();

$bia2 = new Beverage("Saigon",20);

$bia3 = clone $bia1;

// $bia3->name = "Tiger";
// $bia3->count = 30;

echo "Bia 1 : " .$bia1->name . " and quantity :". $bia1->count. "<br />";

echo "Bia 2 : " .$bia2->name . " and quantity :". $bia2->count. "<br />";

echo "Bia 3 : " .$bia3->name . " and quantity :". $bia3->count. "<br />";



?>