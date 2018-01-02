<?php 
include_once("../classes/Database.php");
include_once("../classes/User.php");
session_start();
include_once("forms/navbar.php");
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
    <link rel="stylesheet" type ="text/css" href="css/stylesheet.css">
</head>
<body>
  <?php printNavBar()?>
<div id="menu-center">
<?php
$productList = Product::getProductList($dbh);
printTable("cato",$productList,3,3);
?>  
</div>  
</body>
</html>