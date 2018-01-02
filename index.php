<?php
// Inialize session
include_once("classes/Database.php");
include_once("classes/User.php");
include_once("forms/utils.php");
session_name("gaming-session");
session_start();
if (!isset($_SESSION['initiated'])) {
  session_regenerate_id();
  $_SESSION['initiated'] = true;
}
if(!isset($_SESSION["user"])){
    header("Location: forms/login.php");
}
else{
    header("Location: games/index.php");
}
?>
<?php printHeader("Home Page");?>
    <ul>
        <li><a href="games/game1.php">Game 1</a></li>
        <li><a href="games/game2.php">Game 2</a></li>
        <li><a href="games/game3.php">Game 3</a></li>     
        <li><a href="forms/logout.php">Log Out</a></li>
    </ul>
<?php printFooter();?>