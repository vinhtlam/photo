<?php
//static

class Student {

	static $total_students=0;

	static public function add_student(){
		Student::$total_students++;
		
	}
	static public function welcome_students($var="Hello"){

		echo "{$var} students.";
	}
}

echo Student::$total_students."<br />";
echo Student::welcome_students() ."<br />";
echo Student::welcome_students("Hola") ."<br />";
echo "<br />";

Student::$total_students=1;

echo Student::$total_students ."<br />";

Student::add_student();

echo Student::$total_students ."<br />";

// static variable are shared throughout the inheritance tree.
echo "<br />";

$make::an_error();

class One{
	static $foo;

}

class Two extends One {}

class Three extends Two{}

One::$foo = 1;
Two::$foo = 2;
Three::$foo = 3;

echo One::$foo. "<br />";
echo Two::$foo. "<br />";
echo Three::$foo. "<br />";




?>
