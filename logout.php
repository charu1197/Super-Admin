<?php

session_start();
// unset($_SESSION['UserLogin']);
// unset($_SESSION['Access']);
$_SESSION = array();

session_destroy();

header("Location: login.php");
exit;
?>