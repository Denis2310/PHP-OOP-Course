<?php


class Db_object {

//Dohvat svih usera iz baze podataka
public static function find_all() {

	return static::find_by_query("SELECT * FROM " . static::$db_table);
}


public static function find_by_id($id) {

	$the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE  id={$id} LIMIT 1");

	return !empty($the_result_array) ? array_shift($the_result_array) : false;

}


public static function find_by_query($sql) {

	global $database;
	
	$result_set = $database->query($sql);
	
	if(empty($result_set)) { return false; }	

	$the_object_array = array();
	while($row = mysqli_fetch_array($result_set)) {

		$the_object_array[] = static::instantation($row);

	}

	return $the_object_array;
}


public static function instantation($the_record) {

	$calling_class = get_called_class();

	$the_object = new $calling_class;

	foreach($the_record as $attribute => $value) {

		if($the_object->has_the_attribute($attribute)) {
			$the_object->$attribute = $value;
		}
	}
	return $the_object;

}

public static function count() {

	global $database;

	$sql = "SELECT count(*) FROM " . static::$db_table;
	$result = $database->query($sql);

	$result = mysqli_fetch_array($result);
	
	return $result[0];
} 


protected function has_the_attribute($attribute) {

	$object_properties = get_object_vars($this);

	return array_key_exists($attribute, $object_properties);
}


protected function properties() {

	$properties = array();

	foreach(static::$db_table_fields as $db_field) {

		if(property_exists($this, $db_field)) {

			$properties[$db_field] = $this->$db_field;
		}
	}

	return $properties;
}

protected function clean_properties() {

	global $database;

	$clean_properties = array();
	$properties = $this->properties();

	foreach($properties as $key => $value) {

		$clean_properties[$key] = $database->escape_string($value);
	}

	return $clean_properties;
}


public function save() {

	return isset($this->id) ? $this->update() : $this->create();
}
//Razmisliti jer moja je ideja da ta funkcija bude static i onda joj prosljedim parametre username password
//firstname i lastname i ona odma kreira usera pa se ne mora kreirati instanca.
public function create() {

	global $database;

	$properties = $this->clean_properties();

	$sql = "INSERT INTO " .static::$db_table. "(". implode(",", array_keys($properties)) . ")";
	$sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";


	if($database->query($sql)) {

		$this->id = $database->insert_id();
		return true;
	} else {

		return false;
	}
} // Create method

public function update() {

	global $database;

	$properties = $this->clean_properties();
	$properties_pairs = array();

	foreach ($properties as $key => $value) {

		$properties_pairs[] = "$key = '$value'";
	}

	$sql = "UPDATE " .static::$db_table. " SET ";
	$sql .= implode(",", $properties_pairs) . " ";
	$sql .= "WHERE id =" . $database->escape_string($this->id);


	$database->query($sql);

	//Provjera da li ima redaka koji su izmjenjeni
	return (mysqli_affected_rows($database->connection))? true : false;
}

public function delete() {

	global $database;

	$sql = "DELETE FROM " .static::$db_table . " WHERE id = " . $database->escape_string($this->id);
	$database->query($sql);

	return(mysqli_affected_rows($database->connection) == 1) ? true : false;
}




}

?>
