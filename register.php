<?php
require_once 'model/User.php';

$hash = password_hash($_POST["password"], PASSWORD_BCRYPT);

User::register_user($_POST["name"], $_POST["surname"], $_POST["email"], $hash);

$user_id = User::login_user($_POST["email"], $_POST["password"]);
if ($user_id == false) return;

session_start();
$_SESSION['user_id'] = $user_id;
header("Location: index.php");