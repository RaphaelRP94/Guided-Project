<?php

include_once("connection.php");

include("verifyLogin.php");

$vplate = $_POST['vplate'];
$message = $_POST['message'];
$servtype = $_POST['servtype'];
$bookingdate = $_POST['bookingdate'];
$mechanic = $_POST['mechanic'];

$localServLevel = 0;

if($servtype == 'Annual Service'){
    $localServLevel = 1;
} if($servtype == 'Major Service'){
    $localServLevel = 1;
} if($servtype == 'Repair/Fault'){
    $localServLevel = 1;
} if($servtype == 'Major Repair'){
    $localServLevel = 2;
}

$totalServLevel=0;

$sqlLevel = "SELECT SUM(serv_level) AS serv_level FROM bookings WHERE bookings.bookingdate = '$bookingdate'";
$resultLevel = mysqli_query($connection, $sqlLevel);
while($dbLevel = mysqli_fetch_array($resultLevel)) {
    $totalServLevel = $dbLevel[0];

    if(empty($totalServLevel)) {
        $totalServLevel = 0;
    };
}

$names = $_POST['names'];
$namesTest = str_replace(array('[',']','"'), '',$names);
$names = explode(',', $namesTest);
$qts = $_POST['qts'];
$qtsTest = str_replace(array('[',']','"'), '',$qts);
$qts = explode(',', $qtsTest);
$prices = $_POST['prices'];
$pricesTest = str_replace(array('[',']','"'), '',$prices);
$prices = explode(',', $pricesTest);

$length = count($qts);


//Here I check if is till possible to make a reservation in a specif date
//I set Major Repair counting double
//I set 16 because every 4 mechanics can take 4 services per day each

if($localServLevel + $totalServLevel > 16){
    $_SESSION['date-not-available'] = true;

    header ('Location: booking.php');
    exit();
} else {
    $sqlselect = "SELECT user_id FROM usercars WHERE vplate = '$vplate' AND user_id = '$user_id'";
    $result = mysqli_query($connection, $sqlselect);
    $row = mysqli_num_rows($result);

    if($row == 0){
        $_SESSION['not-in-database'] = true;// Here I check if the customer wants to create a booking for a car that it is not in his profile

        header ('Location: booking.php');
        exit();
    } else {
        $sqlBookingDate = "SELECT bookingdate FROM bookings WHERE bookings.user_id = '$user_id' AND bookings.bookingdate = '$bookingdate' AND bookings.vplate = '$vplate'";
        $sqlBookingDateExec = mysqli_query($connection, $sqlBookingDate);
        $rowBooking = mysqli_num_rows($sqlBookingDateExec);

        if($rowBooking >= 1){
            $_SESSION['already_booked'] = true;// Here I check if the customer has already booked that vehicle at that specific date

            header ('Location: booking.php');
            exit();
        } else {
            $sqlbooking = "INSERT INTO `bookings`(`vplate`, `user_id`, `message`, `servtype`, `bookingdate`, `booking_status`, `mechanic`,`serv_level`) VALUES ('$vplate', '$user_id', '$message','$servtype','$bookingdate', 'booked', '$mechanic','$localServLevel')";
            $saveuserbooking = mysqli_query($connection, $sqlbooking);

            $sqlBookingID = "SELECT booking_id FROM bookings WHERE bookings.vplate = '$vplate' AND bookings.user_id = '$user_id' AND bookings.bookingdate = '$bookingdate'";
            $sqlBookingIDExec = mysqli_query($connection, $sqlBookingID);

            $booking_id='0';
            do{
                while($dbBookingID = mysqli_fetch_array($sqlBookingIDExec)) {
                $booking_id = $dbBookingID[0];
            }
            } while(empty($booking_id));
            

            for ($index = 0; $index < $length; $index++){
                $sqlCart = "INSERT INTO `products`(`booking_id`, `vehicle_parts`, `quantity`, `price`) VALUES ('$booking_id', '$names[$index]', CAST('$qts[$index]' AS UNSIGNED), CAST('$prices[$index]' AS DECIMAL(8,2)))";
                $sqlCartExec = mysqli_query($connection, $sqlCart);
            }
        } 
    }
    

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
            <h1>Main Menu</h1>
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
                <h1>Booked successfully</h1>
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