<?php

include_once("connection.php");

include("verifyLogin.php");

$sqlselectTableFuture = "SELECT bookings.bookingdate,bookings.booking_id,bookings.user_id, users.name,users.surname,usercars.make,usercars.model,bookings.vplate,bookings.servtype,bookings.booking_status,bookings.mechanic FROM bookings,users,usercars WHERE bookings.user_id != 0 AND bookings.booking_status != 'collected' AND usercars.vplate = bookings.vplate AND users.user_id = bookings.user_id ORDER BY bookings.bookingdate";
$searchfuture = mysqli_query($connection, $sqlselectTableFuture);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ger's Garage</title>
    <link rel="stylesheet" href="_css/estilo.css">
    <script src="_javascript/functions.js"></script>

    <!-- Unfortunately I had a problem with the link CSS so I had to insert it here. -->
    <style>
        aside#lower {
            padding: 7px;
            background-color: white;
            width: 19vw;
            height: 18vh;
            display: inline;
            float: left;
            position: fixed;
            margin-left: 0px;
            top: 55%;
            border-radius: 20px;
        }
        aside#upper {
            padding: 7px;
            background-color: white;
            width: 19vw;
            height: 25vh;
            display: inline;
            float: left;
            position: fixed;
            margin-left: 0px;
            top: 25%;
            border-radius: 20px;
        }
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
        font-size: smaller;
        }
        table.tabela-spec td {
        text-align: center;
        color: black;
        background: white;
        border: 1px solid #606060;
        padding: 1rem .2rem;
        }
        table.tabela-spec th {
        border: 1px solid #606060;
        padding: 0 10px;
        text-align: center;
        vertical-align: middle;
        }
        #set_mec {
            font-size: 15px;
            margin-top: 30px;
            padding: 20px 30px;
            border-radius: 20px;
            background-color: #48D05F;
            color: #FFF;
            display: inline-block;
            cursor: pointer;
            margin-right: 30px;
        }
        #set_mec:hover {
            background-color: #32A345;
        }
        #unsign_mec {
            padding: 20px 30px;
            border-radius: 20px;
            background-color: #9c1b1b;
            color: #FFF;
            cursor: pointer;
            text-align: center;
            margin-top: 20px;
            border: 2px solid #7c1e1e;
            transition: all ease .2s;
        }

        #unsign_mec:hover {
            background-color: #7c1e1e;
        }
    </style>
</head>
<body>
    <aside id='upper'>
    </br><form method='post' action="asignMechanicProcess.php">
            Mechanic: <input type="text" name="mechanic" id="mechanic" required></br></br>
            Booking ID: <input type="number" min="1" name="booking_id" id="booking_id" required>
            <center><button id="set_mec" type="submit">Set Mechanic</button></center>
        </form>
    </aside>
    <aside id='lower'>
    </br><form method='post' action="adminDeleteBooking.php">
            Booking ID: <input type="number" min="1" name="booking_id" id="booking_id" required>
            <center><button id="unsign_mec" type="submit">Delete Booking</button></center>
        </form>
    </aside>
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
                <li><a href="agenda.php">Agenda</a></li>
                <li><a href="partsAdmin.php">Vehicle parts</a></li>
                <li><a href="information.php">Information</a></li>
                <li><a href="invoice.php">Invoice</a></li>
                <li><a href="status.php">Status</a></li>
                <li><a href="logout.php">Log-out</a></li>
            </ul>
            </nav>
        </header>

        <h2>Agenda:</h2>
        <div id="printArea">
        <table class="tabela-spec">
            <thead>
                <tr>
                    <th>Booking Date</th>
                    <th>Booking ID</th>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Plate</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Mechanic</th>
            
                </tr>
            </thead>
            <tbody>
                <?php

                while($showRegisters = mysqli_fetch_array($searchfuture)) {

                    $booking = $showRegisters[0];
                    $booking_id = $showRegisters[1];
                    $user_id = $showRegisters[2];
                    $name = $showRegisters[3];
                    $surname = $showRegisters[4];
                    $make = $showRegisters[5];
                    $model = $showRegisters[6];
                    $vplate = $showRegisters[7];
                    $serv_type = $showRegisters[8];
                    $status = $showRegisters[9];
                    $mechanic = $showRegisters[10];

                    if(empty($booking)) {
                        $booking = '';
                    };
                    if(empty($booking_id)) {
                        $booking_id = '';
                    };
                    if(empty($user_id)) {
                        $user_id = '';
                    };
                    if(empty($name)) {
                        $name = '';
                    };
                    if(empty($surname)) {
                        $surname = '';
                    };
                    if(empty($make)) {
                        $make = '';
                    };
                    if(empty($model)) {
                        $model = '';
                    };
                    if(empty($vplate)) {
                        $vplate = '';
                    };
                    if(empty($serv_type)) {
                        $serv_type = '';
                    };
                    if(empty($status)) {
                        $status = '';
                    };
                    if(empty($mechanic)) {
                        $mechanic = '';
                    };

                    echo "<tr>";
                    echo "<td>$booking</td>";
                    echo "<td>$booking_id</td>";
                    echo "<td>$user_id</td>";
                    echo "<td>$name</td>";
                    echo "<td>$surname</td>";
                    echo "<td>$make</td>";
                    echo "<td>$model</td>";
                    echo "<td>$vplate</td>";
                    echo "<td>$serv_type</td>";
                    echo "<td>$status</td>";
                    echo "<td>$mechanic</td>";
                    echo "</tr>";
                }

                mysqli_close($connection);
                ?>

            </tbody>
            
        </table>
        </div>
        <input type="button" href="javascript:void(0);" onclick="printPageArea('printArea')" style="float:right;margin-bottom:1rem" class="printButton" value="Print"/>
        <footer id="foot">
            <p>&copy; Copyright 2021 - by Raphael Rocha <br>
            <a href="http://facebook.com" target="_blank">Facebook</a> | 
            <a href="http://twiter.com" target="_blank">Twitter</a></p>
        </footer>
    </div>
</body>
</html>