<?php

include_once("connection.php");

include("verifyLogin.php");

$sqlselectTable = "SELECT usercars.make,usercars.model,usercars.vplate,usercars.fuel,bookings.bookingdate,bookings.servtype,bookings.booking_status FROM usercars,bookings WHERE usercars.vplate = bookings.vplate AND usercars.user_id = '$user_id' AND bookings.booking_status = 'collected'";
$search = mysqli_query($connection, $sqlselectTable);
$registers = mysqli_num_rows($search);

$sqlselect = "select * from usercars where user_id = '$user_id'";
$searchcars = mysqli_query($connection, $sqlselect);
$registeredcars = mysqli_num_rows($searchcars);

$sqlselectTableFuture = "SELECT usercars.make,usercars.model,usercars.vplate,usercars.fuel,bookings.bookingdate,bookings.servtype,bookings.booking_status FROM usercars,bookings WHERE usercars.vplate = bookings.vplate AND usercars.user_id = '$user_id' AND bookings.booking_status != 'collected'";
$searchfuture = mysqli_query($connection, $sqlselectTableFuture);
$registers = mysqli_num_rows($searchfuture);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ger's Garage</title>
    <link rel="stylesheet" href="_css/estilo.css">
    <link rel="stylesheet" src="_css/specs.css">
    <script src="_javascript/functions.js"></script>

    <style>
    table.tabela-spec {
    width: auto;
    border: 1px solid #606060;
    border-spacing: 0px;
    margin-right: auto;
    margin-left: auto;
    margin-bottom: 1rem;
    }
    table.tabela-spec tr {
    color: #ffffff;
    background: #32264D;
    font-weight: bold;
    }
    table.tabela-spec td {
    text-align: center;
    color: black;
    background: white;
    border: 1px solid #606060;
    padding: 1rem;
    }
    table.tabela-spec th {
    border: 1px solid #606060;
    padding: 0 10px;
    text-align: center;
    vertical-align: middle;
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
        <h2>My vehicles:</h2>

        <table class="tabela-spec">
            <thead>
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Vehicle plate</th>
                    <th>Engine type</th>
                    <th>Delete</th>
            
                </tr>
            </thead>
            <tbody>
                <?php

                $vplate = '';
                $make = '';
                $model = '';
                $engine = '';

                while($showRegisteredVehicles = mysqli_fetch_array($searchcars)) {

                    $model = $showRegisteredVehicles[2];
                    $make = $showRegisteredVehicles[3];
                    $vplate = $showRegisteredVehicles[4];
                    $engine = $showRegisteredVehicles[5];

                    if(empty($model)) {
                        $model = '';
                    };
                    if(empty($make)) {
                        $make = '';
                    };
                    if(empty($engine)) {
                        $engine = '';
                    };
                    
                    if(empty($vplate)) {
                        $vplate = '';
                    };

                    echo "<tr>";
                    echo "<td>$make</td>";
                    echo "<td>$vplate</td>";
                    echo "<td>$model</td>";
                    echo "<td>$engine</td>";
                    echo "<td><a href='removeVehicle.php'><img src='_imagens/remove.ico' alt='remove-icon' width = 20rem></a></td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
            
        </table>

        <div class="adre">
            <h4>Would you like to have the service done in other vehicle? Click <a href="addCar.php">here.</a></h4>
        </div>


        <h2>My history:</h2>
        
        <table class="tabela-spec">
            <thead>
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Vehicle plate</th>
                    <th>Engine type</th>
                    <th>Last Booking Date</th>
                    <th>Type</th>
                    <th>Status</th>
            
                </tr>
            </thead>
            <tbody>
                <?php

                $vplate = '';
                $make = '';
                $model = '';
                $engine = '';
                $type = '';
                $booking = '';
                $status = '';

                while($showRegisters = mysqli_fetch_array($search)) {

                    $make = $showRegisters[0];
                    $vplate = $showRegisters[1];
                    $model = $showRegisters[2];
                    $engine = $showRegisters[3];
                    $booking = $showRegisters[4];
                    $type = $showRegisters[5];
                    $status = $showRegisters[6];

                    if(empty($model)) {
                        $model = '';
                    };
                    if(empty($make)) {
                        $make = '';
                    };
                    if(empty($type)) {
                        $type = '';
                    };
                    if(empty($booking)) {
                        $booking = '';
                    };
                    if(empty($engine)) {
                        $engine = '';
                    };
                    
                    if(empty($vplate)) {
                        $vplate = '';
                    };
                    if(empty($status)) {
                        $status = '';
                    };

                    echo "<tr>";
                    echo "<td>$make</td>";
                    echo "<td>$vplate</td>";
                    echo "<td>$model</td>";
                    echo "<td>$engine</td>";
                    echo "<td>$booking</td>";
                    echo "<td>$type</td>";
                    echo "<td>$status</td>";
                    echo "</tr>";
                }

                ?>

            </tbody>
            
        </table>

        <h2>Future Bookings:</h2>
        
        <table class="tabela-spec">
            <thead>
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Vehicle plate</th>
                    <th>Engine type</th>
                    <th>Booking Date</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Delete</th>
            
                </tr>
            </thead>
            <tbody>
                <?php

                while($showRegister = mysqli_fetch_array($searchfuture)) {

                    $make = $showRegister[0];
                    $vplate = $showRegister[1];
                    $model = $showRegister[2];
                    $engine = $showRegister[3];
                    $booking = $showRegister[4];
                    $type = $showRegister[5];
                    $status = $showRegister[6];

                    if(empty($model)) {
                        $model = '';
                    };
                    if(empty($make)) {
                        $make = '';
                    };
                    if(empty($type)) {
                        $type = '';
                    };
                    if(empty($booking)) {
                        $booking = '';
                    };
                    if(empty($engine)) {
                        $engine = '';
                    };
                    
                    if(empty($vplate)) {
                        $vplate = '';
                    };
                    if(empty($status)) {
                        $status = '';
                    };

                    echo "<tr>";
                    echo "<td>$make</td>";
                    echo "<td>$vplate</td>";
                    echo "<td>$model</td>";
                    echo "<td>$engine</td>";
                    echo "<td>$booking</td>";
                    echo "<td>$type</td>";
                    echo "<td>$status</td>";
                    echo "<td><a href='deleteBooking.php'><img src='_imagens/remove.ico' alt='remove-icon' width = 20rem></a></td>";
                    echo "</tr>";
                }

                mysqli_close($connection);
                ?>

            </tbody>
            
        </table>

        <footer id="foot">
            <p>&copy; Copyright 2021 - by Raphael Rocha <br>
            <a href="http://facebook.com" target="_blank">Facebook</a> | 
            <a href="http://twiter.com" target="_blank">Twitter</a></p>
        </footer>
    </div>
</body>
</html>