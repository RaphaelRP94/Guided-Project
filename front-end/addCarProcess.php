<?php

include_once("connection.php");

include("verifyLogin.php");

$make = $_POST['make'];
$model = $_POST['model'];
$vplate = $_POST['vplate'];
$fuel = $_POST['fuel'];



$sqlselect = "select car_id from usercars where vplate = '$vplate' and user_id = '$user_id'";

$result = mysqli_query($connection, $sqlselect);

$row = mysqli_num_rows($result);


if($row == 1) {

    $_SESSION['not-added'] = true;
  
    header ('Location: addCar.php');
    exit();
    
  } else {
    $sqladd = "INSERT INTO `usercars`(`vplate`, `user_id`, `make`, `model`, `fuel`) VALUES ('$vplate', '$user_id','$make','$model','$fuel')";
    $saveusernewcar = mysqli_query($connection, $sqladd);
  }




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
            <h1>Menu Principal</h1>
            <ul type="disc">
                <li onmouseover="mudaFoto('_imagens/carmain.png')" onmouseout="mudaFoto('_imagens/carmain.png')"><a href="home.php">HOME</a></li>
                <li onmouseover="mudaFoto('_imagens/especificacoes.png')" onmouseout="mudaFoto('_imagens/carmain.png')"><a href="parts.php">VEHICLE PARTS</a></li>
                <li onmouseover="mudaFoto('_imagens/contato.png')" onmouseout="mudaFoto('_imagens/carmain.png')"><a href="talktous.php">BOOKING</a></li>
                <li><a href="logout.php">LOG-OUT</a></li>
            </ul>
            </nav>
        </header>
        <section id="corpo-full">
        <header id="cabecalho-artigo">
            <hgroup>
                <h1>Vehicle added successfully</h1>
            </hgroup>
        </header>
        </section>

        <footer id="foot">
            <p>&copy; Copyright 2021 - by Raphael Rocha <br>
            <a href="http://facebook.com" target="_blank">Facebook</a> | 
            <a href="http://twiter.com" target="_blank">Twitter</a></p>
        </footer>
    </div>
</body>
</html>