<?php

require_once './vendor/autoload.php';
require_once 'model/post.php';

$loader = new \Twig\Loader\FilesystemLoader('./');

$twig = new \Twig\Environment($loader, []);

session_start();

if (isset($_GET['action'])) {
    switch($_GET['action']) {
    case 'listPosts':
    break;

    case 'post':
    break;

    case 'save_post':
    break;

    case 'logout':
    session_destroy();
    echo $twig->render('home.html', ['blog_posts' => Post::get_blog_posts()]);
    break;

    case 'login':
    echo $twig->render('login.html', []);
    break;

    case 'register':
    echo $twig->render('register.html', []);
    break;
    }
} else if (isset($_POST['action'])) {
    switch($_POST['action']) {
    case 'save_comment':
    break;

    case 'register':
    break;

    case 'login':
    break;
    }
} else {
    echo $twig->render('home.html', ['blog_posts' => Post::get_blog_posts(), 'username' => isset($_SESSION['user_id']) ? User::get_user($_SESSION['user_id'])[0] : null]);
}
