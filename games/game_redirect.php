<?php 
include_once("../classes/Database.php");
include_once("../classes/User.php");
include_once("../forms/utils.php");

session_name("gaming-session");

session_start();
if (!isset($_SESSION['initiated'])) {
  session_regenerate_id();
  $_SESSION['initiated'] = true;
}
if(isset($_SESSION['user']))
    $user = $_SESSION["user"];
else
    header("Location: ../forms/login.php");
if($_GET["game"] == "squared"){
    header("Location: game1.php");
}else if($_GET["game"] == "clickthecircle"){
    header("Location: game2.php");
}else if($_GET["game"] == "dontblink"){
    header("Location: game3.php");
}
?>