<?php
require_once("includes/load.php");

if (isset($_POST['desactivar'])) {
  $modificado=make_date();
  update_estado("cargos", $_POST['idCargo'], "0", $modificado , $_SESSION['user_id']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=cargos';</script>";
}else if (isset($_POST['activar'])) {
  $modificado=make_date();
  update_estado("cargos", $_POST['idCargo'], "1", $modificado , $_SESSION['user_id']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=cargos';</script>";
}

if(isset($_POST['editarNombreCargo'])) {
  update_field("cargos", "cargo",  $_POST['nombreCargo'], "id", $_POST['editCargo']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=cargos';</script>";
}

if(isset($_POST['nuevoCargo'])) {
  $nombre = $_POST['nombreCargo'];
  $fecha = make_date();
  $usuarioc=$_SESSION['user_id'];
  $db->query("INSERT INTO cargos (cargo, creado, usuarioc) values ('$nombre', '$fecha', '$usuarioc');");
  $session->msg("s", "El registro se ha añadido exitosamente.");
  echo "<script>window.location='?page=cargos';</script>";
}
?>