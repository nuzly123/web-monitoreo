<?php 
    require_once("includes/load.php");
    $session->logout();
    header("Location:login.php");
?>