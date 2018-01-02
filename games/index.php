<?php
// Inialize session
include_once("../classes/Database.php");
include_once("../classes/User.php");

session_name("gaming-session");
session_start();
if (!isset($_SESSION['initiated'])) {
  session_regenerate_id();
  $_SESSION['initiated'] = true;
}
if(!isset($_SESSION["user"])){
    header("Location: forms/login.php");
}
if(isset($_SESSION['user']))
    $user = $_SESSION["user"];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Play Games!</title>
</head>
<body>
    <?php echo "<p>Hello $user->nickname!!!</p>"; ?>
    <ul>
        <li><a href="game1.php">Game 1</a></li>
        <li><a href="game2.php">Game 2</a></li>
        <li><a href="game3.php">Game 3</a></li>     
        <li><a href="../forms/logout.php">Log Out</a></li>
    </ul>
    
</body>
</html>