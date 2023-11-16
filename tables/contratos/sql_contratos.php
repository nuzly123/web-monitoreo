<?php
require_once("includes/load.php");

if (isset($_POST['desactivar'])) {
  $modificado=make_date();
  update_estado("contratos", $_POST['idContrato'], "0", $modificado , $_SESSION['user_id']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=contratos';</script>";
}else if (isset($_POST['activar'])) {
  $modificado=make_date();
  update_estado("contratos", $_POST['idContrato'], "1", $modificado , $_SESSION['user_id']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=contratos';</script>";
}

if(isset($_POST['editarnombreCon'])) {
  update_field("contratos", "tipo",  $_POST['nombreCon'], "id", $_POST['editDep']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=contratos';</script>";
}

if(isset($_POST['nuevoContrato'])) {
  $nombre = $_POST['tipoContrato'];
  $fecha = make_date();
  $usuarioc=$_SESSION['user_id'];
  $db->query("INSERT INTO contratos (tipo, creado, usuarioc) values ('$nombre', '$fecha', '$usuarioc');");
  $session->msg("s", "El registro se ha añadido exitosamente.");
  echo "<script>window.location='?page=contratos';</script>"; 
}
?>