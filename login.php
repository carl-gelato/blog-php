<?php
require_once 'model/User.php';

$user_id = User::login_user($_POST["email"], $_POST["password"]);
if ($user_id == false) return;

session_start();
$_SESSION['user_id'] = $user_id;
header("Location: index.php");