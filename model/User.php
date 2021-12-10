<?php

require_once 'connection.php';

class User {
	private $name = null;
	private $surname = null;
	private $mail = null;
	private $password = null;
	private $valid = null;
	private $role_id = null;

	// Getters
	public function get_name() {
		return $this->name;
	}

	public function get_surname() {
		return $this->surname;
	}

	public function get_mail() {
		return $this->mail;
	}

	public function get_password() {
		return $this->password;
	}

	public function get_valid() {
		return $this->valid;
	}

	public function get_role_id() {
		return $this->role_id;
	}

	// Setters
	public function set_name($name) {
		return $this->name = $name;
	}

	public function set_surname($surname) {
		return $this->surname = $surname;
	}

	public function set_mail($mail) {
		return $this->mail = $mail;
	}

	public function set_password($password) {
		return $this->password = $password;
	}

	public function set_valid($valid) {
		return $this->valid = $valid;
	}

	public function set_role_id($role_id) {
		return $this->role_id = $role_id;
	}

	public function save_to_database() {
		try {
			$connection = get_database();
			$sql = "INSERT INTO User (name, surname, mail, password, valid, Role_id) VALUES ($this->name, $this->surname, $this->mail, $this->password, $this->valid, $this->role_id)";
			$result = $connection->query($sql);
			
			$connection->close();
		} catch (Exception $e) {
			return false;
		}

		return true;
	}

	public function get_role($mail) {
		$connection = get_database();
		$sql = "SELECT role FROM Role WHERE id = (SELECT Role_id FROM User WHERE mail = \"$mail\")";
		$result = $connection->query($sql);
		
		$connection->close();

		return $result->fetch_row()[0];
	}

	public function get_user_comment($user_id) {
		$connection = get_database();
		$sql = "SELECT content, creation_date, modification_date, Blog_Post_id FROM Comment WHERE User_id = $user_id and is_deleted = 0";
		$result = $connection->query($sql);
		
		$connection->close();
		
		return $result->fetch_all();
	}

	public function get_user_blog_post($user_id) {
		$connection = get_database();
		$sql = "SELECT creation_date, last_modification, title, chapo, content FROM Blog_Post WHERE User_id = $user_id and is_deleted = 0";
		$result = $connection->query($sql);
		
		$connection->close();
		
		return $result->fetch_all();
	}

	public static function get_user($user_id) {
		$connection = get_database();
		$sql = "SELECT name, surname, mail, valid FROM User WHERE id = $user_id";
		$result = $connection->query($sql);
		
		$connection->close();
		
		return $result->fetch_row();
	}

	public static function register_user($name, $surname, $mail, $password) {
		$connection = get_database();
		$sql = "INSERT INTO User (name, surname, mail, password, valid, Role_id) VALUES (\"$name\", \"$surname\", \"$mail\", \"$password\", 1, 3);";
		$result = $connection->query($sql);

		$connection->close();
		
		return $result;
	}

	public static function login_user($mail, $password) {
		$connection = get_database();
		$sql = "SELECT password FROM User WHERE mail = \"$mail\"";
		$result = $connection->query($sql);
		$hash = $result->fetch_row()[0];
		if (!password_verify($password, $hash)) {
			$connection->close();
			return false;
		}

		$sql = "SELECT id FROM User WHERE mail = \"$mail\" AND password = \"$hash\"";
		$result = $connection->query($sql);

		$connection->close();
		
		return $result->fetch_row()[0];
	}
}