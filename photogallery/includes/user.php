<?php
//if it's goiong to need the database, then it's 
//probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class User extends DatabaseObject {

	protected static $table_name="users";
	protected static $db_fields = array('id', 'username', 'password', 'first_name', 'last_name');

	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $array_test = array();

	public function full_name() {
		if(isset($this->first_name) && isset($this->last_name)) {
			return $this->first_name . " " . $this->last_name;
		} else {
			return "abc";
		}
	}

	public static function authenticate($username="", $password="") {
		global $database;
		$username = $database->escape_value($username);
		$password = $database->escape_value($password);
		
		$sql = "SELECT * FROM users ";
		$sql .= "WHERE username = '{$username}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";

		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	

//-----------------------------------------
	// Common Database Methods

	public static function find_all() {
		return static::find_by_sql("SELECT * FROM ".static::$table_name);
	}

	public static function find_by_id($id=0) {
		global $database;
		$result_array = static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
		//array_shift pull the first element out of the array, we can also just return the index $result_array[0]
	}

	public static function find_by_sql($sql="") {
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();
		while($row = $database->fetch_array($result_set)){
			$object_array[] = static::instantiate($row);
		}
		return $object_array;
	}

	private static function instantiate($record) {
		//Could check that $record exists and is an array
		// Simple, long-form approach:

		$class_name = get_called_class();
		$object = new $class_name;
		/*		$object->id 			= $record['id'];
		$object->username 	= $record['username'];
		$object->password 	= $record['password'];
		$object->firstname 	= $record['first_name'];
		$object->lastname 	= $record['last_name'];*/
		//More dynamic, short-form approach:
		foreach($record as $attribute=>$value) {
			if($object->has_attribute($attribute)) {
				$object->$attribute = $value;
			}
		}
		return $object;
	}

	private function has_attribute($attribute){
		//get_object_vars return an associative array with all atributes
		//incl. private ones!) as the keys and their current values as the value
		$object_vars = $this->attributes();
		//We dont care about the value, we just want to know if the key exists
		//Will return true or false
		return array_key_exists($attribute, $object_vars);
	}

	public function attributes() {
		//return an array of attribute keys and their values
		$attributes = array();
		foreach(self::$db_fields as $field) {
			if(property_exists($this, $field)) {
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	
	protected function sanitized_attributes() {
		global $database;
		$clean_attributes = array();
		// sanitize the values before submitting
		// Note " does not alter the actual value of each attribute"
		foreach($this->attributes() as $key => $value) {
			$clean_attributes[$key] = $database->escape_value($value);
		}

		return $clean_attributes;
	}

	//--------------------------

	
	public function save() {
		//A new record won't have an id yet
		return isset($this->id) ? $this->update() : $this->create();
	}

	public function create(){
		global $database;

		$attributes = $this->sanitized_attributes();

		$sql = "INSERT INTO " . self::$table_name . " (";
		$sql .= join(", ", array_keys($attributes));
		//"username, password, first_name, last_name";
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";

		// $sql .= $database->escape_value($this->username). "', '" ;
		// $sql .= $database->escape_value($this->password). "', '" ;
		// $sql .= $database->escape_value($this->first_name). "', '" ;
		// $sql .= $database->escape_value($this->last_name). "')";
		
		if($database->query($sql)) {
			$this->id = $database->insert_id();
			return true;
		} else {
			return false;
		}

	}

	public function update(){
		global $database;

		//UPDATE table SET key = 'value', key = 'value' WHERE condition
		//single=quotes around all values
		//escape all values to prevent SQL injection.
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = $array();

		foreach($attributes as $key => $value) {
			$attribute_pairs[] = "{$key} = '{$value}'";
		}

		$sql = "UPDATE ". self::$table_name . " SET ";
		$sql .= join(", ", $attribute_pairs);
		
		// $sql .= "username='". $database->escape_value($this->username). "', ";
		// $sql .= "password='". $database->escape_value($this->password). "', ";
		// $sql .= "first_name='". $database->escape_value($this->first_name). "', ";
		// $sql .= "last_name='". $database->escape_value($this->last_name). "' ";
		$sql .= " WHERE id=". $database->escape_value($this->id);
		
		$database->query($sql);
		return ($database->affected_rows()==1)? true: false;
	}

	public function delete(){
		global $database;
		
		//DELETE FROM table WHERE condition LIMIT 1
		$sql = "DELETE FROM ". self::$table_name ;
		$sql .= " WHERE id=". $database->escape_value($this->id);
		$sql .= " LIMIT 1";

		$database->query($sql);
		return ($database->affected_rows()==1)? true: false;
	}

}
?>