<?php

require_once '/Applications/MAMP/htdocs/blog/vendor/autoload.php';

require('/Applications/MAMP/htdocs/blog/model/Post.php');

function get_blog_and_comment() {
    if (isset($_POST['id']) && $_POST['id'] > 0) {
        $post = get_blog($_POST['id']);
        $comments = get_blog_post_comment($_POST['id']);
        
        require('post_view.php');
    } else {
        echo 'Erreur: Le post recherché n\'existe pas';
    }
}

function save_post() {
    if (isset($_POST['user_id']) && $_POST['user_id'] > 0 &&
        isset($_POST['title']) && 
        isset($_POST['chapo']) &&
        isset($_POST['content'])) {
        
        if (strcmp(User::get_role($_POST['user_id']), "admin") == 0) {
            $post = new Post();
            $post->set_title($_POST['title']);
            $post->set_chapo($_POST['chapo']);
            $post->set_content($_POST['content']);
            $post->set_creation_date(new DateTime);
            $post->save_to_database();
        }
    }
}