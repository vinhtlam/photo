<?php

class ex {

	public $a =1;
	protected $b = 2;
	private $c	= 3;

	function show_abc(){
		echo $this->a;
		echo $this->b;
		echo $this->c;
	}

	public function hello1(){
		return "Hello everyone.<br />";
	}

	protected function hello2(){
		return "Hello family.<br />";
	}

	private function hello3(){
		return "Hello me.<br />";
	}

	function hello(){
		$output = $this->hello1();
		$output .= $this->hello2();
		$output .= $this->hello3();
		return $output;
	}

}

class small extends ex{

}

$example = new ex();
echo "public a: {$example->a} <br />";
// echo "protected b: {$example->b} <br />";
// echo "private c: {$example->c} <br />";
echo "<br />";

$example->show_abc();
echo "<br />";

echo "hello_1: {$example->hello1()}<br />";
// echo "hello_2: {$example->hello2()}<br />";
// echo "hello_3: {$example->hello3()}<br />";
echo "<br />";
echo $example->hello();
echo "---------- Tiny <br />";

$tiny = new small();

echo "small public a: {$tiny->a} <br />";
// echo "small protected b: {$tiny->b} <br />";
echo "small private c: {$tiny->c} <br />";
echo "<br />";
$tiny->show_abc();
echo "<br />";

echo "small hello_1: {$tiny->hello1()}<br />";
// echo "hello_2: {$example->hello2()}<br />";
// echo "hello_3: {$example->hello3()}<br />";


echo $tiny->hello();
echo "<br />";
?>
