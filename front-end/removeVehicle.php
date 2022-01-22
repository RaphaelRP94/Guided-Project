<?php

include_once("connection.php");

include("verifyLogin.php");

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
                <li onmouseover="mudaFoto('_imagens/contato.png')" onmouseout="mudaFoto('_imagens/carmain.png')"><a href="booking.php">BOOKING</a></li>
                <li><a href="logout.php">LOG-OUT</a></li>
            </ul>
            </nav>
        </header>
        <section id="corpo-full">
        <header id="cabecalho-artigo">
            <hgroup>
                <h1>Remove Vehicle</h1>
            </hgroup>
        </header>
        </section>
          <form method="POST" action="removeVehicleProcess.php">
          <fieldset id="cardetails"><legend>Vehicle Details</legend>
            <p><label for="cPlate">Vehicle plate:</label> <input type="text" name="vplate" size="10" maxlength="9" required></p>
            <span>Please confirme the vehicle plate that you want to delete.</span>
          </fieldset>
              
          <input id="sendbut" type="image" name="submit" value="submit" src="_imagens/botao-enviar.png" alt="Submit Button">
          </form>  

        <footer id="foot">
            <p>&copy; Copyright 2021 - by Raphael Rocha <br>
            <a href="http://facebook.com" target="_blank">Facebook</a> | 
            <a href="http://twiter.com" target="_blank">Twitter</a></p>
        </footer>
    </div>
</body>
</html>
