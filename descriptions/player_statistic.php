<?php 
include_once("../classes/Database.php");
include_once("../classes/User.php");
session_start();
// include_once("forms/navbar.php");
$dbh = Database::connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type ="text/css" href="../css/game_description.css">
    <script src="../js/jQuery.js"></script>
    <script src="../js/game_description.js"></script>
</head>
<body>
  <?php //printNavBar()?>
<div id="menu-center">
    <h1>Squared</h1>
    <img id="game_image"src="../img/game1.png" alt="">
    <h2>Description</h2>
    <p id="description">In this game the player must click the numbers from 1 to n in their increasing order the fastest possible. The player can choose a board side from 4 to 10 squares and there is a penalty of 5s for each wrong click</p>
    <h2>Size: <span id="slider-value">4</span></h2>    
    <div id="slider-container">
        <input type="range" min="4" max="10" value="4" id="slider">
    </div>
        <button id="to_game" class="btn btn-success"> Play</button>
        <button id="return" class="btn btn-info"> Back</button>
</div>  
</body>
</html>