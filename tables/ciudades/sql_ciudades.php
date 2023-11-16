<?php
require_once("includes/load.php");

if (isset($_POST['desactivar'])) {
  $modificado=make_date();
  update_estado("ciudades", $_POST['idCiudad'], "0", $modificado , $_SESSION['user_id']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=ciudades';</script>";
}else if (isset($_POST['activar'])) {
  $modificado=make_date();
  update_estado("ciudades", $_POST['idCiudad'], "1", $modificado , $_SESSION['user_id']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=ciudades';</script>";
}

if(isset($_POST['editarNombreCiudad'])) {
  update_field("ciudades", "ciudad",  $_POST['nombreCiudad'], "id", $_POST['editCiudad']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=ciudades';</script>";
}

if(isset($_POST['nuevaCiudad'])) {
  $nombre = $_POST['nombreCiudad'];
  $fecha = make_date();
  $usuarioc=$_SESSION['user_id'];
  $db->query("INSERT INTO ciudades (ciudad, creado, usuarioc) values ('$nombre', '$fecha', '$usuarioc');");
  $session->msg("s", "El registro se ha añadido exitosamente.");
  echo "<script>window.location='?page=ciudades';</script>";
}
?>