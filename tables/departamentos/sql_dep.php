<?php
require_once("includes/load.php");

if (isset($_POST['desactivar'])) {
  $modificado=make_date();
  update_estado("departamentos", $_POST['idDep'], "0", $modificado , $_SESSION['user_id']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=departamentos';</script>";
}else if (isset($_POST['activar'])) {
  $modificado=make_date();
  update_estado("departamentos", $_POST['idDep'], "1", $modificado , $_SESSION['user_id']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=departamentos';</script>";
}

if(isset($_POST['editarNombreDep'])) {
  update_field("departamentos", "departamento",  $_POST['nombreDep'], "id", $_POST['editDep']);
  $session->msg("s", "El registro se ha actualizado exitosamente.");
  echo "<script>window.location='?page=departamentos';</script>";
}

if(isset($_POST['nuevoDep'])) {
  $nombre = $_POST['nombreDep'];
  $fecha = make_date();
  $usuarioc=$_SESSION['user_id'];
  $db->query("INSERT INTO departamentos (departamento, creado, usuarioc) values ('$nombre', '$fecha', '$usuarioc');");
  $session->msg("s", "El registro se ha añadido exitosamente.");
  echo "<script>window.location='?page=departamentos';</script>";
}
?>