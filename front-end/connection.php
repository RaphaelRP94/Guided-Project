<?php

$hostname = "localhost";
$user = "root";
$password = "";
$database = "registrationdb";
$connection = mysqli_connect($hostname, $user, $password, $database);

if(!$connection) {
  echo "The connection with the database has failed!";
}

?>