<?php

include_once("connection.php");

mysqli_close($connection);

session_start();

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
                <li><a href="create-account.php">Create Account</a></li>
            </ul>
            </nav>
        </header>
        <section id="corpo-full">
        <header id="cabecalho-artigo">
            <hgroup>
                <h1>Log-in</h1>
            </hgroup>
        </header>
        </section>
               <?php
                if(isset($_SESSION['not-autenticated'])){
                    $message = "Invalid user!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                ?>
            <form method="POST" action="loginCheck.php">
            <fieldset id="usuariolog"><legend>User Identification</legend>
                <p class="log"><label for="email">E-mail:</label><input type="email" name="email" size="20" maxlength="40" placeholder="user@example.com" autofocus required></p>
                <p class="log"><label for="passwords">Password:</label><input type="password" name="passwords" size="15" minlength="8" placeholder="8 digits minimum" required></p>
                <input id="logbut" type="image" src="_imagens/enter-button.png" alt="Submit Button">
            </fieldset>
                
        </form>

        <footer id="foot">
            <p>&copy; Copyright 2021 - by Raphael Rocha <br>
            <a href="http://facebook.com" target="_blank">Facebook</a> | 
            <a href="http://twiter.com" target="_blank">Twitter</a></p>
        </footer>
    </div>
</body>
</html>