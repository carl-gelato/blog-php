<?php

include 'connection.php';

class Comment {
	private $content = null;
	private $creation_date = null;
	private $modification_date = null;
	private $is_deleted = null;
	private $blog_post_id = null;
	private $user_id = null;

	// Getters
	public function get_content() {
		return $this->content;
	}

	public function get_creation_date() {
		return $this->creation_date;
	}

	public function get_modification_date() {
		return $this->modification_date;
	}

	public function get_is_deleted() {
		return $this->is_deleted;
	}

	public function get_blog_post_id() {
		return $this->blog_post_id;
	}

	public function get_user_id() {
		return $this->user_id;
	}

	// Setters
	public function set_content($content) {
		return $this->content = $content;
	}

	public function set_creation_date($creation_date) {
		return $this->creation_date = $creation_date;
	}

	public function set_modification_date($modification_date) {
		return $this->modification_date = $modification_date;
	}

	public function set_is_deleted($is_deleted) {
		return $this->is_deleted = $is_deleted;
	}

	public function set_blog_post_id($blog_post_id) {
		return $this->blog_post_id = $blog_post_id;
	}

	public function set_user_id($user_id) {
		return $this->user_id = $user_id;
	}

	public function save_to_database() {
		try {
			$connection = get_database();
			$sql = "INSERT INTO User (content, creation_date, modification_date, is_deleted, Blog_Post_id, User_id) VALUES ($this->content, $this->creation_date, $this->modification_date, $this->is_deleted, $this->blog_post_id, $this->user_id)";
			$result = $connection->query($sql);
			
			$connection->close();
		} catch {
			return false;
		}

		return true;
	}
}