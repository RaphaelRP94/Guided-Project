<?php

include_once("connection.php");

include("verifyLogin.php");

mysqli_close($connection);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ger's Garage</title>
    <link rel="stylesheet" href="_css/estilo.css">
    <link rel="stylesheet" href="_css/parts.css">
    <script src="_javascript/functions.js"></script>

    <style>
.models {
    display: none;
}
.menu-closer {
    width: 32px;
    height: 32px;
    display: none;
    font-size: 30px;
}
aside {
    background-color: white;
    width: 0vw;
    height: 0vh;
    transition: all ease .2s;
    overflow-x: hidden;
}
aside.show {
    width: 19vw;
    height: 100vh;
    display: inline;
    float: left;
    position: fixed;
    margin-left: 0px;
    top: 0px;
    bottom: 0px;
}
.cart--area {
    padding: 20px;
}
main {
    flex: 1;
    padding: 20px;
}
.model-area {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
}
.models-item {
    text-align: center;
    max-width: 250px;
    margin: 0 auto 50px auto;
}
.models-item a {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
}
.models-item--img {
    width: 200px;
    height: 200px;
    background-color: white;
    border-radius: 20px;
    box-shadow: 0px 10px 50px rgba(0,0,0,0.2);
}
.models-item--img img {
    width: 100%;
    border-radius: 20px;
    height: auto;
}
.models-item--add {
    width: 50px;
    height: 50px;
    line-height: 50px;
    border-radius: 25px;
    background-color: #388BC5;
    text-align: center;
    color: #FFF;
    font-size: 22px;
    cursor: pointer;
    margin-top: -25px;
    transition: all ease .2s;
}
.models-item a:hover .models-item--add {
    background-color: #244C88;
}
.models-item--price {
    font-size: 15px;
    color: #333;
    margin-top: 5px;
}
.models-item--name {
    font-size: 20px;
    color: #000;
    font-weight: bold;
    margin-top: 5px;
}
.modelsWindowsArea {
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    background-color: rgba(255,255,255, 0.5);
    display: none;
    transition: all ease .5s;
    justify-content: center;
    align-items: center;
    overflow: auto;
}
.modelsWindowsBody {
    width: 900px;
    background-color: #FFFF;
    border-radius: 10px;
    box-shadow: 0px 0px 15px #999;
    display: flex;
    margin: 20px 0;
}
.modelsBig {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}
.modelsBig--back {
    position: absolute;
    width: 30px;
    height: 30px;
    background-color: #000;
}
.modelsBig img {
    height: 400px;
    width: auto;
}
.modelsInfo {
    flex: 1;
    padding-bottom: 50px;
}
.modelsInfo h2 {
    margin-top: 50px;
}
.modelsInfo--sector {
    color: #CCC;
    text-transform: uppercase;
    font-size: 14px;
    margin-top: 30px;
    margin-bottom: 10px;
}
.modelsInfo--price {
    display: flex;
    align-items: center;
}
.modelsInfo--actualPrice {
    font-size: 28px;
    margin-right: 30px;
}
.modelsInfo--qtarea {
    display: inline-flex;
    background-color: #EEE;
    border-radius: 10px;
    height: 30px;
}
.modelsInfo--qtarea button {
    border: 0;
    background-color: transparent;
    font-size: 17px;
    outline: 0;
    cursor: pointer;
    padding: 0 10px;
    color: #333;
}
.modelsInfo--qt {
    line-height: 30px;
    font-size: 12px;
    font-weight: bold;
    padding: 0 5px;
    color: #000;
}
.modelsInfo--addButton {
    margin-top: 30px;
    padding: 20px 30px;
    border-radius: 20px;
    background-color: #48D05F;
    color: #FFF;
    display: inline-block;
    cursor: pointer;
    margin-right: 30px;
}
.modelsInfo--addButton:hover {
    background-color: #32A345;
}
.modelsInfo--cancelButton {
    display: inline-block;
    cursor: pointer;
}
.modelsInfo--cancelMobileButton {
    display: none;
    height: 40px;
    text-align: center;
    line-height: 40px;
    margin-bottom: 30px;
}
.cart {
    margin-bottom: 20px;
}
.cart--item {
    display: flex;
    align-items: center;
    margin: 10px 0;
}
.cart--item img {
    width: 40px;
    height: 40px;
    margin-right: 20px;
}
.cart--item-name {
    flex: 1;
}
.cart--item--qtarea {
    display: inline-flex;
    background-color: #EEE;
    border-radius: 10px;
    height: 30px;
}
.cart--item--qtarea button {
    border: 0;
    background-color: transparent;
    font-size: 17px;
    outline: 0;
    cursor: pointer;
    padding: 0 10px;
    color: #333;
}
.cart--item--qt {
    line-height: 30px;
    font-size: 12px;
    font-weight: bold;
    padding: 0 5px;
    color: #000;
}
.cart--totalitem {
    padding: 15px 0;
    border-top: 1px solid #79B9DD;
    color: #315970;
    display: flex;
    justify-content: space-between;
    font-size: 15px;
}
.cart--totalitem span:first-child {
    font-weight: bold;
}
.cart--totalitem.big {
    font-size: 20px;
    color: #000;
    font-weight: bold;
}
.cart--finish {
    padding: 20px 30px;
    border-radius: 20px;
    background-color: #48D05F;
    color: #FFF;
    cursor: pointer;
    text-align: center;
    margin-top: 20px;
    border: 2px solid #63F77C;
    transition: all ease .2s;
}
.cart--finish:hover {
    background-color: #35AF4A;
}
    </style>
    
</head>
<body>
    
        <aside>
            <div class="cart--area">
                <div class="menu-closer">
                    <span class="material-icons">close</span>
                </div>
                <h2>Your items:</h2>
                <div class="cart"></div>
                <div class="cart--details">
                    <div class="cart--totalitem subtotal">
                        <span>Subtotal</span>
                        <span>$ --</span>
                    </div>
                    <div class="cart--finish" action="booking.php">Finish</div>
                </div>
            </div>
        </aside>

    <div id="interface">
        
        <header id="cabecalho">
        <hgroup>
        <img src="_imagens/logo.png" alt="logo-small" id="logo">
        <h2>Making your machine</h2>
        <h2 id="secpart">brand new again</h2>
        </hgroup>
            <img id="icone" src="_imagens/especificacoes.png" alt="especificacoes">

            <nav id="menu">
            <h1>Menu Principal</h1>
            <ul type="disc">
                <li onmouseover="mudaFoto('_imagens/carmain.png')" onmouseout="mudaFoto('_imagens/especificacoes.png')"><a href="home.php">HOME</a></li>
                <li onmouseover="mudaFoto('_imagens/especificacoes.png')" onmouseout="mudaFoto('_imagens/especificacoes.png')"><a href="parts.php">VEHICLE PARTS</a></li>
                <li onmouseover="mudaFoto('_imagens/contato.png')" onmouseout="mudaFoto('_imagens/especificacoes.png')"><a href="booking.php">BOOKING</a></li>
                <li><a href="logout.php">LOG-OUT</a></li>
            </ul>
            </nav>
        </header>

        <div class="models">
            <div class="models-item">
                <a href="">
                    <div class="models-item--img">
                        <img src="" alt="">
                    </div>
                    <div class="models-item--add">+</div>
                </a>
                <div class="models-item--price">$ --</div>
                <div class="models-item--name">--</div>
            </div>
            <div class="cart--item">
                <img src="" alt="">
                <div class="cart--item-name">--</div>
                <div class="cart--item--qtarea">
                    <button class="cart--item--qtless">-</button>
                    <div class="cart--item--qt">1</div>
                    <button class="cart--item--qtmore">+</button>
                </div>
            </div>
        </div>
        <main>
            <h2>Vehicle Parts available:</h2>
            <div class="model-area"></div>
        </main>
        <div class="modelsWindowsArea">
            <div class="modelsWindowsBody">
                <div class="modelsInfo--cancelMobileButton">Go Back</div>
                <div class="modelsBig">
                    <img src="" alt="">
                </div>
                <div class="modelsInfo">
                    <h2>--</h2>
                    <div class="modelsInfo--pricearea">
                        <div class="modelsInfo--sector">Price</div>
                        <div class="modelsInfo--price">
                            <div class="modelsInfo--actualPrice">$ --</div>
                            <div class="modelsInfo--qtarea">
                                <button class="modelsInfo--qtless">-</button>
                                <div class="modelsInfo--qt">1</div>
                                <button class="modelsInfo--qtmore">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="modelsInfo--addButton">Add to your items</div>
                    <div class="modelsInfo--cancelButton">Cancel</div>
                </div>
            </div>
        </div>

        <footer id="foot">
            <p>&copy; Copyright 2021 - by Raphael Rocha <br>
            <a href="http://facebook.com" target="_blank">Facebook</a> | 
            <a href="http://twiter.com" target="_blank">Twitter</a></p>
        </footer>
    </div>
    
    <script src="_javascript/functions.js"></script>
    <script src="_javascript/models.js"></script>
    <script src="_javascript/script.js"></script>
</body>
</html>