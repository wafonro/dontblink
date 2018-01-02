<?php

// Inialize session
session_name("gaming-session");
session_start();
if (!isset($_SESSION['initiated'])) {
  session_regenerate_id();
  $_SESSION['initiated'] = true;
}

// Delete certain session
unset($_SESSION['user']);
// Delete all session variables
session_destroy();

// Jump to login page
header('Location: ../index.php');

?>