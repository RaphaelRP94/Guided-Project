<?php
session_start();
$email;
if(!$_SESSION['email']) {
  header('Location: index.php');
  exit();
} else {
  $email = $_SESSION['email'];
  
  $sqlselect = "select user_id from users where email = '$email'";
  $search = mysqli_query($connection, $sqlselect);

  $busca = mysqli_fetch_array($search);

  $user_id = $busca[0];

  $sqlselectplate = "select vplate from usercars where user_id = '$user_id'";
  $searchplate = mysqli_query($connection, $sqlselectplate);

  $buscaplate = mysqli_fetch_array($searchplate);

  $vplate = $buscaplate[0];
}


?>