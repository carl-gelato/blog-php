<?php

require('../model/User.php');

function register_user() {
	if (isset($_POST['name']) && 
		isset($_POST['surname']) && 
		isset($_POST['mail'])
		isset($_POST['password'])) {
	    
	    User::register_user($_POST['name'], $_POST['surname'], $_POST['mail'], $_POST['password']);
	    
	    require('register_view.php');
	}
}

function login_user() {
	if (isset($_POST['mail']) && 
		isset($_POST['password']) {
	    
	    $user_id = login_user($_POST['mail'], $_POST['password']);
	    
	    require('login_view.php');
	}
}
