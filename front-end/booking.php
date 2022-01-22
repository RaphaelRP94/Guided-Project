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
    <!--  I am including this because I did not manage to prevent user from selecting sundays only with JavaScript. I took it in December of 2021.  -->
    <!--  Flatpicker Styles  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/dark.css">
    <style>
        .flatpickr-time{
            display: none;
        } 
    </style>
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

            <nav id="menu">
            <h1>Menu Principal</h1>
            <ul type="disc">
                <li onmouseover="mudaFoto('_imagens/carmain.png')" onmouseout="mudaFoto('_imagens/contato.png')"><a href="home.php">HOME</a></li>
                <li onmouseover="mudaFoto('_imagens/especificacoes.png')" onmouseout="mudaFoto('_imagens/contato.png')"><a href="parts.php">VEHICLE PARTS</a></li>
                <li onmouseover="mudaFoto('_imagens/contato.png')" onmouseout="mudaFoto('_imagens/contato.png')"><a href="booking.php">BOOKING</a></li>
                <li><a href="logout.php">LOG-OUT</a></li>
            </ul>
            </nav>
        </header>
        <section id="corpo-full">
            <article id="noticia-principal">
                <header id="cabecalho-artigo">
                    <hgroup>
                        <h1>Booking Information</h1>
                    </hgroup>
                </header>
        </section>
        <?php
            if(isset($_SESSION['not-in-database'])){
                $message = "This vehicle is not in our database. Please select other vehicle or add this to our database.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } elseif(isset($_SESSION['date-not-available'])){
                $message2 = "This date is not available. Please select other day or try other service type.";
                echo "<script type='text/javascript'>alert('$message2');</script>";
            } elseif(isset($_SESSION['already_booked'])){
                $message3 = "This booking was already in our agenda.";
                echo "<script type='text/javascript'>alert('$message3');</script>";
            }
        ?>

        <form method="POST" action="bookingProcess.php">

            <fieldset id="vehicle"><legend>Vehicle selected for booking:</legend>
            Type below the vehicle plate from the vehicles you have added to your home-page
            <p><label for="cPlate">Vehicle plate:</label> <input type="text" name="vplate" size="10" maxlength="9" required></p>
            </fieldset>

            <fieldset id="mensagem"><legend>Message from user</legend>
                <textarea name="message" id="cMsg" cols="35" rows="11" placeholder="Leave your message here." maxlength="400"></textarea></p>
            </fieldset>
            
            <fieldset id="pedido"><legend>Booking Required</legend>
                <fieldset><legend>Type:</legend>
                    <input type="radio" name="servtype" value = "Annual Service" required ><label for="annual">Annual Service</label><br>
                    <input type="radio" name="servtype" value = "Major Service" required ><label for="majorS">Major Service</label><br>
                    <input type="radio" name="servtype" value = "Repair/Fault" required ><label for="repair">Repair / Fault</label><br>
                    <input type="radio" name="servtype" value = "Major Repair" required ><label for="majorR">Major Repair</label>
                </fieldset>
                <p><label for="date">Booking Date</label><input name= "bookingdate" id="date1" size="10" type="date" max="2022-01-25" placeholder="YYYY/MM/DD" format="YYYY/MM/DD" required/></p>
            </fieldset>

            <fieldset><legend>Your items:</legend>
                <pre id="printCartItems"></pre>
                <input type="hidden" id='names' name="names">
                <input type="hidden" id='qts' name="qts">
                <input type="hidden" id='prices' name="prices">
            </fieldset>
            <input type="hidden" name="mechanic" id='mechanic' value='none'>
                
            <input id="sendbut" type="image" src="_imagens/botao-enviar.png" alt="Send-button">
        </form>

        <footer id="foot">
            <p>&copy; Copyright 2021 - by Raphael Rocha <br>
            <a href="http://facebook.com" target="_blank">Facebook</a> | 
            <a href="http://twiter.com" target="_blank">Twitter</a></p>
        </footer>
    </div>

    
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--  Flatpickr  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>




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