<!DOCTYPE html>
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
  User::signUpUser($dbh,$_POST["uemail"],$_POST["uname"],$_POST["psw"]);
  $user = User::logInUser($dbh,$_POST["uemail"],$_POST["psw"]);
  if($user){
    $_SESSION["user"] = $user;
  }
  if(isset($_SESSION["user"]))
    header("Location: ../index.php");
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SignUp</title>
    <link rel="stylesheet" type="text/css" href="../css/loginstyle.css">
    <script src="../js/jQuery.js"></script>
    <!-- <script src="../js/signUpCheck.js"></script> -->
</head>
<body>

  <div class="container">
  <form method="post">
    <label><b>Email</b></label>
    <input type="email" placeholder="Enter Username" name="uemail" required>
    <label><b>Nickname</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <?php
      if(isset($_SESSION["invalid-email"])){
        echo "<p style='color:red'>email used or in wrong format </p>";
        unset($_SESSION["invalid-email"]);      
      }
      if(isset($_SESSION["invalid-nick"])){
        echo "<p style='color:red'>nickname used or in wrong format</p>";
        unset($_SESSION["invalid-nick"]);      
      }
      if(isset($_SESSION["invalid-password"])){
        echo "<p style='color:red'>password empty or in wrong format</p>";
        unset($_SESSION["invalid-password"]);      
      }
      
    ?>
    <button type="submit">Sign Up</button>
  </form>
  <form action="login.php">
      <button type= "submit" id= "recoverbtn">Back</button>
  </form>
  </div>


</body>
</html>
