<?php
  require_once('load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}  

function find_all_v2($table, $orderby='id') {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM {$db->escape($table)} where estado = '1' order by {$db->escape($orderby)}");
   }
} 

function find_all_v3($table, $estado) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM {$db->escape($table)} where estado = {$db->escape($estado)} order by fechalimite asc limit 5");
   }
} 

function find_all_state($table, $estado1, $estado2) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM {$db->escape($table)} where estado = {$db->escape($estado1)} or estado = {$db->escape($estado2)} or estado = {$db->escape($estado2)}");
   }
} 

function grafico(){
  global $db;
  //$id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT categorias_equipos.categoria, COUNT(idcategoria) as cantidad FROM inventario inner join categorias_equipos WHERE inventario.idcategoria = categorias_equipos.id GROUP BY idcategoria
");
  while ($row =  $db->fetch_assoc($sql)) {
    # code...
    $result[] = $row;
  }
  return $result;
}

function grafico_departamentos(){
  global $db;
  //$id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT ciudad, COUNT(idciudad) as cantidad FROM empleados INNER JOIN ciudades on ciudades.id = empleados.idciudad WHERE empleados.estado = 1 GROUP BY idciudad");
  while ($row =  $db->fetch_assoc($sql)) {
    # code...
    $result[] = $row;
  }
  return $result;
}

function graficoInventario(){
  global $db;
  //$id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT SUM(ic.costo*i.stock) as total, m.simbolo as moneda, SUM(i.stock) as items, ta.tipo 
FROM inventario as i 
inner join inventario_costo as ic on i.id = ic.idinventario 
inner join equipos as e on i.idequipo = e.id 
inner join tipos_aeronaves as ta on ta.id = e.idtipoaeronave
inner join monedas as m on m.id = ic.idmoneda 
group by e.idtipoaeronave, ic.idmoneda;");
  while ($row =  $db->fetch_assoc($sql)) {
    # code...
    $result[] = $row;
  }
  return $result;
}

function cumpleanios($mes){
  global $db;
  $mes = (int)$mes;
  $result = array();
  $sql = $db->query("SELECT nombre, apellido, DAY(fechanacimiento) as dia, fechanacimiento FROM empleados where MONTH(fechanacimiento) = {$db->escape($mes)} and estado = 1 order by DAY(fechanacimiento) ASC;");
  while ($row =  $db->fetch_assoc($sql)) {
    # code...
    $result[] = $row;
  }
  return $result;
}

function proveedores_contactos(){
  global $db;
  //$id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT proveedores.id, proveedores.compania, proveedores.idpais, proveedores.ciudad, proveedores_contactos.nombre FROM proveedores
                     RIGHT JOIN proveedores_contactos ON proveedores.id = proveedores_contactos.idproveedor ");
  while ($row =  $db->fetch_assoc($sql)) {
    # code...
    $result[] = $row;
  }
  return $result;
}

function contactosProveedores($id){
  global $db;
  $id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT proveedores_contactos.id, proveedores_contactos.nombre, proveedores_contactos.telefono, proveedores_contactos.correo, proveedores_contactos.estado, proveedores_contactos.creado, proveedores_contactos.modificado, proveedores_contactos.usuarioc, proveedores_contactos.usuariom FROM proveedores_contactos
                     RIGHT JOIN proveedores ON proveedores_contactos.idproveedor = proveedores.id 
                     WHERE proveedores_contactos.idproveedor = {$db->escape($id)} limit 5" );
  while ($row =  $db->fetch_assoc($sql)) {
    # code...
    $result[] = $row;
  }
  return $result;
}

function historial_entradas($idproducto){
  global $db;
  $id = (int)$idproducto;
  $result = array();
  $sql = $db->query("SELECT * FROM entradas INNER JOIN detalle_avionica 
                     ON entradas.id = detalle_avionica.identrada 
                     WHERE entradas.idinventario = {$db->escape($id)}");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}

function detalle_avionica($identrada){
  global $db;
  $id = (int)$identrada;
  $result = array();
  $sql = "SELECT detalle_avionica.identrada, detalle_avionica.fechacurado, detalle_avionica.material, detalle_avionica.grupo, 
                 detalle_avionica.vidautil, detalle_avionica.fechavencimiento, detalle_avionica.posibleextension, detalle_avionica.creado, detalle_avionica.usuarioc 

                 FROM detalle_avionica right join entradas 
                 on detalle_avionica.identrada = entradas.id
                 where detalle_avionica.identrada = {$db->escape($id)}";
  /*while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;*/

  $result = $db->query($sql);
     return($db->fetch_assoc($result));
}

/** solicitud de equipo**/

function solicitudes_equipos(){
  global $db;
  //$id = (int)$idproducto;
  $result = array();
  $sql = $db->query("SELECT se.id, se.idprioridadequipo, se.fecharequerida, se.solicitante, se.estado, se.creado, se.usuarioc, sed.idequipo, sed.cantidad, sed.referenciaipc, sed.idaeronave FROM solicitudes_equipos as se INNER JOIN solicitudes_equipos_detalles as sed ON se.id = sed.idsolicitudequipo"); 
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}

function solicitudes_equipos_by_id($id){
  global $db;
  $id = (int)$id;
  $sql = $db->query("SELECT se.id, se.idprioridadequipo, se.fecharequerida, se.solicitante, se.idaeronave, se.estado, se.creado, se.usuarioc, se.modificado, se.usuariom, sed.idequipo, sed.cantidad, sed.referenciaipc FROM solicitudes_equipos as se INNER JOIN solicitudes_equipos_detalles as sed ON se.id = sed.idsolicitudequipo where se.id = {$db->escape($id)}"); 
  if($result = $db->fetch_assoc($sql))
    return $result;
  else
    return null;
}

function find_detalles($tabla,$campo,$id,$order){
  global $db;
  $id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT * FROM {$db->escape($tabla)} where {$db->escape($campo)} = {$db->escape($id)} order by {$db->escape($order)} ASC"); 
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}

function prorateo_detalles($id){
  global $db;
  $id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT pd.id, pd.idprorateo, pd.cantidad, e.descripcion, e.numeroparte, e.numeropartealterno, tc.id as idcodigo, tc.codigo, 
                            pd.tiempoespera, ut.id as idunidadtiempo, ut.unidad, m.simbolo, pd.precio, pd.core, pd.garantia, pd.subtotal, autorizado_compra 
                    FROM prorateo_detalle as pd
                    INNER JOIN prorateo as p ON p.id = pd.idprorateo
                    INNER JOIN solicitudes_equipos_detalles as sed on sed.id = pd.idsolicitudesdetalle
                    INNER JOIN tipos_condicion as tc on tc.id = pd.idcondicion
                    INNER JOIN equipos as e ON e.id = sed.idequipo
                    INNER JOIN monedas as m ON m.id = p.idmoneda
                    INNER JOIN unidades_tiempo as ut ON ut.id = pd.idunidadtiempo
                    where p.id = {$db->escape($id)} order by id"); 
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}


function detalle_calibracion($identrada){
  global $db;
  $id = (int)$identrada;
  $result = array();
  $sql = "SELECT detalle_hcalibracion.identrada, detalle_hcalibracion.ultimacalibracion, detalle_hcalibracion.proximacalibracion, detalle_hcalibracion.unidad, 
                 detalle_hcalibracion.rango, detalle_hcalibracion.fabricante, detalle_hcalibracion.estado, detalle_hcalibracion.creado, detalle_hcalibracion.usuarioc 
                 FROM detalle_hcalibracion right join entradas 
                 on detalle_hcalibracion.identrada = entradas.id
                 where detalle_hcalibracion.identrada = {$db->escape($id)}";
  /*while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;*/

  $result = $db->query($sql);
     return($db->fetch_assoc($result));
}


function entradas_by_equipo($idproducto)
{
  # code...
  global $db;
  $id = (int)$idproducto;
  $result = array();
  $sql = $db->query("SELECT e.id,e.idproveedor,e.rfq,e.fechacompra,e.numeroorden,e.rfq,sum(ed.cantidad) as cantidad,e.creado,e.usuarioc FROM entradas as e INNER JOIN entradas_detalles as ed ON e.id = ed.identrada WHERE ed.idequipo = {$db->escape($id)} group by numeroorden order by creado desc");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}

function salidas_by_equipo($idproducto)
{
  # code...
  global $db;
  $id = (int)$idproducto;
  $result = array();
  $sql = $db->query("SELECT s.id, i.idequipo, e.numeroparte, e.numeropartealterno, i.numeroserie, 
                    a.matricula, s.cantidad, emp.nombre, emp.apellido, s.razoninstalacion, s.creado, s.usuarioc
                    FROM salidas as s INNER JOIN inventario as i 
                    ON s.idinventario = i.id
                    INNER JOIN equipos as e
                    ON i.idequipo = e.id
                    INNER JOIN empleados as emp
                    ON emp.id = s.idempleado
                    INNER JOIN aeronaves as a
                    ON a.id = s.idaeronave
                    where e.id = {$db->escape($id)} order by s.creado desc");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}


function movimientos_by_equipo($idproducto)
{
  # code...
  global $db;
  $id = (int)$idproducto;
  $result = array();
  $sql = $db->query("SELECT i.idequipo, i.numeroserie, ic.movimiento, ic.cantidad,ic.fecha,ic.usuarioc FROM inventario as i INNER JOIN inventario_control as ic on i.id = ic.idinventario where i.idequipo = {$db->escape($id)} order by ic.fecha DESC");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}


/*function existencias()
{
  # code...
  global $db;
  //$id = (int)$idproducto;
  $result = array();
  $sql = $db->query("SELECT * FROM inventario LEFT JOIN existencias on inventario.id = existencias.idinventario");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}*/

function existencias()
{
  # code...
  global $db;
  //$id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT tipo, idequipo, descripcion, numeroparte, numeropartealterno, numeroserie, SUM(stock) as stock, ubicacion, ubicacionespecifica 
                      FROM inventario 
                      INNER JOIN equipos
                      on inventario.idequipo = equipos.id
                      INNER JOIN ubicaciones_generales
                      on inventario.idubicaciongeneral = ubicaciones_generales.id
                      INNER JOIN tipos_aeronaves
                      on equipos.idtipoaeronave = tipos_aeronaves.id
                      group by inventario.idequipo");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}

function suma_existencias_by_id($id){
  global $db;
  $id = (int)$id;
  $sql = $db->query("SELECT SUM(stock) as stock FROM inventario where idequipo = {$db->escape($id)} and idcondicion != 3");
      if($result = $db->fetch_assoc($sql))
        return $result;
}

function contrato_by_id($id){
  global $db;
  $id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT id,idempleado,tipocontrato,fechaingreso,fechasalida,estado,observaciones 
                     FROM empleados_contratos 
                     WHERE idempleado = {$db->escape($id)} 
                     ORDER BY fechaingreso DESC");
     while ($row =  $db->fetch_assoc($sql)) {
      $result[] = $row;
    }
    return $result;
}

function existencias_v2($id){
  global $db;
  $id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT idinventario, numeropartealterno, numeroserie, cantidad, creado, modificado, usuarioc, usuariom, SUM(cantidad) as cantidad 
                      FROM existencias where idinventario = {$db->escape($id)} group by numeroserie");
  /*if($result = $db->fetch_assoc($sql))
        return $result;*/

  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}

function existe_by_id($id){
  global $db;
  $id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT idinventario, idubicaciongeneral, ubicacionespecifica, numeroserie, numeropartealterno, SUM(cantidad) as cantidad FROM existencias where idinventario = {$db->escape($id)} group by numeroserie");
  /*if($result = $db->fetch_assoc($sql))
        return $result;*/

  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}

function vacaciones_by_id($id){
  global $db;
  $id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT * FROM vacaciones where idempleado = {$db->escape($id)} order by fechainicio desc");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}

function img_productos_by_id($id){
  global $db;
  $id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT * FROM equipos_imagen where idinventario = {$db->escape($id)}");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}

function field_by_id($tabla, $campo, $id){
  global $db;
  $id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT * FROM {$db->escape($tabla)} where {$db->escape($campo)} = {$db->escape($id)} order by creado desc");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}


function valor_inventario(){
  global $db;
  $result = array();
  $sql = $db->query("SELECT i.stock, ic.costo, ic.idmoneda FROM inventario as i inner join inventario_costo as ic on i.id = ic.idinventario");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  //return $result;
  $dolar = 0;
  $lempiras = 0;
  foreach ($result as $r){
    # code...
    $precio = (float)$r['costo'];
    $cantidad = (float)$r['stock'];

    if($r['idmoneda'] == '2'){
      $dolar += $precio * $cantidad;
    }else{
      $lempiras += $precio * $cantidad;
    }
    
    //echo "Hola";
  }
  $valores = array();
  $valores[] = $dolar;
  $valores[] = $lempiras;

  return $valores; 

  //var_dump($result);
}

function herramientas_calibracion(){
  global $db;
  $result = array();
  $sql = $db->query("SELECT inventario.id, inventario.descripcion, inventario.numeroparte, inventario.numeropartealterno, inventario.idtipoaeronave FROM inventario 
                     INNER JOIN categorias_equipos ON categorias_equipos.id = inventario.idcategoria 
                     WHERE categorias_equipos.categoria = 'Herramientas de Calibracion'");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}

function aceites(){
  global $db;
  $result = array();
  $sql = $db->query("SELECT e.id, a.matricula, e.descripcion, e.numeroparte, e.numeropartealterno FROM equipos as e 
   INNER JOIN categorias_equipos ON categorias_equipos.id = e.idcategoria 
   iNNER JOIN aeronaves as a ON a.idtipoaeronave = e.idtipoaeronave
   WHERE categorias_equipos.categoria = 'Aceite';");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}

function llantas(){
  global $db;
  $result = array();
  $sql = $db->query("SELECT inventario.id, inventario.idtipoaeronave, inventario.descripcion, inventario.numeroparte, inventario.numeropartealterno FROM inventario 
                     INNER JOIN categorias_equipos ON categorias_equipos.id = inventario.idcategoria 
                     WHERE categorias_equipos.categoria = 'Llantas'");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}

function extintor(){
  global $db;
  $result = array();
  $sql = $db->query("SELECT inventario.id, inventario.idtipoaeronave, inventario.descripcion, inventario.numeroparte, inventario.numeropartealterno FROM inventario 
                     INNER JOIN categorias_equipos ON categorias_equipos.id = inventario.idcategoria 
                     WHERE categorias_equipos.categoria = 'Extintores'");
  while ($row =  $db->fetch_assoc($sql)) {
    $result[] = $row;
  }
  return $result;
}
 

function alertas_stock(){
  global $db;
  $result = array();
  $sql = $db->query("SELECT i.idequipo, e.descripcion, e.numeroparte, i.stock, e.stockminimo, e.stockmaximo FROM inventario as i inner join equipos as e 
    ON i.idequipo = e.id where i.stock <= e.stockminimo LIMIT 6");
  while ($row =  $db->fetch_assoc($sql)) {
    # code...
    $result[] = $row;
  }
  return $result;
}

function ultimas_entradas(){
  global $db;
  $result = array();
  $sql = $db->query("SELECT * FROM entradas order by creado desc LIMIT 3");
  while ($row =  $db->fetch_assoc($sql)) {
    # code...
    $result[] = $row;
  }
  return $result;
    /*if($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;*/
}

function proxima_calibracion(){
  global $db;
  $result = array();
  $sql = $db->query("SELECT * FROM detalle_hcalibracion order by proxima_calibracion asc LIMIT 3");
  while ($row =  $db->fetch_assoc($sql)) {
    # code...
    $result[] = $row;
  }
  return $result;
}

function empleados_without_user(){
  global $db;
  //$id = (int)$id;
  $result = array();
  $sql = $db->query("SELECT e.id, e.nombre, e.apellido, e.estado FROM empleados as e left join usuarios as u on e.id = u.idempleado where e.estado = 1 and u.id IS NULL ORDER BY id DESC limit 10");
  while ($row =  $db->fetch_assoc($sql)) {
    # code...
    $result[] = $row;
  }
  return $result;
}

function count_by_column($table, $column){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT SUM({$db->escape($column)}) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}

function last_id($table){
  global $db;
  //$id = (int)$id;
    if(tableExists($table)){
      $sql = $db->query("SELECT MAX(id) as id FROM {$db->escape($table)}");
      if($result = $db->fetch_assoc($sql))
        return $result;
     }
}

function update_inventario($idproducto, $stock){
  global $db;
  $stockup = (int)$stock;
  //$date = make_date();
  $sql = "UPDATE inventario SET stock=stock+'{$stockup}' WHERE id ='{$idproducto}' LIMIT 1";
  $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
}

function update_salida_inventario($idinventario, $stock){
  global $db;
  $stockdown = (int)$stock;
  //$date = make_date();
  $sql = "UPDATE inventario SET stock=stock-'{$stockdown}' WHERE id ='{$idinventario}' LIMIT 1";
  $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
}

function update_estado($tabla, $id, $estado, $modificado, $usuariom){
  global $db;
  $id = (int)$id;
  //$date = make_date();
  $sql = "UPDATE {$tabla} SET estado='{$estado}', modificado='{$modificado}', usuariom='{$usuariom}' WHERE id ='{$id}' LIMIT 1";
  //var_dump($sql);
  $result = $db->query($sql);
  //redirect('?modulo=create_ciudad',false);
  return ($result && $db->affected_rows() === 1 ? true : false);

 }

function update_field($tabla, $campo, $valor, $campoid, $id){
  global $db;
  $id = (int)$id;
  $modificado=make_date();

  //$date = make_date();
  $sql = "UPDATE {$tabla} SET {$campo}='{$valor}', modificado='{$modificado}', usuariom='{$_SESSION['user_id']}' WHERE {$campoid}='{$id}' LIMIT 1";
  $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
}

/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}

function find_by_sql_v2($sql){
  global $db;
  $result = array();
  $sql = $db->query($sql);
  while ($row =  $db->fetch_assoc($sql)) {
    # code...
    $result[] = $row;
  }
  return $result;
}

function find_by_ajax($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
  return json_encode(['data' => $result_set]);
 //return $result_set;
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
      $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}'");
      if($result = $db->fetch_assoc($sql))
        return $result;
      else
        return null;
     }
}

function find_by_field($table, $field, $id)
{
  global $db;
  //$id = $id;
    if(tableExists($table)){
      $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE {$db->escape($field)}='{$db->escape($id)}'");
      if($result = $db->fetch_assoc($sql))
        return $result;
      else
        return null;
     }
}

function find_field_by_id($table, $tablacampo, $field, $id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
      $sql = $db->query("SELECT {$tablacampo} FROM {$db->escape($table)} WHERE {$db->escape($field)}='{$db->escape($id)}'");
      if($result = $db->fetch_assoc($sql))
        return $result[1];
      else
        return null;
     }
}

/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}

function count_by_state($table, $state){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM {$db->escape($table)} where estado = {$db->escape($state)}";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }

function reg_existe($tabla, $campo, $valor){
  global $db;
  $sql = $db->query("SELECT EXISTS (SELECT * FROM {$db->escape($tabla)} WHERE {$db->escape($campo)} = '{$db->escape($valor)}') as existe");
    if($result = $db->fetch_assoc($sql))
      return $result['existe'];
}

function solicitudes_bitacora($idsolicitud, $item, $accion, $fecha, $usuario){
  global $db;
  $sql = "INSERT INTO solicitudes_bitacora (idsolicitud, item, accion, creado, usuarioc)";
  $sql.= "VALUES ('{$idsolicitud}', '{$item}', '{$accion}','{$fecha}','{$usuario}')";

    if($db->query($sql)) {
      return true;
    }else{
      return false;
    }
  }

 /*--------------------------------------------------------------*/
 /* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
  function authenticate($usuario='', $contrasena='') {
    global $db;
    $usuario = $db->escape($usuario);
    $contrasena = $db->escape($contrasena);

    $sql  = sprintf("SELECT id,usuario,contrasena,id_rol,id_empleado FROM usuarios WHERE usuario ='%s' and estado ='1'", $usuario);
    $result = $db->query($sql);

    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      //$password_request = ($contrasena);
      if($contrasena == $user['contrasena'] ){ //cambiar $contrasena por $password_request
        return $user['id'];
      }
    }
   return false;
  }
  /*--------------------------------------------------------------*/
  /* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
   function authenticate_v2($username='', $password='') {
     global $db;
     $username = $db->escape($username);
     $password = $db->escape($password);
     $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
     $result = $db->query($sql);
     if($db->num_rows($result)){
       $user = $db->fetch_assoc($result);
       $password_request = sha1($password);
       if($password_request === $user['password'] ){
         return $user;
       }
     }
    return false;
   }


  /*--------------------------------------------------------------*/
  /* Find current log in user by session id
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['user_id'])):
             $user_id = intval($_SESSION['user_id']);
             $current_user = find_by_id('usuarios',$user_id);
        endif;
      }
    return $current_user;
  } 
  /*--------------------------------------------------------------*/
  /* Find all user by
  /* Joining users table and user gropus table
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
      $sql .="g.group_name ";
      $sql .="FROM users u ";
      $sql .="LEFT JOIN user_groups g ";
      $sql .="ON g.group_level=u.user_level ORDER BY u.name ASC";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* Function to update the last log in of a user
  /*--------------------------------------------------------------*/

 function updateLastLogIn($user_id)
	{ 
		global $db;
    $date = make_date();
    $sql = "UPDATE usuarios SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
	}



  /*--------------------------------------------------------------*/
  /* Find all Group name
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Find group level
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Function for cheaking which user level has access to page
  /*--------------------------------------------------------------*/
   function page_require_level($require_level){
     global $session;
     $current_user = current_user();
     $login_level = find_by_groupLevel($current_user['user_level']);
     //if user not login
     if (!$session->isUserLoggedIn(true)):
            $session->msg('d','Por favor Iniciar sesión...');
            redirect('index.php', false);
      //if Group status Deactive
     elseif($login_level['group_status'] === '0'):
           $session->msg('d','Este nivel de usaurio esta inactivo!');
           redirect('home.php',false);
      //cheackin log in User level and Require level is Less than or equal to
     elseif($current_user['user_level'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "¡Lo siento!  no tienes permiso para ver la página.");
            redirect('home.php', false);
        endif;

     }
   /*--------------------------------------------------------------*/
   /* Function for Finding all product name
   /* JOIN with categorie  and media database table
   /*--------------------------------------------------------------*/
  function join_product_table(){
     global $db;
     $sql  =" SELECT p.id,p.name,p.quantity,p.buy_price,p.sale_price,p.media_id,p.date,c.name";
    $sql  .=" AS categorie,m.file_name AS image";
    $sql  .=" FROM products p";
    $sql  .=" LEFT JOIN categories c ON c.id = p.categorie_id";
    $sql  .=" LEFT JOIN media m ON m.id = p.media_id";
    $sql  .=" ORDER BY p.id ASC";
    return find_by_sql($sql);

   }
  /*--------------------------------------------------------------*/
  /* Function for Finding all product name
  /* Request coming from ajax.php for auto suggest
  /*--------------------------------------------------------------*/

   function find_product_by_title($product_name){
     global $db;
     $p_name = remove_junk($db->escape($product_name));
     $sql = "SELECT name FROM products WHERE name like '%$p_name%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }

  /*--------------------------------------------------------------*/
  /* Function for Finding all product info by product title
  /* Request coming from ajax.php
  /*--------------------------------------------------------------*/
  function find_all_product_info_by_title($title){
    global $db;
    $sql  = "SELECT * FROM equipos ";
    $sql .= " WHERE descripcion ='{$title}'";
    $sql .=" LIMIT 1";
    return find_by_sql($sql);
  }



  /*--------------------------------------------------------------*/
  /* Function for Update product quantity
  /*--------------------------------------------------------------*/
  function update_product_qty($qty,$p_id){
    global $db;
    $qty = (int) $qty;
    $id  = (int)$p_id;
    $sql = "UPDATE products SET quantity=quantity -'{$qty}' WHERE id = '{$id}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);

  }

  function update_stock_plus($id, $cantidad){
    global $db;
    $cantidad = (int) $cantidad;
    $sql = "UPDATE inventario SET stock=stock +'{$cantidad}' WHERE id='{$id}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);
  }

  /*--------------------------------------------------------------*/
  /* Function for Display Recent product Added
  /*--------------------------------------------------------------*/
 function find_recent_product_added($limit){
   global $db;
   $sql   = " SELECT p.id,p.name,p.sale_price,p.media_id,c.name AS categorie,";
   $sql  .= "m.file_name AS image FROM products p";
   $sql  .= " LEFT JOIN categories c ON c.id = p.categorie_id";
   $sql  .= " LEFT JOIN media m ON m.id = p.media_id";
   $sql  .= " ORDER BY p.id DESC LIMIT ".$db->escape((int)$limit);
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Find Highest saleing Product
 /*--------------------------------------------------------------*/
 function find_higest_saleing_product($limit){
   global $db;
   $sql  = "SELECT p.name, COUNT(s.product_id) AS totalSold, SUM(s.qty) AS totalQty";
   $sql .= " FROM sales s";
   $sql .= " LEFT JOIN products p ON p.id = s.product_id ";
   $sql .= " GROUP BY s.product_id";
   $sql .= " ORDER BY SUM(s.qty) DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for find all sales
 /*--------------------------------------------------------------*/
 function find_all_sale(){
   global $db;
   $sql  = "SELECT s.id,s.qty,s.price,s.date,p.name";
   $sql .= " FROM sales s";
   $sql .= " LEFT JOIN products p ON s.product_id = p.id";
   $sql .= " ORDER BY s.date DESC";
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Display Recent sale
 /*--------------------------------------------------------------*/
function find_recent_sale_added($limit){
  global $db;
  $sql  = "SELECT s.id,s.qty,s.price,s.date,p.name";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " ORDER BY s.date DESC LIMIT ".$db->escape((int)$limit);
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate sales report by two dates
/*--------------------------------------------------------------*/
function find_sale_by_dates($start_date,$end_date){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));
  $sql  = "SELECT s.date, p.name,p.sale_price,p.buy_price,";
  $sql .= "COUNT(s.product_id) AS total_records,";
  $sql .= "SUM(s.qty) AS total_sales,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price,";
  $sql .= "SUM(p.buy_price * s.qty) AS total_buying_price ";
  $sql .= "FROM sales s ";
  $sql .= "LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE s.date BETWEEN '{$start_date}' AND '{$end_date}'";
  $sql .= " GROUP BY DATE(s.date),p.name";
  $sql .= " ORDER BY DATE(s.date) DESC";
  return $db->query($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Daily sales report
/*--------------------------------------------------------------*/
function  dailySales($year,$month){
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m' ) = '{$year}-{$month}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Monthly sales report
/*--------------------------------------------------------------*/
function  monthlySales($year){
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y' ) = '{$year}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%c' ),s.product_id";
  $sql .= " ORDER BY date_format(s.date, '%c' ) ASC";
  return find_by_sql($sql);
}

function llena_select($tabla, $nombreselect, $campo, $seleccionado=0, $orderby='id', $enabled='true', $required='true'){
  $registros = find_all_v2($tabla, $orderby);
?>
  <select class="form-control custom-select" name="<?php echo $nombreselect ?>" id="<?php echo $nombreselect; ?>" 
    <?php if ($required == 'true') { echo 'required'; } ?>
    <?php if ($enabled == 'false') { echo 'disabled'; } ?>
    style="height: 31px; padding-top: 4px; padding-bottom: 4px;">
    <option value="">Seleccionar...</option>
    <?php foreach ($registros as $registro): ?>
      <option value="<?php echo $registro['id']; ?>" <?php if($registro['id']==$seleccionado){echo "selected";}?>><?php echo $registro[$campo]; ?></option>
    <?php endforeach; ?>
  </select>

<?php }

function llena_select_sql($sql, $nombreselect, $campo1, $campo2, $seleccionado=0){
  $registros = find_by_sql($sql);
?>
  <select class="form-control custom-select" name="<?php echo $nombreselect ?>" id="<?php echo $nombreselect; ?>" required="true"
    style="height: 31px; padding-top: 4px; padding-bottom: 4px;">
    <option value="0">Seleccionar...</option>
    <?php foreach ($registros as $registro): ?>
      <option value="<?php echo $registro['id']; ?>" <?php if($registro['id']==$seleccionado){echo "selected";}?>><?php echo $registro[$campo1] . ' - #' . $registro[$campo2]; ?></option>
    <?php endforeach; ?>
  </select>

<?php }

function select_by_sql($sql, $nombreselect, $campo, $seleccionado=0){
  $registros = find_by_sql($sql);
?>
  <select class="form-control custom-select" name="<?php echo $nombreselect ?>" id="<?php echo $nombreselect; ?>" required="true"
    style="height: 31px; padding-top: 4px; padding-bottom: 4px;">
    <option value="0">Seleccionar...</option>
    <?php foreach ($registros as $registro): ?>
      <option value="<?php echo $registro['id']; ?>" <?php if($registro['id']==$seleccionado){echo "selected";}?>><?php echo $registro[$campo]; ?></option>
    <?php endforeach; ?>
  </select>

<?php }

function display_mssg($msg =''){
   $output = array();
   if(!empty($msg)) {
      foreach ($msg as $key => $value) {
         $output  = "<div class=\"alert alert-{$key} border-0 fade show\" id=\"mensaje\">";
         $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";

         if ($key == 'success') {
            # code...
            $output .= "<i class=\"fas fa-check\"></i><strong style=\"font-weight: bold;\">  Exito! </strong>";
         }else if ($key == 'danger') {
            $output .= "<i class=\"fas fa-times\"></i><strong style=\"font-weight: bold;\">  Error! </strong>";
         }

         $output .= first_character($value);
         $output .= "</div>";
      }
      return $output;
   } else {
     return "" ;
   }
}

function borra_solicitud_temporal($tabla, $id){
  global $db;
  $sql = "DELETE from {$tabla} where usuarioc='{$id}'";
  $db->query($sql);

}

function write_to_console($data) {
 $console = $data;
 if (is_array($console))
 $console = implode(',', $console);

 echo "<script>console.log('Console: " . $console . "' );</script>";
}

function ventasxdia($table){
  global $db;
  $hoy = date('Y-m-d');
  if(tableExists($table))
  {
    //$sql = "SELECT COUNT(id) AS cantidad, SUM(monto_pagado) FROM {$db->escape($table)} where usuarioc = '{$_SESSION['user_id']}' and CAST(creado as DATE) = '{$hoy}'" ;
    $sql = "SELECT SUM(cf.total) as totalventa
            FROM carga_encomienda as ce
            INNER JOIN carga_factura as cf ON ce.id = cf.id_encomienda
            where cf.usuarioc = '{$_SESSION['user_id']}' and CAST(cf.creado as DATE) = '{$hoy}' and cf.estado != 0 and cf.id_tipofactura = 1";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}

function ventasxmes($table){
  global $db;
  $hoy = getdate();
  $mes = (int)$hoy['mon'];
  if(tableExists($table))
  {
    //$sql = "SELECT COUNT(id) AS cantidad, SUM(monto_pagado) FROM {$db->escape($table)} where usuarioc = '{$_SESSION['user_id']}' and CAST(creado as DATE) = '{$hoy}'" ;
    $sql = "SELECT SUM(cf.total) as totalventa
            FROM carga_encomienda as ce
            INNER JOIN carga_factura as cf ON ce.id = cf.id_encomienda
            where cf.usuarioc = '{$_SESSION['user_id']}' and MONTH(cf.creado) = {$db->escape($mes)} and cf.estado != 0 and cf.id_tipofactura = 1";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}

function encomiendasxdia($table){
  global $db;
  $hoy = date('Y-m-d');
  if(tableExists($table))
  {
    //$sql = "SELECT COUNT(id) AS cantidad, SUM(monto_pagado) FROM {$db->escape($table)} where usuarioc = '{$_SESSION['user_id']}' and CAST(creado as DATE) = '{$hoy}'" ;
    $sql = "SELECT COUNT(id) AS cantidad
            FROM carga_encomienda as ce
            where usuarioc = '{$_SESSION['user_id']}' and CAST(creado as DATE) = '{$hoy}' and estado != 0";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}

function encomiendasxmes(){
  global $db;
  $hoy = getdate();  

  $mes = (int)$hoy['mon'];
  $sql = "SELECT COUNT(id) as cantidad FROM carga_encomienda where usuarioc = '{$_SESSION['user_id']}' and MONTH(creado) = {$db->escape($mes)} and estado != 0;";
  $result = $db->query($sql);
  return($db->fetch_assoc($result));
}


?>
