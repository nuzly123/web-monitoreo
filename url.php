<?php
    if(isset($_GET['page'])){
    switch ($_GET['page']) {
        case "ciudades":
            include 'tables/ciudades/ciudades.php';
            break;
        case "sql_ciudades":
            include 'tables/ciudades/sql_ciudades.php';
            break;
        case "estaciones":
            include 'tables/estaciones/estaciones.php';
            break;
        case "sql_estaciones":
            include 'tables/estaciones/sql_estaciones.php';
            break;
        case "departamentos":
            include 'tables/departamentos/departamentos.php';
            break;
        case "sql_dep":
            include 'tables/departamentos/sql_dep.php';
            break;
        case "contratos":
            include 'tables/contratos/contratos.php';
            break;
        case "sql_contratos":
            include 'tables/contratos/sql_contratos.php';
            break;
        case "aeropuertos":
            include 'tables/aeropuertos/aeropuertos.php';
            break;
        case "sql_aeropuertos":
            include 'tables/aeropuertos/sql_aeropuertos.php';
            break;
        case "cargos":
            include 'tables/cargos/cargos.php';
            break;
        case "sql_cargos":
            include 'tables/cargos/sql_cargos.php';
            break;
        case "nuevo_empleado":
            include 'forms/empleados/nuevo_empleado.php';
            break;
        case "sql_empleados":
            include 'forms/empleados/sql_empleados.php';
            break;
    }
}
?>