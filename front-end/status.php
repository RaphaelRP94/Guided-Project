<?php

include_once("connection.php");

include("verifyLogin.php");

$filter = isset($_GET['filter'])?$_GET['filter']:"";

$sqlStatus = "SELECT bookings.booking_id,bookings.vplate,bookings.bookingdate,bookings.servtype,bookings.booking_status FROM bookings WHERE bookings.vplate = '$filter' ORDER BY bookings.bookingdate";
$searchStatus = mysqli_query($connection, $sqlStatus);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ger's Garage</title>
    <link rel="stylesheet" href="_css/estilo.css">
    <link rel="stylesheet" href="_css/form.css">
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
        padding: 0.5rem;
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
        <form method="get" action="">
          Vehicle Plate: <input type="text" name="filter">
            <input type="submit" value="Search">
        </form>

        <h3>Vehicle Status:</h3>
        <table class="tabela-spec">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Vehicle Plate</th>
                    <th>Booking Date</th>
                    <th>Service Type</th>
                    <th>Status</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php

                while($vehicleStatus = mysqli_fetch_array($searchStatus)) {

                    $bookingID = $vehicleStatus[0];
                    $vehiclePlate = $vehicleStatus[1];
                    $bookingdate = $vehicleStatus[2];
                    $serv_type = $vehicleStatus[3];
                    $status = $vehicleStatus[4];

                    if(empty($bookingID)) {
                        $bookingID = '';
                    };
                    if(empty($vehiclePlate)) {
                        $vehiclePlate = '';
                    };
                    if(empty($status)) {
                        $status = '';
                    };
                    if(empty($bookingdate)) {
                        $bookingdate = '';
                    };
                    if(empty($serv_type)) {
                        $serv_type = '';
                    };

                    echo "<tr>";
                    echo "<td>$bookingID</td>";
                    echo "<td>$vehiclePlate</td>";
                    echo "<td>$bookingdate</td>";
                    echo "<td>$serv_type</td>";
                    echo "<td>$status</td>";
                    echo "<td><img id='updateStatus' src='_imagens/pencil.png' alt='remove-icon' width = 20rem></td>";
                    echo "</tr>";
                }
                mysqli_close($connection);
                ?>
            </tbody>
        </table>

        <form method="post" id="fContatoStatus" action="adminUpdateVehicleProcess.php">
        <fieldset><legend>Please fill up the form</legend>
            <fieldset><legend>Service:</legend>
                <input type="radio" name="servtype" value = "Annual Service" required ><label for="annual">Annual Service</label><br>
                <input type="radio" name="servtype" value = "Major Service" required ><label for="majorS">Major Service</label><br>
                <input type="radio" name="servtype" value = "Repair/Fault" required ><label for="repair">Repair / Fault</label><br>
                <input type="radio" name="servtype" value = "Major Repair" required ><label for="majorR">Major Repair</label>
            </fieldset>
            <fieldset><legend>Status:</legend>
                <input type="radio" name="status" value = "booked" required ><label for="booked">Booked</label><br>
                <input type="radio" name="status" value = "in_service" required ><label for="in_service">In Service</label><br>
                <input type="radio" name="status" value = "fixed/completed" required ><label for="fixed/completed">Fixed / Completed</label><br>
                <input type="radio" name="status" value = "collected" required ><label for="collected">Collected</label></br>
                <input type="radio" name="status" value = "unrepairable/scrapped" required ><label for="unrepairable/scrapped">Unrepairable / Scrapped</label>
            </fieldset>
            <fieldset id="mensagem"><legend>Extra costs</legend>
                <textarea name="description" id="cMsg" cols="35" rows="11" placeholder="Leave your description here." maxlength="400"></textarea></p>
                <p>Price: <input type="number" min="1" name="cost" id="cost"></p>
            </fieldset>
          <p>Vehicle plate: <input type="text" name="vplate" size="10" maxlength="9" required></p>
          <p>Booking id: <input type="number" min="1" name="booking_id" id="booking_id" required></p>
        </fieldset>
          <input id="sendbut" type="image" name="submit" value="submit" src="_imagens/botao-enviar.png" alt="Submit Button">
        </form>
        
        <footer id="foot">
            <p>&copy; Copyright 2021 - by Raphael Rocha <br>
            <a href="http://facebook.com" target="_blank">Facebook</a> | 
            <a href="http://twiter.com" target="_blank">Twitter</a></p>
        </footer>
    </div>

    
    <script src="_javascript/functions.js"></script>

    <script>
        function updateStatus() {
            document.getElementById('fContatoStatus').style.display = 'block';
        };

        document.getElementById('updateStatus').addEventListener('click', updateStatus);
    </script>
</body>
</html>