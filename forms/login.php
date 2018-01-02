<?php 
  include_once("../classes/Database.php");
  include_once("../classes/User.php");
  session_name("gaming-session");
  session_start();
  if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
  }
  $dbh = Database::connect();
  if(isset($_POST["uemail"])){
    $user = User::logInUser($dbh,$_POST["uemail"],$_POST["psw"]);
    if($user){
      $_SESSION["user"] = $user;
      unset($_SESSION["wrong-login"]);      
    }
    else{
      $_SESSION["wrong-login"] = true;
    }
  }
  if(isset($_SESSION["user"])){
    header("Location: ../index.php");
  }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/loginstyle.css">
    <script src="../js/jQuery.js"></script>
</head>

<body>
<div class="container">
    <form method="post">
    <label><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="uemail" required>
    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <?php
      if(isset($_SESSION["wrong-login"])){
        echo "<p style='color:red'>Wrong email and/or password</p>";
        unset($_SESSION["wrong-login"]);      
      }
      
    ?>
    <button type="submit">Login</button>
    </form>
    <form action="signup.php">
      <button type= "submit" id= "signupbtn">Sign Up</button>
    </form>
    <form action="recover.php"> 
      <button type= "submit" id= "recoverbtn">Forgot Password</button>
    </form>
  </div>
</body>
<html>