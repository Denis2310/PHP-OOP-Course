<?php

//Ako vec nije ukljucen new_config u ovaj php onda ga zatraži
require_once('database_configuration.php');

class Database{

	//Promjeniti private u public
	public $connection;

	//Otvori konekciju automatski cim se pokrene ovaj file
	public function __construct(){
		
		$this->open_db_connection();
	}


	public function open_db_connection(){

		//Konstante iz database_configuration.php datoteke
		//U connection se sprema objekt
		$this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
		if($this->connection->connect_errno){
			die ('Database connection failed!'. $this->connection->connect_error);
		}
	}

	public function query($sql){

		$result = $this->connection->query($sql);
		return $result;
	}

	private function confirm_query($result){

		if(!$result){
			die('Query failed!' . $this->connection->error);
		}
	}

	public function escape_string($string) {

		$escaped_string = $this->connection->real_escape_string($string);
		return $escaped_string;
	}


	public function insert_id() {

		return $this->connection->insert_id;  //insert_id dohvaca id od zadnjeg query
	}

} //Zatvaranje klase database

//Najbolje je odma napraviti objekt kojeg mozemo koristiti
$database = new Database();





?>