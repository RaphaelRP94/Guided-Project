<?php

include_once("connection.php");

include("verifyLogin.php");

$localUserID = $_POST['user_id'];

$name = $_POST['name'];
$surname = $_POST['surname'];
$passwords = $_POST['passwords'];
$licence = $_POST['licence'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$birthdate = $_POST['birthdate'];

$sqlUpdateUser = "UPDATE users SET name = '$name', surname = '$surname', passwords='$passwords', licence='$licence', email='$email', phone='$phone', gender='$gender', birthdate='$birthdate' WHERE user_id = '$localUserID'";
$update = mysqli_query($connection, $sqlUpdateUser);

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

            <nav id="menu">
            <h1>Main Menu</h1>
            <ul type="disc">
                <li><a href="agenda.php">Agenda</a></li>
                <li><a href="partsAdmin.php">Vehicle parts</a></li>
                <li><a href="information.php">Information</a></li>
                <li><a href="invoice.php">Invoice</a></li>
                <li><a href="status.php">Status</a></li>
                <li><a href="logout.php">Log-out</a></li>
            </ul>
            </nav>
        </header>
        <h2>User details updated successfully</h2>
        <footer id="foot">
            <p>&copy; Copyright 2021 - by Raphael Rocha <br>
            <a href="http://facebook.com" target="_blank">Facebook</a> | 
            <a href="http://twiter.com" target="_blank">Twitter</a></p>
        </footer>
    </div>
</body>
</html>