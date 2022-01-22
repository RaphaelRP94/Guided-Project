<?php

include_once("connection.php");

include("verifyLogin.php");


$sqlselect = "select * from usercars where user_id = '$user_id'";
$search = mysqli_query($connection, $sqlselect);
$registers = mysqli_num_rows($search);

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
        </br>
        <form method="post" action="removeProductsProcess.php">

          <fieldset><legend>Items:</legend>
                <pre id="printCartItems"></pre>
                <input type="hidden" id='names' name="names">
                <input type="hidden" id='qts' name="qts">
                <input type="hidden" id='prices' name="prices">
          </fieldset>
          <fieldset><legend>Please insert booking ID:</legend>
            Booking ID: <input type="number" name="booking_id" id="booking_id" required>
          </fieldset>
            <input id="sendbut" type="image" src="_imagens/botao-enviar.png" alt="Send-button">
        </form>

        <footer id="foot">
            <p>&copy; Copyright 2021 - by Raphael Rocha <br>
            <a href="http://facebook.com" target="_blank">Facebook</a> | 
            <a href="http://twiter.com" target="_blank">Twitter</a></p>
        </footer>
    </div>

    <script src="_javascript/functions.js"></script>

    <script>
        let cartItems = JSON.parse(localStorage.getItem("cart"));
        let names = cartItems.map(name => name.name);
        let qts = cartItems.map(qt => qt.qt);
        let prices = cartItems.map(price => price.price);

        document.getElementById("printCartItems").innerHTML = JSON.stringify(cartItems, null, 4);

        document.getElementById("names").value = JSON.stringify(names);
        document.getElementById("qts").value = JSON.stringify(qts);
        document.getElementById("prices").value = JSON.stringify(prices);
        
    </script>
    
    
</body>
</html>