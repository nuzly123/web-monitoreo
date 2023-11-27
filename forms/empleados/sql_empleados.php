<?php
require_once("includes/load.php");

if (isset($_POST['nuevoEmpleado'])) {
    $identidad = $_POST['txtID'];
    $nombre = $_POST['txtNombre'];
    $apellido = $_POST['txtApellido'];
    $birth = $_POST['birthDate'];
    $direccion = $_POST['txtDireccion'];
    $correo = $_POST['txtCorreo'];
    $depto = $_POST['selectDep']; 
    $cargo = $_POST['txtCargo'];
    $telefono = $_POST['txtTelefono'];
    $estacion = $_POST['selectEstacion'];
    $fechaIngreso = $_POST['fechaIngreso'];
    $fecha = make_date();
    $usuarioc = $_SESSION['user_id'];
    $contrato = $_POST['selectContrato'];

    $db->query("INSERT INTO empleados (identidad, nombre, apellido, telefono, correo, fecha_nacimiento, direccion, id_depto, cargo, id_estacion, fecha_ingreso, id_contrato, usuarioc, creado) 
    values ('$identidad', '$nombre', '$apellido', '$telefono', '$correo', '$birth', '$direccion', '$depto', '$cargo', '$estacion', '$fechaIngreso', '$contrato', '$usuarioc', '$fecha');");
    $session->msg("s", "El registro se ha añadido exitosamente.");
    echo "<script>window.location='?page=nuevo_empleado';</script>";
  }
?>