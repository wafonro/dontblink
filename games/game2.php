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
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Click the circle</title>
    <link rel="stylesheet" type="text/css" href="../css/gamestyle.css">    
    <script src="../js/jQuery.js"></script>
</head>
<body>

<?php echo "<div id='user-nickname' hidden>".$user->nickname."</div>"?>
<div id="forms">
<form action="" onsubmit="return updateN()" id="change-n">
<?php 
$value = 1;
if(isset($_GET["value"])){
    $value = $_GET["value"]/10;
    if(!is_numeric($value) || $value > 6 || $value < 1){
        $value = 1;
    }
}
echo '<input id = "slider" oninput="printValue(10,\'s\')" type="range" value="'.$value.'" min="1" max="6"> <span id="slider-value">'.(10*$value).'s'.'</span>';
?>
  <input type="submit" value="RESET">
</form>
<form action="../index.php">
<input type= "submit" id= "backbtn" value="BACK">
</form>
</div>
    <div id="canvas-container">
        <canvas id="myCanvas"></canvas>
    <div>
    <script src="../js/game2.js"></script>
    
<?php printFooter();?>