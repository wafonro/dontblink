<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/loginstyle.css">
    <script src="../js/jQuery.js"></script>
    <script src="../js/recoverCheck.js"></script>   
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<div class="container">
    <form action="#">
    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
    <div class="g-recaptcha" data-sitekey="6LcTWTwUAAAAAFhd1lkKZWokOrvaEHYvWCg_rWQD"></div>
    <button type="submit">Send request</button>
    </form>
    <form action="login.php"> 
      <button type= "submit" id= "recoverbtn">Back</button>
    </form>
</div>

</body>
</html>
