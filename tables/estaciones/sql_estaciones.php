<?php
require_once("includes/load.php");

if (isset($_POST['desactivar'])) {
  $modificado=make_date();
  update_estado("estaciones", $_POST['idEstacion'], "0", $modificado , $_SESSION['user_id']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=estaciones';</script>";
}else if (isset($_POST['activar'])) {
  $modificado=make_date();
  update_estado("estaciones", $_POST['idEstacion'], "1", $modificado , $_SESSION['user_id']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=estaciones';</script>";
}

if(isset($_POST['editarNombreEstacion'])) {
  update_field("estaciones", "estacion",  $_POST['nombreEstacion'], "id", $_POST['idEstacion']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=estaciones';</script>";
}

if(isset($_POST['nuevaEstacion'])) {
  $nombre = $_POST['nombreEstacion'];
  $fecha = make_date();
  $usuarioc=$_SESSION['user_id'];
  $db->query("INSERT INTO estaciones (estacion, creado, usuarioc) values ('$nombre', '$fecha', '$usuarioc');");
  $session->msg("s", "El registro se ha añadido exitosamente.");
  echo "<script>window.location='?page=estaciones';</script>";
}
?>