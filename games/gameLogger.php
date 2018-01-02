<?php 
include_once("../classes/Database.php");
include_once("../classes/User.php");
session_name("gaming-session");
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}
if(isset($_SESSION['user'])){
    $user = $_SESSION["user"];
}
$dbh = Database::connect();
print_r($_POST);
if(isset($_POST['nickname']))
    User::push_data($dbh,$_POST['nickname'],$_POST['game'],$_POST['score']);

?>