<?php

class  Media {

  public $imageInfo;
  public $fileName;
  public $fileType;
  public $fileTempPath;
  //Set destination for upload
  public $userPath = SITE_ROOT.DS.'..'.DS.'media/usuarios';
  public $productPath = SITE_ROOT.DS.'..'.DS.'equipo/media';
  public $proveedorPath = SITE_ROOT.DS.'..'.DS.'media/proveedores';
  public $empleadoPath = SITE_ROOT.DS.'..'.DS.'media/empleados';
  public $vehiculosPath = SITE_ROOT.DS.'..'.DS.'contabilidad/media/vehiculos';
  public $solicitudesPath = SITE_ROOT.DS.'..'.DS.'mantenimiento/media/docs';
  public $empleadosDocPath = SITE_ROOT.DS.'..'.DS.'empleados/docs';


  public $errors = array();
  public $upload_errors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'Ningun archivo fue subido',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.'
  );
  public$upload_extensions = array(
   'gif',
   'jpg',
   'jpeg',
   'png',
   'pdf'
  );
  public function file_ext($filename){
     $ext = strtolower(substr( $filename, strrpos( $filename, '.' ) + 1 ) );
     if(in_array($ext, $this->upload_extensions)){
       return true;
     }
   }

  public function upload($file)
  {
    if(!$file || empty($file) || !is_array($file)):
      $this->errors[] = "Ningún archivo subido.";
      return false;
    elseif($file['error'] != 0):
      $this->errors[] = $this->upload_errors[$file['error']];
      return false;
    elseif(!$this->file_ext($file['name'])):
      $this->errors[] = 'Formato de archivo incorrecto ';
      return false;
    else:
      $this->imageInfo = getimagesize($file['tmp_name']);
      $this->fileName  = basename($file['name']);
      $this->fileType  = $this->imageInfo['mime'];
      $this->fileTempPath = $file['tmp_name'];
     return true;
    endif;

  }

 public function process(){

    if(!empty($this->errors)):
      return false;
    elseif(empty($this->fileName) || empty($this->fileTempPath)):
      $this->errors[] = "La ubicación del archivo no esta disponible.";
      return false;
    elseif(!is_writable($this->productPath)):
      $this->errors[] = $this->productPath." Debe tener permisos de escritura!!!.";
      return false;
    elseif(file_exists($this->productPath."/".$this->fileName)):
      $this->errors[] = "El archivo {$this->fileName} realmente existe.";
      return false;
    else:
     return true;
    endif;
 }
 /*--------------------------------------------------------------*/
 /* Function for Process media file
 /*--------------------------------------------------------------*/
public function process_media($idinventario, $creado, $usuarioc){
    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "La ubicación del archivo no se encuenta disponible.";
        return false;
      }

    if(!is_writable($this->productPath)){
        $this->errors[] = $this->productPath." Debe tener permisos de escritura!!!.";
        return false;
      }

    if(file_exists($this->productPath."/".$this->fileName)){
      $this->errors[] = "El archivo con nombre {$this->fileName} ya existe.";
      return false;
    }
    
    $ext = explode(".",$this->fileName);
    $new_name = randString(8).$idinventario.'.' . end($ext);
    $this->fileName = $new_name;
    if(move_uploaded_file($this->fileTempPath,$this->productPath.'/'.$this->fileName))
    {

      if($this->insert_media($idinventario, $creado, $usuarioc)){
        unset($this->fileTempPath);
        return true;
      }
    } else {
      $this->errors[] = "Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
      return false;
    }
  }
  /*--------------------------------------------------------------*/
  /* Function for Process user image
  /*--------------------------------------------------------------*/

public function process_user($id){

    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "La ubicación del archivo no estaba disponible.";
        return false;
      }
    if(!is_writable($this->userPath)){
        $this->errors[] = $this->userPath." Debe tener permisos de escritura";
        return false;
      }
    if(!$id){
      $this->errors[] = " ID de usuario ausente.";
      return false;
    }
    $ext = explode(".",$this->fileName);
    $new_name = randString(8).$id.'.' . end($ext);
    $this->fileName = $new_name;
    if($this->user_image_destroy($id))
    {
    if(move_uploaded_file($this->fileTempPath,$this->userPath.'/'.$this->fileName))
       {

         if($this->update_userImg($id)){
           unset($this->fileTempPath);
           return true;
         }

       } else {
         $this->errors[] = "Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
         return false;
       }
    }
 }

   /*--------------------------------------------------------------*/
  /* Function for Process Proveedores
  /*--------------------------------------------------------------*/

public function process_proveedor($id){

    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "La ubicación del archivo no estaba disponible.";
        return false;
      }
    if(!is_writable($this->proveedorPath)){
        $this->errors[] = $this->proveedorPath." Debe tener permisos de escritura";
        return false;
      }
    if(!$id){
      $this->errors[] = " ID de usuario ausente.";
      return false;
    }
    $ext = explode(".",$this->fileName);
    $new_name = randString(8).$id.'.' . end($ext);
    $this->fileName = $new_name;
    if($this->user_image_destroy($id))
    {
    if(move_uploaded_file($this->fileTempPath,$this->proveedorPath.'/'.$this->fileName))
       {

         if($this->update_proveedorImg($id)){
           unset($this->fileTempPath);
           return true;
         }

       } else {
         $this->errors[] = "Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
         return false;
       }
    }
 }

public function process_document($numerosolicitud, $numprorateo, $descripcion){

    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "La ubicación del archivo no estaba disponible.";
        return false;
      }
    if(!is_writable($this->solicitudesPath)){
        $this->errors[] = $this->solicitudesPath." Debe tener permisos de escritura";
        return false;
      }
    if(!$numerosolicitud){
      $this->errors[] = " ID de usuario ausente.";
      return false;
    }
    $ext = explode(".",$this->fileName);
    $new_name = randString(8).$numerosolicitud.'.' . end($ext);
    $this->fileName = 'S' . $numerosolicitud . '-P' . $numprorateo . '-' . $new_name;
    if($this->user_image_destroy($numerosolicitud))
    {
    if(move_uploaded_file($this->fileTempPath,$this->solicitudesPath.'/'.$this->fileName))
       {

         if($this->update_document($numerosolicitud, $numprorateo, $descripcion)){
           unset($this->fileTempPath);
           return true;
         }
       } else {
         $this->errors[] = "Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
         return false;
       }
    }
 }

public function empleadosDocumentos($idempleado, $titulo){

    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "La ubicación del archivo no estaba disponible.";
        return false;
      }
    if(!is_writable($this->empleadosDocPath)){
        $this->errors[] = $this->empleadosDocPath." Debe tener permisos de escritura";
        return false;
      }
    if(!$idempleado){
      $this->errors[] = " ID de usuario ausente.";
      return false;
    }
    $ext = explode(".",$this->fileName);
    $new_name = randString(8).$idempleado.'.' . end($ext);
    $this->fileName = 'ID' . $idempleado . '-' . $new_name;
    if($this->user_image_destroy($idempleado))
    {
    if(move_uploaded_file($this->fileTempPath,$this->empleadosDocPath.'/'.$this->fileName))
       {

         if($this->guardarDocumentoEmpleado($idempleado, $titulo)){
           unset($this->fileTempPath);
           return true;
         }
       } else {
         $this->errors[] = "Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
         return false;
       }
    }
 }

public function process_empleado($id){

    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "La ubicación del archivo no estaba disponible.";
        return false;
      }
    if(!is_writable($this->empleadoPath)){
        $this->errors[] = $this->empleadoPath." Debe tener permisos de escritura";
        return false;
      }
    if(!$id){
      $this->errors[] = " ID de usuario ausente.";
      return false;
    }
    $ext = explode(".",$this->fileName);
    $new_name = randString(8).$id.'.' . end($ext);
    $this->fileName = $new_name;
    if($this->user_image_destroy($id))
    {
    if(move_uploaded_file($this->fileTempPath,$this->empleadoPath.'/'.$this->fileName))
       {

         if($this->update_empleadoImg($id)){
           unset($this->fileTempPath);
           return true;
         }

       } else {
         $this->errors[] = "Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
         return false;
       }
    }
 }

public function process_vehiculo($id, $creado, $modificado){

    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "La ubicación del archivo no estaba disponible.";
        return false;
      }
    if(!is_writable($this->vehiculosPath)){
        $this->errors[] = $this->vehiculosPath." Debe tener permisos de escritura";
        return false;
      }
    if(!$id){
      $this->errors[] = " ID de usuario ausente.";
      return false;
    }
    $ext = explode(".",$this->fileName);
    $new_name = randString(8).$id.'.' . end($ext);
    $this->fileName = $new_name;
    if($this->user_image_destroy($id))
    {
    if(move_uploaded_file($this->fileTempPath,$this->vehiculosPath.'/'.$this->fileName))
       {

         if($this->insert_vehiculo_media($id,$creado,$modificado)){
           unset($this->fileTempPath);
           return true;
         }

       } else {
         $this->errors[] = "Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
         return false;
       }
    }
 }

 /*--------------------------------------------------------------*/
 /* Function for Update user image
 /*--------------------------------------------------------------*/
  private function update_userImg($id){
     global $db;
      $sql = "UPDATE usuarios SET";
      $sql .=" imagen='{$db->escape($this->fileName)}'";
      $sql .=" WHERE id='{$db->escape($id)}'";
      $result = $db->query($sql);
      return ($result && $db->affected_rows() === 1 ? true : false);

   }

  /*--------------------------------------------------------------*/
 /* Function for Update user image
 /*--------------------------------------------------------------*/
  private function update_proveedorImg($id){
     global $db;
      $sql = "UPDATE proveedores SET";
      $sql .=" imagen='{$db->escape($this->fileName)}'";
      $sql .=" WHERE id='{$db->escape($id)}'";
      $result = $db->query($sql);
      return ($result && $db->affected_rows() === 1 ? true : false);

   }

  /*--------------------------------------------------------------*/
  /* Function for Update user image
  /*--------------------------------------------------------------*/
  private function update_empleadoImg($id){
     global $db;
      $sql = "UPDATE empleados SET";
      $sql .=" imagen='{$db->escape($this->fileName)}'";
      $sql .=" WHERE id='{$db->escape($id)}'";
      $result = $db->query($sql);
      return ($result && $db->affected_rows() === 1 ? true : false);

   }

private function update_document($numerosolicitud, $numprorateo, $descripcion){
     global $db;
     $var_creado = make_date();
      $sql = "INSERT INTO prorateo_documento (idprorateo, idsolicitud, descripcion, nombre_archivo, creado, usuarioc)";
      $sql .="VALUES('{$db->escape($numprorateo)}', '{$db->escape($numerosolicitud)}', '{$db->escape($descripcion)}', '{$db->escape($this->fileName)}', '{$var_creado}', '{$_SESSION['user_id']}')";
      $result = $db->query($sql);
      return ($result && $db->affected_rows() === 1 ? true : false);

   }

   private function guardarDocumentoEmpleado($idempleado, $titulo){
     global $db;
     $var_creado = make_date();
      $sql = "INSERT INTO empleados_documentos (idempleado, titulo, documento, creado, usuarioc)";
      $sql .="VALUES('{$db->escape($idempleado)}', '{$db->escape($titulo)}','{$db->escape($this->fileName)}', '{$var_creado}', '{$_SESSION['user_id']}')";
      $result = $db->query($sql);
      return ($result && $db->affected_rows() === 1 ? true : false);
   }


 /*--------------------------------------------------------------*/
 /* Function for Delete old image
 /*--------------------------------------------------------------*/
  public function user_image_destroy($id){
     $image = find_by_id('users',$id);
     if($image['image'] === 'no_image.jpg')
     {
       return true;
     } else {
       unlink($this->userPath.'/'.$image['image']);
       return true;
     }

   }

/*--------------------------------------------------------------*/
/* Function for insert media image
/*--------------------------------------------------------------*/
  private function insert_media($idinventario, $creado, $usuarioc){

         global $db;
         $sql  = "INSERT INTO equipos_imagen (idinventario, imagen, creado, usuarioc)";
         $sql .=" VALUES ";
         $sql .="('{$db->escape($idinventario)}','{$db->escape($this->fileName)}','{$db->escape($creado)}','{$db->escape($usuarioc)}')";
       return ($db->query($sql) ? true : false);

  }

  /*--------------------------------------------------------------*/
/* Function for insert media image
/*--------------------------------------------------------------*/
  private function insert_vehiculo_media($idvehiculo, $creado, $usuarioc){

         global $db;
         $sql  = "INSERT INTO vehiculos_img (idvehiculo, imagen, creado, usuarioc)";
         $sql .=" VALUES ";
         $sql .="('{$db->escape($idvehiculo)}','{$db->escape($this->fileName)}','{$db->escape($creado)}','{$db->escape($usuarioc)}')";
       return ($db->query($sql) ? true : false);

  }

/*--------------------------------------------------------------*/
/* Function for Delete media by id
/*--------------------------------------------------------------*/
public function media_destroy($id,$file_name){
     $this->fileName = $file_name;
     if(empty($this->fileName)){
         $this->errors[] = "Falta el archivo de foto.";
         return false;
       }
     if(!$id){
       $this->errors[] = "ID de foto ausente.";
       return false;
     }
     if(delete_by_id('media',$id)){
         unlink($this->productPath.'/'.$this->fileName);
         return true;
     } else {
       $this->error[] = "Se ha producido un error en la eliminación de fotografías.";
       return false;
     }
   }
}
?>