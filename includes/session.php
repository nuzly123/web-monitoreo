<?php

ini_set('session.cookie_lifetime',0);
ini_set('session.gc_maxlifetime',28800);
ini_set('session.cache_expire',720);

session_start();

class Session {

 public $msg;
 private $user_is_logged_in = false;

 function __construct(){
   $this->flash_msg();
   $this->userLoginSetup();
 }

  public function isUserLoggedIn(){ 
    return $this->user_is_logged_in;
  }
 
  public function login($user_id){
    $_SESSION['user_id'] = $user_id;
    $usuario          = current_user();
    //var_dump($usuario);
    $empleado         = find_by_id('empleados',$usuario['idempleado']);
    

    //DATOS DE USUARIO
    $_SESSION['usuario']        = $usuario['usuario'];
    $_SESSION['estadousuario']  = $usuario['estado'];
    $_SESSION['rol']            = $usuario['id_rol'];
    //$_SESSION['imagen']         = $usuario['imagen'];
    //$_SESSION['id_oficina']     = $usuario['id_oficina'];
    //$oficina = find_by_field('empresa_oficinas','id',$usuario['id_oficina']);
    //$_SESSION['id_ciudad_oficina'] = $oficina['id_ciudad'];


    //DATOS DE EMPLEADO
    $_SESSION['idempleado']     = $usuario['idempleado'];
    $_SESSION['identidad']      = $empleado['identidad'];
    $_SESSION['nombreempleado'] = $empleado['nombre'];
    $_SESSION['telefono']       = $empleado['telefono'];
    $_SESSION['iddepartamento'] = $empleado['iddepartamento'];
    $_SESSION['cargo']          = $empleado['cargo'];
    $_SESSION['idciudad']       = $empleado['idciudad'];
    $_SESSION['idestacion']     = $empleado['idestacion'];
    $_SESSION['estado']         = $empleado['estado'];
    
    /*
    $empresa = find_by_id('empresa',1);
    $_SESSION['url_carga']     = $empresa['url_carga'];


    /*PERMISOS
    $permisos = find_by_field('roles_modulos', 'idrol', $usuario['idrol']);
    $_SESSION['almacen']        = $permisos['almacen'];
    $_SESSION['carga']          = $permisos['carga'];
    $_SESSION['contabilidad']   = $permisos['contabilidad'];
    $_SESSION['configuracion']  = $permisos['configuracion'];
    $_SESSION['mantenimiento']  = $permisos['mantenimiento'];
    $_SESSION['rhumano']        = $permisos['rhumano'];
    $_SESSION['operaciones']    = $permisos['operaciones'];
    $_SESSION['pubtec']         = $permisos['pubtec'];

    */
    
     
    
    
    /*

    //if ($permisos['almacen'] == 1) {
      // code...
      $permisos_almacen       = find_by_field('permisos_almacen', 'id_usuario', $usuario['id']);
      $_SESSION['permisos_almacen'] = $permisos_almacen;
    //}

    //if ($permisos['carga'] == 1) {
      // code...
      $permisos_carga         = find_by_field('permisos_carga', 'id_usuario', $usuario['id']);
      $_SESSION['permisos_carga'] = $permisos_carga;
    //}

    //if ($permisos['contabilidad'] == 1) {
      // code...
      $permisos_contabilidad  = find_by_field('permisos_contabilidad', 'id_usuario', $usuario['id']);
      $_SESSION['permisos_contabilidad']  = $permisos_contabilidad;
    //}

    //if ($permisos['configuracion'] == 1) {
      // code...
      $permisos_configuracion = find_by_field('permisos_configuracion', 'id_usuario', $usuario['id']);
      $_SESSION['permisos_configuracion'] = $permisos_configuracion;
    //}

    //if ($permisos['mantenimiento'] == 1) {
      // code...
      $permisos_mantenimiento = find_by_field('permisos_mantenimiento', 'id_usuario', $usuario['id']);
      $_SESSION['permisos_mantenimiento'] = $permisos_mantenimiento;
    //}

    //if ($permisos['rhumano'] == 1) {
      // code...
      $permisos_rrhh          = find_by_field('permisos_rrhh', 'id_usuario', $usuario['id']);
      $_SESSION['permisos_rrhh']          = $permisos_rrhh;
    //}

    //if ($permisos['operaciones'] == 1) {
      // code...
      $permisos_operaciones   = find_by_field('permisos_operaciones', 'id_usuario', $usuario['id']);
      $_SESSION['permisos_operaciones']   = $permisos_operaciones;
    //}

    //if ($permisos['pubtec'] == 1) {
      // code...
      $permisos_pubtec   = find_by_field('permisos_pubtec', 'id_usuario', $usuario['id']);
      $_SESSION['permisos_pubtec']   = $permisos_pubtec;
    //}
    */
    
    
    
    
    
    
  }
 
  private function userLoginSetup()
  {
    if(isset($_SESSION['user_id']))
    {
      $this->user_is_logged_in = true;
    } else {
      $this->user_is_logged_in = false;
    }

  }
  public function logout(){
    unset($_SESSION['user_id']);
    session_destroy();
  }

  public function msg($type ='', $msg =''){
    if(!empty($msg)){
       if(strlen(trim($type)) == 1){
         $type = str_replace( array('d', 'i', 'w','s'), array('danger', 'info', 'warning','success'), $type );
       }
       $_SESSION['msg'][$type] = $msg;
    } else {
      return $this->msg;
    }
  }

  private function flash_msg(){
    if(isset($_SESSION['msg'])) {
      $this->msg = $_SESSION['msg'];
      unset($_SESSION['msg']);
    } else {
      $this->msg;
    }
  }
} 
$session = new Session();
$msg = $session->msg();
?>