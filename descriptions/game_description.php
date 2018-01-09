<?php 
include_once("../classes/Database.php");
include_once("../classes/User.php");
include_once("../classes/Game.php");
session_start();
// include_once("forms/navbar.php");
$dbh = Database::connect();
try{
    $game = Game::getGameByName($dbh,$_GET["game"]);
}catch(Exception $e){
    print_r($e);
}
?>
<!DOCTYPE html>]
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet"> 
    <link rel="stylesheet" type ="text/css" href="../css/game_description.css">
    <script src="../js/jQuery.js"></script>
    <script src="../js/game_description.js"></script>
</head>
<body>
<?php 
echo"<div id='menu-center'>
    <h1>$game->name</h1>
    <img id='game_image'src='../img/$game->photo' alt=''>
    <h2>Description</h2>
    <p id='description'>$game->description</p>
    <h2>$game->type : <span id='slider-value'>".($game->multiplier*$game->min)."</span>$game->unit</h2>
    <form action='../games/$game->link' method='GET'>   
        <div id='slider-container'>
        <input name='value' type='range' step='$game->multiplier' min='".($game->multiplier*$game->min)."' max='".($game->multiplier*$game->max)."' value='".($game->multiplier*$game->min)."' id='slider'>
        </div>
    <input type='submit' id='to_game' class='btn btn-success' value='Play'></button>
    </form>
    <button id='return' class='btn btn-info'> Back</button>
</div>";
?>  
</body>
</html>