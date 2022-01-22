<?php

include_once("connection.php");

include("verifyLogin.php");

$filterName = isset($_GET['filterName'])?$_GET['filterName']:"";
$filterSurname = isset($_GET['filterSurname'])?$_GET['filterSurname']:"";

$sqlName = "SELECT users.user_id FROM users WHERE users.name = '$filterName' AND users.surname = '$filterSurname'";
$searchUser = mysqli_query($connection, $sqlName);


$filter = isset($_GET['filter'])?$_GET['filter']:"";

$sqlselect = "SELECT users.name,users.surname,users.licence,users.email,users.phone,users.gender,users.birthdate FROM users WHERE users.user_id = '$filter'";
$search = mysqli_query($connection, $sqlselect);

$sqlAddress = "SELECT useraddress.address,useraddress.number,useraddress.neighborhood,useraddress.eircode,useraddress.city FROM useraddress WHERE useraddress.user_id = '$filter'";
$searchAddress = mysqli_query($connection, $sqlAddress);

$sqlVehicles = "SELECT usercars.make,usercars.model,usercars.fuel,usercars.vplate FROM usercars WHERE usercars.user_id = '$filter'";
$searchVehicles = mysqli_query($connection, $sqlVehicles);

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

        </br>
        <form method="get" action="">
          Customer Name: <input type="text" name="filterName"></br></br>
          Customer Surname: <input type="text" name="filterSurname">
            <input type="submit" value="Search">
        </form>
        <?php
        $showUserId = mysqli_fetch_array($searchUser);
        if(empty($showUserId)){
          $showUserId = "";
        } else {
          echo "</br></br>The custome's ID is: <strong>$showUserId[0]</strong>.</br></br>";
        }
        ?>

      </br>
        <form method="get" action="">
          Input user id: <input type="number" min="1" name="filter" id="filter" required>
            <input type="submit" value="Search">
        </form>

        <h3>User Details:</h3>
        
        <table class="tabela-spec">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Licence</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Birthdate</th>
                    <th>Delete</th>
                    <th>Update</th>
            
                </tr>
            </thead>
            <tbody>
                <?php

                while($showRegisters = mysqli_fetch_array($search)) {

                    $name = $showRegisters[0];
                    $surname = $showRegisters[1];
                    $licence = $showRegisters[2];
                    $email = $showRegisters[3];
                    $phone = $showRegisters[4];
                    $gender = $showRegisters[5];
                    $birthdate = $showRegisters[6];

                    if(empty($name) || $name == 'Ger') {
                        $name = '';
                    };
                    if(empty($Surname)) {
                        $Surname = '';
                    };
                    if(empty($licence)) {
                        $licence = '';
                    };
                    if(empty($email) || $email == 'admin@admin.com') {
                        $email = '';
                    };
                    if(empty($phone)) {
                        $phone = '';
                    };
                    if(empty($gender)) {
                        $gender = '';
                    };
                    if(empty($birthdate)) {
                        $birthdate = '';
                    };

                    echo "<tr>";
                    echo "<td>$name</td>";
                    echo "<td>$surname</td>";
                    echo "<td>$licence</td>";
                    echo "<td>$email</td>";
                    echo "<td>$phone</td>";
                    echo "<td>$gender</td>";
                    echo "<td>$birthdate</td>";
                    echo "<td><img id='delete_user' src='_imagens/remove.ico' alt='remove-icon' width = 20rem></td>";
                    echo "<td><img id='update_user' style='cursor: pointer;' src='_imagens/pencil.png' alt='remove-icon' width = 20rem></td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
            
        </table>

            </br><form method="post" id="fContatoUser" action="adminDeleteUserProcess.php">
        <fieldset><legend>Please confirm the user ID</legend>
          <p>User ID: <input type="number" name="user_id" size="10" maxlength="6" required></p>
        </fieldset>
          <input id="sendbut" type="image" name="submit" value="submit" src="_imagens/botao-enviar.png" alt="Submit Button">
        </form></br>

        </br><form method="post" id="fContatoUserUpdate" action="adminUpdateUserProcess.php">
        <fieldset id="usuario"><legend>Set customer's details</legend>
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
            <fieldset><legend>Please confirm the user ID</legend>
            <p>User ID: <input type="number" name="user_id" size="10" maxlength="6" required></p>
            </fieldset>
          <input id="sendbut" type="image" name="submit" value="submit" src="_imagens/botao-enviar.png" alt="Submit Button">
        </form></br>

        <h3>User Address:</h3>

        <table class="tabela-spec">
            <thead>
                <tr>
                    <th>Address</th>
                    <th>Number</th>
                    <th>Neighborhood</th>
                    <th>Eir Code</th>
                    <th>City</th>
                    <th>Delete</th>
                    <th>Update</th>
            
                </tr>
            </thead>
            <tbody>
                <?php

                while($registers = mysqli_fetch_array($searchAddress)) {

                    $address = $registers[0];
                    $number = $registers[1];
                    $neighborhood = $registers[2];
                    $eirCode = $registers[3];
                    $city = $registers[4];

                    if(empty($address)) {
                        $address = '';
                    };
                    if(empty($number)) {
                        $number = '';
                    };
                    if(empty($neighborhood)) {
                        $neighborhood = '';
                    };
                    if(empty($eirCode)) {
                        $eirCode = '';
                    };
                    if(empty($city)) {
                        $city = '';
                    };

                    echo "<tr>";
                    echo "<td>$address</td>";
                    echo "<td>$number</td>";
                    echo "<td>$neighborhood</td>";
                    echo "<td>$eirCode</td>";
                    echo "<td>$city</td>";
                    echo "<td><img id='delete_address' src='_imagens/remove.ico' alt='remove-icon' width = 20rem></td>";
                    echo "<td><img id='update_address' style='cursor: pointer;' src='_imagens/pencil.png' alt='update-icon' width = 20rem></td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    
        </br><form method="post" id="fContatoAddress" action="adminDeleteAddressProcess.php">
        <fieldset><legend>Please confirm the user ID</legend>
          <p>User ID: <input type="number" name="user_id" size="10" maxlength="6" required></p>
        </fieldset>
          <input id="sendbut" type="image" name="submit" value="submit" src="_imagens/botao-enviar.png" alt="Submit Button">
        </form></br>

        <form id="fContatoAddressUpdate" action="adminUpdateUserAddressProcess.php">
            <fieldset id="endereco"><legend>User Address</legend>
                <p><label for="cPub">Neighborhood:</label><input type="text" name="neighborhood" size="20" maxlength="20" placeholder="Ranelagh, Liberty, East Wall..." required></p>
                <p><label for="cRua">Address:</label><input type="text" name="address" size="25" maxlength="60" placeholder="O'Connell Street" required></p>
                <p><label for="cNum">Number:</label><input type="number" name="number" min="0" max="99999" required></p>
                <p><label for="cEst"type="text">Eir Code:</label><input type="text" name="eircode" size="13" maxlength="7" required></p>
                <p><label for="cCid">City:</label><input type="text" name="city" maxlength="20" size="20" placeholder="Dublin, Cork, Limerick, Galway..." required></p>
            </fieldset>
            <fieldset><legend>Please confirm the user ID</legend>
                <p>User ID: <input type="number" name="user_id" size="10" maxlength="6" required></p>
            </fieldset>
            <input id="sendbut" type="image" name="submit" value="submit" src="_imagens/botao-enviar.png" alt="Submit Button">
        </form>

        <h3>User Vehicles:</h3>
        <table class="tabela-spec">
            <thead>
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Engine</th>
                    <th>Vehicle Plate</th>
                    <th>Delete</th>
                    <th>Update</th>
            
                </tr>
            </thead>
            <tbody>
                <?php

                while($vehicleRegisters = mysqli_fetch_array($searchVehicles)) {

                    $make = $vehicleRegisters[0];
                    $model = $vehicleRegisters[1];
                    $engine = $vehicleRegisters[2];
                    $vehiclePlate = $vehicleRegisters[3];

                    if(empty($make)) {
                        $make = '';
                    };
                    if(empty($model)) {
                        $model = '';
                    };
                    if(empty($engine)) {
                        $engine = '';
                    };
                    if(empty($vehiclePlate)) {
                        $vehiclePlate = '';
                    };

                    echo "<tr>";
                    echo "<td>$make</td>";
                    echo "<td>$model</td>";
                    echo "<td>$engine</td>";
                    echo "<td>$vehiclePlate</td>";
                    echo "<td><img id='delete_vehicle' src='_imagens/remove.ico' alt='remove-icon' width = 20rem></td>";
                    echo "<td><img id='update_vehicle' style='cursor: pointer;' src='_imagens/pencil.png' alt='update-icon' width = 20rem></td>";
                    echo "</tr>";
                }
                mysqli_close($connection);
                ?>
            </tbody>
        </table>

        </br><form method="post" id="fContatoVehicle" action="adminDeleteVehicleProcess.php">
        <fieldset><legend>Please confirm the details</legend>
          <p>Vehicle plate: <input type="text" name="vplate" size="10" maxlength="9" required></p>
          <p>User ID: <input type="number" name="user_id" size="10" maxlength="6" required></p>
        </fieldset>
          <input id="sendbut" type="image" name="submit" value="submit" src="_imagens/botao-enviar.png" alt="Submit Button">
        </form></br>

        <form id="fContatoVehicleUpdate" action="adminUpdateUserVehicleProcess.php">
            <fieldset><legend>Vehicle Details</legend>
                <p><label for="cMak">Make:</label><input type="text" name="make" size="13" maxlength="20" placeholder="BMW, Toyota, volkswagen, ..." required></p>
                <p><label for="cMod">Model:</label><input type="text" name="model" size="13" maxlength="20" placeholder="Focus, Golf..." required></p>
                <p><label for="cPlate">Vehicle plate:</label> <input type="text" name="vplate" size="10" maxlength="9" required></p>
                <fieldset><legend>Engine type:</legend>
                    <input type="radio" name="fuel" value="petrol" required><label for="fuel">Petrol</label><br>
                    <input type="radio" name="fuel" value="diesel" required><label for="fuel">Diesel</label><br>
                    <input type="radio" name="fuel" value="eletric" required><label for="fuel">Electric</label><br>
                    <input type="radio" name="fuel" value="hybrid" required><label for="fuel">Hybrid</label>
                </fieldset>
                <fieldset><legend>Please confirm the previous vehicle plate and customer's ID</legend>
                <p>Vehicle plate: <input type="text" name="vplate" size="10" maxlength="9" required></p>
                <p>User ID: <input type="number" name="user_id" size="10" maxlength="6" required></p>
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

    <script>
        // Everything below was coded in order to make the page better looking

        function deleteUser() {
            document.getElementById('fContatoUser').style.display = 'block';
        };

        document.getElementById('delete_user').addEventListener('click', deleteUser);

        function deleteAddress() {
            document.getElementById('fContatoAddress').style.display = 'block';
        };

        document.getElementById('delete_address').addEventListener('click', deleteAddress);

        function deleteVehicle() {
            document.getElementById('fContatoVehicle').style.display = 'block';
        };

        document.getElementById('delete_vehicle').addEventListener('click', deleteVehicle);

        function updateUser() {
            document.getElementById('fContatoUserUpdate').style.display = 'block';
        };

        document.getElementById('update_user').addEventListener('click', updateUser);

        function updateAddress() {
            document.getElementById('fContatoAddressUpdate').style.display = 'block';
        };

        document.getElementById('update_address').addEventListener('click', updateAddress);

        function updateVehicle() {
            document.getElementById('fContatoVehicleUpdate').style.display = 'block';
        };

        document.getElementById('update_vehicle').addEventListener('click', updateVehicle);
    </script>
</body>
</html>