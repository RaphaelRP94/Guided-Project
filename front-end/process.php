<?php
session_start();
include_once("connection.php");

$name = $_POST['name'];
$surname = $_POST['surname'];
$passwords = $_POST['passwords'];
$licence = $_POST['licence'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$birthdate = $_POST['birthdate'];
$neighborhood = $_POST['neighborhood'];
$address = $_POST['address'];
$number = $_POST['number'];
$eircode = $_POST['eircode'];
$city = $_POST['city'];
$make = $_POST['make'];
$model = $_POST['model'];
$vplate = $_POST['vplate'];
$fuel = $_POST['fuel'];
$localuser_id;

$sqlselect = "select email from users where email = '$email'";

$result = mysqli_query($connection, $sqlselect);

$row = mysqli_num_rows($result);


if($row == 1) {

    $_SESSION['not-saved'] = true;
  
    header ('Location: create-account.php');
    exit();
    
  } else {
    $sqlusers = "insert into users (name, surname, passwords, licence, email, phone, gender, birthdate) values ('$name', '$surname', '$passwords', '$licence', '$email', '$phone', '$gender', '$birthdate')";
    
    $saveusers = mysqli_query($connection, $sqlusers);

    do {
        $sqlselectLocalUser_id = "select user_id from users where email = '$email'";
        $search = mysqli_query($connection, $sqlselectLocalUser_id);

        $buscaLocalUser_id = mysqli_fetch_array($search);

        $localuser_id = $buscaLocalUser_id[0];

        do{
            $sqluseraddress = "INSERT INTO useraddress(user_id, neighborhood, address, number, eircode, city) VALUES ('$localuser_id', '$neighborhood', '$address', '$number', '$eircode', '$city')";

            $saveuseraddress = mysqli_query($connection, $sqluseraddress);
            
            $sqlusercars = "insert into usercars (user_id, make, model, vplate, fuel) values ('$localuser_id', '$make', '$model', '$vplate', '$fuel')";
            
            $saveusercars = mysqli_query($connection, $sqlusercars);
        } while($localuser_id == null);
    } while($localuser_id == null);    
  }
  do {
    $sqluser_id = "UPDATE usercars SET user_id = '$localuser_id' WHERE usercars.vplate = '$vplate'";
    $saveuser_id = mysqli_query($connection, $sqluser_id);
  } while($localuser_id == null);
    
    mysqli_close($connection);
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ger's Garage</title>
    <link rel="stylesheet" href="_css/estilo.css">
    <link rel="stylesheet" href="_css/form.css">
    <script src="_javascript/functions.js"></script>
</head>
<body>
    <div id="interface">
        
        <header id="cabecalho">
        <hgroup>
        <img src="_imagens/logo.png" alt="logo-small" id="logo">
        <h2>Making your machine</h2>
        <h2 id="secpart">brand new again</h2>
        </hgroup>
            <img id="icone" src="_imagens/carmain.png" alt="classic-car">

            <nav id="menu2">
            <ul type="disc">
                <li><a href="index.php">Go Back</a></li>
                <li><a href="login.php">Log-in</a></li>
            </ul>
            </nav>
        </header>
        <header id="cabecalho-artigo">
            <hgroup>
                <h1>Account created successfully</h1>
            </hgroup>
        </header>

        <footer id="foot">
            <p>&copy; Copyright 2021 - by Raphael Rocha <br>
            <a href="http://facebook.com" target="_blank">Facebook</a> | 
            <a href="http://twiter.com" target="_blank">Twitter</a></p>
        </footer>
    </div>
</body>
</html>