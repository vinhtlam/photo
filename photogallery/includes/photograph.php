<?php
//if it's goiong to need the database, then it's 
//probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');


class Photograph extends DatabaseObject{

	protected static $table_name="photographs";
	protected static $db_fields = array('id', 'filename', 'type', 'size', 'caption');

	public $id;
	public $filename;
	public $type;
	public $size;
	public $caption;
	
	private $temp_path;
	protected $upload_dir="images";
	public $error = array();

	protected $upload_errors = array(
		//upload error
		UPLOAD_ERR_OK			=> "No errors.",
	    UPLOAD_ERR_INI_SIZE		=> "Larger than upload_max_filesize.",
	    UPLOAD_ERR_FORM_SIZE	=> "Larger than form MAX_FILE_SIZE.",
	    UPLOAD_ERR_PARTIAL		=> "Partial upload.",
	    UPLOAD_ERR_NO_FILE		=> "No file.",
	    UPLOAD_ERR_NO_TMP_DIR	=> "No temporary directory",
	    UPLOAD_ERR_CANT_WRITE	=> "Can't write to disk,.",
	    UPLOAD_ERR_EXTENSION	=> "File upload stopped by extension."
	);

	//Pass in $_FILE(['upload_file']) as an argument
	public function attach_file($file){
		//perform error checking on the form parameters
		if(!$file || empty($file) || !is_array($file)) {
			//error : nothing updladed or wrong argument usage
			$this->errors[] = "No file was uploaded.";
			return false;
		} elseif($file['error'] != 0) {
			//error : report what php says went wrong
			$this->errors[] = $this->upload_errors[$file['error']];
			return false;
		} else {
			// Set object attributes to the form parameters.
			$this->temp_path = $file['tmp_name'];
			$this->filename = basename($file['name']);
			$this->type = $file['type'];
			$this->size = $file['size'];
			return true;
		}
		//Dont worry about saving anything to the database yet.
	}

	public function save(){
		//A new record wort have a id yet.
		if(isset($this->id)){
			$this->update();
		} else {
			//MAke sure there are no errors 
			//Cant save if there are pre-existing errors 
			if(!empty($this->errors)) {return false;}

			//Make sure caption is not too long for the DB
			if(strlen($this->caption) >= 255) {
				$this->errors[] = "The caption can only be 255 characters long.";
				return false;
			}
			//Cant save without file name and temp location
			if(empty($this->filename) || empty($this->temp_path) ) {
				$this->errors[] = "The file location was not avaibalbe.";
				return false;
			}

			//Detemine the target path
			$target_path = SITE_ROOT .DS. 'public' . DS. $this->upload_dir .DS.$this->filename;

			//Make sure file doesn't already exist in the target location
			if(file_exists($target_path)){
				$this->errors[] = "The file {$this->filename} already exists.";
				return false;
			}
			//attemp to move the file
			if(move_uploaded_file($this->temp_path, $target_path)){
				//success
				//save a corresponding entry to the database
				if($this->create()) {
					unset($this->temp_path);
					return true;
				}
			} else {
				//File was not moved
				$this->errors[] =  "The file upload failed, possibly due to incorrect permissions on the upload folder.";
				return false;
			}
		}
	}

	public function destroy() {
		//First remove the database entry
		if($this->delete()) {
			//then remove the file
			$target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
			return unlink($target_path) ? true : false;
		} else {
			//database delete failed
			return false;
		}
		
	}

	public function image_path() {
		return $this->upload_dir.DS.$this->filename;
	}

	public function size_as_text() {
		if($this->size <1024){
			return "{$this->size} bytes";
		} elseif($this->size <1048576) {
			$size_kb = round($this->size/1024);
			return "{$size_kb} bytes";
		} else {
			$size_mb = round($this->size/1048576, 1);
			return "{$size_mb} bytes";
		}
	}

	public function comments() {
		return Comment::find_comments_on($this->id); 
	}

//---------- Common Database Methods

	public static function find_all() {
		return static::find_by_sql("SELECT * FROM ".static::$table_name);
	}

	public static function find_by_id($id=0) {
		global $database;
		$result_array = static::find_by_sql("SELECT * FROM ".static::$table_name.
		" WHERE id=". $database->escape_value($id). " LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
		//array_shift pull the first element out of the array, we can also just return 
		//the index $result_array[0]
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

	// replace with a custom save()
	// public function save() {
	// 	//A new record won't have an id yet
	// 	return isset($this->id) ? $this->update() : $this->create();
	// }

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
		$sql .= join(", " .$attribute_pairs);
		
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