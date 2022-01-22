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
            <img id="icone" src="_imagens/contato.png" alt="contato">

            <nav id="menu2">
            <ul type="disc">
                <li><a href="index.php">Go Back</a></li>
                <li><a href="login.php">Log-in</a></li>
            </ul>
            </nav>
        </header>
        <section id="corpo-full">
        <header id="cabecalho-artigo">
            <hgroup>
                <h1>Create Account</h1>
            </hgroup>
        </header>
        </section>

                <?php
                if(isset($_SESSION['not-saved'])){
                    $message = "Wrong data inserted!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                ?>

            <form method="POST" action="process.php">
            <fieldset id="usuario"><legend>User Identification</legend>
            <p><label for="cNome">Name:</label> <input type="text" name="name" size="20" maxlength="15" required></p>
            <p><label for="cSur">Surname:</label> <input type="text" name="surname" size="20" maxlength="30" required></p>
            <p><label for="cSenha">Password:</label><input type="password" name="passwords" size="8" maxlength="8" minlength="8" placeholder="8 digits" required></p>
            <p><label for="cLic">Licence details:</label><input type="text" name="licence" size="13" maxlength="10" required></p>
            <p><label for="cEmail">E-mail:</label><input type="email" name="email" size="20" maxlength="40" placeholder="user@example.com" required></p>
            <p><label for="cTel">Mobile Number: <input type="number" name="phone" size="10" maxlength="12" placeholder="353811111111" required></label></p>
            <fieldset id="sexo"><legend>Gender:</legend>
                <input type="radio" name="gender" value="male" required><label for="cMasc">Male</label><br>
                <input type="radio" name="gender" value="female" required><label for="cFem">Female</label>
            </fieldset>
            <p><label for="cNasc">Date of birth:</label><input type="date" name="birthdate" required></p>
            </fieldset>
            
            <fieldset id="endereco"><legend>User Address</legend>
            <p><label for="cPub">Neighborhood:</label><input type="text" name="neighborhood" size="20" maxlength="20" placeholder="Ranelagh, Liberty, East Wall..." required></p>
            <p><label for="cRua">Address:</label><input type="text" name="address" size="25" maxlength="60" placeholder="O'Connell Street" required></p>
            <p><label for="cNum">Number:</label><input type="number" name="number" min="0" max="99999" required></p>
            <p><label for="cEst"type="text">Eir Code:</label><input type="text" name="eircode" size="13" maxlength="7" required></p>
            <p><label for="cCid">City:</label><input type="text" name="city" maxlength="20" size="20" placeholder="Dublin, Cork, Limerick, Galway..." required></p>
            </fieldset>

            <fieldset id="cardetails"><legend>Vehicle Details</legend>
                <p><label for="cMak">Make:</label><input type="text" name="make" size="13" maxlength="20" placeholder="BMW, Toyota, volkswagen, ..." required></p>
                <p><label for="cMod">Model:</label><input type="text" name="model" size="13" maxlength="20" placeholder="Focus, Golf..." required></p>
                <p><label for="cPlate">Vehicle plate:</label> <input type="text" name="vplate" size="10" maxlength="9" required></p>
                <fieldset><legend>Engine type:</legend>
                    <input type="radio" name="fuel" value="petrol" required><label for="fuel">Petrol</label><br>
                    <input type="radio" name="fuel" value="diesel" required><label for="fuel">Diesel</label><br>
                    <input type="radio" name="fuel" value="eletric" required><label for="fuel">Electric</label><br>
                    <input type="radio" name="fuel" value="hybrid" required><label for="fuel">Hybrid</label>
                </fieldset>
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