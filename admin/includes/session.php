<?php

class Session {

	//Zelimo da bude session dostupna kad god je netko na nasoj stranici
	private $signed_in = false;
	public $user_id;
	public $message;
	public $count;

	function __construct() {

		session_start();
		$this->visitor_count();
		$this->check_the_login();
		$this->check_message();
	}

	//Getter function
	public function is_signed_in() {

		return $this->signed_in;
	}

	public function visitor_count() {

		if(isset($_SESSION['count'])) {

			return $this->count = $_SESSION['count']++;

		} else {

			return $_SESSION['count'] = 1;
		}
	}

	public function login($user) {

		if($user) {
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->signed_in = true;
		}
	}

	public function logout() {

		unset($_SESSION['user_id']);
		unset($this->user_id);
		$this->signed_in = false;
	}

	//Provjera da li je session user_id postavljen
	private function check_the_login() {

		if(isset($_SESSION['user_id'])) {

			$this->user_id = $_SESSION['user_id'];
			$this->signed_in = true;

		} else {

			unset($this->user_id);
			$this->signed_in = false;
		}
	}

	public function message($msg="") {

		if(!empty($msg)) {

			$_SESSION['message'] = $msg;
			
		} else {

			return $this->message;
		}
	}

	public function check_message(){

		if(isset($_SESSION['message'])) {

			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);
		} else {

			$this->message = "";
		}
	}

} // close Session class

$session = new Session();




?>