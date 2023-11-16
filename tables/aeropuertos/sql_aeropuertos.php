<?php
require_once("includes/load.php");

if (isset($_POST['desactivar'])) {
  $modificado = make_date();
  update_estado("aeropuertos", $_POST['idAero'], "0", $modificado, $_SESSION['user_id']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=aeropuertos';</script>";
} else if (isset($_POST['activar'])) {
  $modificado = make_date();
  update_estado("aeropuertos", $_POST['idAero'], "1", $modificado, $_SESSION['user_id']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=aeropuertos';</script>";
}

if (isset($_POST['editarNombreAero'])) {
  update_field("aeropuertos", "aeropuerto",  $_POST['nombreAero'], "id", $_POST['editAero']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=aeropuertos';</script>";
}

if (isset($_POST['nuevoAero'])) {
  $nombre = $_POST['nombreAero'];
  $codigo = $_POST['codigoAero'];
  $latitud = $_POST['latitud'];
  $longitud = $_POST['longitud'];
  $fecha = make_date();
  $usuarioc = $_SESSION['user_id'];
  $db->query("INSERT INTO aeropuertos (aeropuerto, codigo, latitud, longitud, creado, usuarioc) values ('$nombre', '$codigo', $latitud, $longitud, '$fecha', '$usuarioc');");
  $session->msg("s", "El registro se ha añadido exitosamente.");
  echo "<script>window.location='?page=aeropuertos';</script>";
}
