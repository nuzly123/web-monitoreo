<?php
    require_once("includes/load.php");
    if ($_POST){
        $respuesta=authenticate($_POST["email-username"],$_POST["password"]);
        if ($respuesta){
            $session->login($respuesta);
            updateLastLogIn($respuesta);
            header("Location:inicio.php");
        } else{
            $session->msg("d", "Usuario o contraseña incorrectos");
            header("Location:index.php");
        }
    }
?>