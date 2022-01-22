<?php

include_once("connection.php");

include("verifyLogin.php");

$filterID = isset($_GET['filterID'])?$_GET['filterID']:"";
$filterVP = isset($_GET['filterVP'])?$_GET['filterVP']:"";
$filterBookingID = isset($_GET['filterBookingID'])?$_GET['filterBookingID']:"";

$sqlselect = "SELECT users.name,users.surname,users.phone,users.licence,usercars.make,usercars.model,products.vehicle_parts,products.quantity,products.price,products.total FROM usercars,users,products WHERE usercars.vplate = '$filterVP' AND products.booking_id = '$filterBookingID' AND users.user_id = '$filterID'";
$search = mysqli_query($connection, $sqlselect);

$description = "";
$cost = 0;

$message = "";

$sqlMessage = "SELECT bookings.message FROM bookings WHERE bookings.user_id = '$filterID' AND bookings.booking_id = '$filterBookingID' AND bookings.vplate = '$filterVP'";
$searchMessage = mysqli_query($connection, $sqlMessage);
while($showMessage = mysqli_fetch_array($searchMessage)){
    $message = $showMessage[0];
};

$sqlExtra = "SELECT bookings.description, bookings.cost FROM bookings WHERE bookings.booking_id = '$filterBookingID' AND bookings.user_id = '$filterID' AND bookings.vplate = '$filterVP'";
$searchExtra = mysqli_query($connection, $sqlExtra);
while($showExtra = mysqli_fetch_array($searchExtra)){
    $description = $showExtra[0];
    $cost = $showExtra[1];
}

$sqlSubtotal = "SELECT SUM(total) AS total FROM products WHERE products.booking_id = '$filterBookingID'";
$searchSubtotal = mysqli_query($connection, $sqlSubtotal);
while($showSubtotal = mysqli_fetch_array($searchSubtotal)){
  $subtotalValue = $showSubtotal[0];
}
$servType="";

$sqlServType ="SELECT bookings.servtype FROM bookings WHERE bookings.booking_id = '$filterBookingID' AND bookings.vplate = '$filterVP'";
$searchServType = mysqli_query($connection, $sqlServType);
while($showServType = mysqli_fetch_array($searchServType)){
  $servType = $showServType[0];
}
$servPrice=0;

if($servType=="Annual Service"){
  $servPrice = 200.00;
}elseif($servType=="Major Service"){
  $servPrice = 275.00;
}elseif($servType=="Repair/Fault"){
  $servPrice = 325.00;  
}elseif($servType=="Major Repair"){
  $servPrice = 500.00;  
}

$total = $servPrice + $subtotalValue + $cost;

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
      </br><form method="get" action="">
          Input user ID: <input type="number" min="1" name="filterID" id="filter" required></br></br>
          Input booking ID: <input type="number" min="1" name="filterBookingID" id="filter" required></br></br>
          Input vehicle plate: <input type="text" name="filterVP" id="filter" required>
            <input type="submit" value="Search">
        </form></br>
        <span>*Please check if the vehicle details(plate, make and model) are the same from the vehicle that got the service.</span>

        <h3>Customer message:</h3>
        <p><?php echo "$message"?></p>

        <div id="printArea">
        <h3>Customer Invoice:</h3>
        
        <table class="tabela-spec">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Phone</th>
                    <th>Licence</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php

                while($showRegisters = mysqli_fetch_array($search)) {

                    $name = $showRegisters[0];
                    $surname = $showRegisters[1];
                    $phone = $showRegisters[2];
                    $licence = $showRegisters[3];
                    $make = $showRegisters[4];
                    $model = $showRegisters[5];
                    $products = $showRegisters[6];
                    $qt = $showRegisters[7];
                    $price = $showRegisters[8];
                    $subtotal = $showRegisters[9];

                    if(empty($name) || $name == 'Ger') {
                        $name = '';
                    };
                    if(empty($Surname)) {
                        $Surname = '';
                    };
                    if(empty($phone)) {
                        $phone = '';
                    };
                    if(empty($licence)) {
                        $licence = '';
                    };
                    if(empty($make)) {
                        $make = '';
                    };
                    if(empty($model)) {
                        $model = '';
                    };
                    if(empty($products)) {
                        $products = '';
                    };
                    if(empty($qt)) {
                        $qt = '';
                    };
                    if(empty($price)) {
                        $price = '';
                    };
                    if(empty($subtotal)) {
                        $subtotal = '';
                    };

                    echo "<tr>";
                    echo "<td>$name</td>";
                    echo "<td>$surname</td>";
                    echo "<td>$phone</td>";
                    echo "<td>$licence</td>";
                    echo "<td>$make</td>";
                    echo "<td>$model</td>";
                    echo "<td>$products</td>";
                    echo "<td>$qt</td>";
                    echo "<td>$price</td>";
                    echo "<td>$subtotal</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h4 style="text-align-last: right;">Subtotal: <?php echo "$subtotalValue €";?></h4>
        <h4 style="text-align-last: right;"><?php echo "$servType: $servPrice.00€";?></h4>
        <p style="text-align-last: right;">Extra: <?php echo "$description";?></p>
        <h4 style="text-align-last: right;">Cost: <?php echo "$cost €";?></h4>
        <h4 style="text-align-last: right;"><?php echo "Total: $total €"; mysqli_close($connection);?></h4>
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