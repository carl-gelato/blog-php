<?php

require('../model/Comment.php');

function save_comment() {
	if (isset($_POST['content']) && 
		isset($_POST['blog_post_id']) && 
		isset($_POST['user_id'])) {
	    
	    $comment = new Comment();
		$comment->set_content($_POST['content']);
		$commnet->set_blog_post_id($_POST['blog_post_id']);
		$comment->set_user_id($_POST['user_id']);
		$comment->set_creation_date(new DateTime);
		$comment->set_is_deleted(false);
		$comment->save_to_database();
	}
}