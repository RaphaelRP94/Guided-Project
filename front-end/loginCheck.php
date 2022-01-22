<?php

session_start();

include_once("connection.php");

$email = $_POST['email'];
$passwords = $_POST['passwords'];

if(empty($_POST['email']) || empty($_POST['passwords'])) {
  header ('Location: login.php');
  exit();
} 

$sqlselect = "select user_id from users where email = '$email' and passwords = '$passwords'";
$result = mysqli_query($connection, $sqlselect);
$row = mysqli_num_rows($result);
$userID = 1;
while($sqlUserID = mysqli_fetch_array($result)) {
  $userID = $sqlUserID[0];

};


if($row == 1 && !$userID == 0) {
  $_SESSION['email'] = $email;
  header ('Location: home.php');
  exit();
} elseif($userID == 0){
  $_SESSION['email'] = $email;
  header ('Location: agenda.php');
  exit();
}else {

  $_SESSION['not-autenticated'] = true;

  header ('Location: login.php');
  exit();
}

?>