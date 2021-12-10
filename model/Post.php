<?php

require_once 'connection.php';
require_once 'User.php';

class Post {
	private $title = null;
	private $last_modification = null;
	private $chapo = null;
	private $content = null;
	private $is_deleted = null;
	private $creation_date = null;
	private $user_id = null;

	// Getters
	public function get_title() {
		return $this->title;
	}

	public function get_last_modification() {
		return $this->last_modification;
	}

	public function get_chapo() {
		return $this->chapo;
	}

	public function get_content() {
		return $this->content;
	}

	public function get_is_deleted() {
		return $this->is_deleted;
	}

	public function get_creation_date() {
		return $this->creation_date;
	}

	public function get_user_id() {
		return $this->user_id;
	}

	// Setters
	public function set_title($title) {
		return $this->title = $title;
	}

	public function set_last_modification($last_modification) {
		return $this->last_modification = $last_modification;
	}

	public function set_chapo($chapo) {
		return $this->chapo = $chapo;
	}

	public function set_content($content) {
		return $this->content = $content;
	}

	public function set_is_deleted($is_deleted) {
		return $this->is_deleted = $is_deleted;
	}

	public function set_creation_date($creation_date) {
		return $this->creation_date = $creation_date;
	}

	public function set_user_id($user_id) {
		return $this->user_id = $user_id;
	}

	public function save_to_database() {
		try {
			$connection = get_database();
			$sql = "INSERT INTO User (title, last_modification, chapo, content, is_deleted, creation_date, User_id) VALUES ($this->title, $this->last_modification, $this->chapo, $this->content, $this->is_deleted, $this->creation_date, $this->user_id)";
			$result = $connection->query($sql);
			
			$connection->close();
		} catch (Exception $exception) {
			return false;
		}

		return true;
	}

	public static function get_blog_posts() {
		$connection = get_database();
		$sql = "SELECT creation_date, last_modification, title, chapo, id, User_id FROM Blog_Post WHERE is_deleted = 0";
		$result = $connection->query($sql);
		
		$connection->close();
		$posts = $result->fetch_all(MYSQLI_ASSOC);
		for ($i = 0; $i < count($posts); ++$i) {
			$posts[$i]['user'] = User::get_user($posts[$i]['User_id']);
		}
		
		return $posts;
	}

	public function get_blog($blog_id) {
		$connection = get_database();
		$sql = "SELECT creation_date, last_modification, title, chapo, content, User_id FROM Blog_Post WHERE is_deleted = 0 and id = $blog_id";
		$result = $connection->query($sql);
		
		$connection->close();
		
		return $result->fetch_row();
	}

	public function get_blog_post_comment($id) {
		$connection = get_database();
		$sql = "SELECT * FROM Comment WHERE id = $id and is_deleted = 0";
		$result = $connection->query($sql);
		
		$connection->close();
		
		return $result->fetch_all();
	}

	public function add_blog_post($title, $last_modification, $chapo, $content, $creation_date, $user_id) {
		$connection = get_database();
		// TODO check if user is admin
		$sql = "INSERT INTO Comment (is_deleted, title, last_modification, chapo, content, creation_date, User_id) VALUES (0, $title, $last_modification, $chapo, $content, $creation_date, $user_id)";
		$result = $connection->query($sql);
		
		$connection->close();
		
		return $result;
	}

	public function comment_on_blog($content, $creation_date, $modification_date, $blog_post_id, $user_id) {
		$connection = get_database();
		// TODO check if user is verified
		$sql = "INSERT INTO Comment (is_deleted, content, creation_date, modification_date, Blog_Post_id, User_id) VALUES (0, $content, $creation_date, $modification_date, $blog_post_id, $user_id)";
		$result = $connection->query($sql);
		
		$connection->close();
		
		return $result;
	}
}