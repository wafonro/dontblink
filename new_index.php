<?php
// Inialize session
include_once("classes/Database.php");
include_once("classes/User.php");
include_once("classes/Game.php");
include_once("forms/utils.php");
session_name("gaming-session");
session_start();
if (!isset($_SESSION['initiated'])) {
  session_regenerate_id();
  $_SESSION['initiated'] = true;
}
$dbh = Database::connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link href="./css/homestyle.css" type="text/css" rel="stylesheet">
</head>
<body>
<!-- TODO:: put navbar here -->
<div id="menu">
    <div id="menu-center">
        <? 
        $games = Game::getAllGames($dbh);
        foreach($games as $x){
            
            echo "
            <div id='con2' class='container'>
            <img class='demo-img' src='img/$x->photo' alt='$x->name game picture'>
            <h3>$x->name</h3>
            <button>Play</button>
            <button>Description</button>
            </div>";

        }
        ?>
        <!-- <div id="con1" class="container">
            <img src="img/" alt="Squared game picture">
                
        </div>

        <div id="con3"class="container">
            <img src="" alt="Squared game picture">        
        </div>
        <div id="con4" class="container">
            <img src="" alt="Squared game picture">            
        </div> -->

    </div>
    <div id=menu-right></div>
</div>
</body>
</html>