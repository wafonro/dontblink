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
if(isset($_SESSION['user']))
    $user = $_SESSION["user"];
else
    header("Location: ../forms/login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
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
            <div class='container'>
            <img class='demo-img' src='img/$x->photo' alt='$x->name game picture'>
            <h3>".strtoupper($x->name)."</h3>
            <button class='btn btn-success'>  Play  </button>
            <form action='descriptions/game_description.php' method='GET'>
            <button class='btn btn-danger' type='submit' name='game' value='$x->name'>Description</button>
            </form>
            </div>";

        }
        ?>

    </div>
    <div id=menu-right>
        <ul>
            <li>User : <?php echo "$user->nickname"?></li>
            <li>Numplays : <?php echo "$user->numplays"?> </li>
        </ul>
    </div>
</div>
</body>
</html>