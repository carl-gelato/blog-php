<?php

function get_database() {
  $servername = "localhost:8889";
  $username = "root";
  $password = "root";
  $db = "blog";

  $connection = new mysqli($servername, $username, $password, $db);

  if ($connection->connect_error) {
    // die("");
  }

  return $connection;
}



// TODO login

// TODO delete user
// TODO delete post
// TODO delete comment

// TODO change comment

// TODO strip input data
// TODO put real datetime