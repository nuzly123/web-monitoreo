<?php 
    require_once("includes/load.php");
    
    if($session->isUserLoggedIn(true)){
        include_once ('layouts/header.php');
        //include_once ('layouts/menu.php');    
        include_once ('url.php');
        include_once ('layouts/footer.php');
    }else{
        header("Location:login.php");
    }
?>