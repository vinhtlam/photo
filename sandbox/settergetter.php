<?php
//setters and getters

class SetterGetter {

	private $a=1;

	public function get_a(){
		// log_users_ip_address
		return $this->a;
	}

	public function set_a($value){
		$this->a = $value;
	}
}

$example = new SetterGetter();

 //restricted: 
// echo $example->a . "<br />";

echo $example->get_a() . "<br />";
echo $example->set_a(15);
echo $example->get_a() . "<br />";
// echo "<br />";
?>
