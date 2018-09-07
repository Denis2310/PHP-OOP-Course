<?php

class User extends Db_object {


protected static $db_table = "users";
//Ovdje dodao user_image i sada se doda ime slike u tablicu, ali zasto?? gdje je taj dio koda
protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');

public $id;
public $username;
public $password;
public $first_name;
public $last_name;
public $user_image;

public $upload_directory = "user_images";



public static function verify_user($username, $password) {
	
	global $database;

	$username = $database->escape_string($username);
	$password = $database->escape_string($password);

	$sql = "SELECT * FROM " . self::$db_table ." WHERE ";
	$sql .= "username = '$username' AND ";
	$sql .= "password = '$password'";

	$the_result_array = self::find_by_query($sql);
	return !empty($the_result_array) ? array_shift($the_result_array) : false;

}

public function upload_image($image) {

	$image_tmp_name = $image['tmp_name'];
	$image_real_name = $image['name'];
	
	if(move_uploaded_file($image_tmp_name, SITE_ROOT.DS.$this->upload_directory.DS.$image_real_name)) {

		return $this->user_image = $image_real_name;
	}




}


} //End of user class



?>