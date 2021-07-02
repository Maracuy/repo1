<?php
session_start();
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}
require_once '../../conection/conexion.php';

$beneficiario = array();

$beneficiario[0] = ($_POST['id_beneficiario'] == "") ? NULL : $_POST['id_beneficiario'];
$beneficiario[0] = ($beneficiario[0] != NULL) ? intval($beneficiario[0]) : NULL ;
$beneficiario[1] = (isset($_POST['fecha_captura'])) ? $_POST['fecha_captura'] : date('Y-m-d h:i:s');
$beneficiario[3] = $_POST['nombres'];
$beneficiario[4] = $_POST['apellido_p'];
$beneficiario[5] = $_POST['apellido_m'];
$beneficiario[2] = $beneficiario[3] . " " . $beneficiario[4] . " " . $beneficiario[5];

$beneficiario[6] = $_POST['vulnerable'];
$beneficiario[7] = $_POST['genero'];
$beneficiario[8] = $_POST['curp'];
$beneficiario[9] = $_POST['numero_identificacion'];
$beneficiario[10] = $_POST['telefono'];
$beneficiario[11] = $_POST['email'];
$beneficiario[12] = $_POST['whats'];

$beneficiario[13] = $_POST['fecha_nacimiento'];

$beneficiario[14] = $_POST['nivel'];

$beneficiario[15] = $_POST['estado_civil'];
$beneficiario[16] = $_POST['num_hijos'];
$beneficiario[17] = $_POST['ocupacion'];
$beneficiario[18] = $_POST['pensionado'];
$beneficiario[19] = $_POST['enfermedades_cron'];
$beneficiario[20] = $_POST['cp'];

$beneficiario[21] = $_POST['dir_calle'];
$beneficiario[22] = $_POST['dir_numero'];
$beneficiario[23] = $_POST['dir_numero_int'];
$beneficiario[24] = $_POST['id_colonia'];
$beneficiario[24] = intval($beneficiario[24]);

$beneficiario[25] = (isset($_POST['otra_colonia'])) ? $_POST['otra_colonia'] : NULL;
$beneficiario[26] = "Metepec";
$beneficiario[27] = $_POST['manzana'];
$beneficiario[28] = $_POST['lote'];
$beneficiario[29] = $_POST['dir_referencia'];

$beneficiario[30] = $_SESSION['user']['id_empleado'];
$beneficiario[30] = intval($beneficiario[30]);

$beneficiario[31] = $_POST['medio'];
$beneficiario[31] = intval($beneficiario[31]);

$beneficiario[32] = $_POST['origen'];
$beneficiario[32] = intval($beneficiario[32]);
$beneficiario[33] = $_POST['promueve'];
$beneficiario[33] = intval($beneficiario[33]);

$beneficiario[34] = $_POST['zona_electoral'];
$beneficiario[35] = $_POST['seccion_electoral'];
$beneficiario[36] = $_POST['participo_eleccion'];
$beneficiario[37] = $_POST['posicion'];
$beneficiario[38] = $_POST['asisitio'];
$beneficiario[39] = $_POST['afiliacion'];

$beneficiario[40] = $_POST['observaciones'];

$id_capturista = $beneficiario[30];





function alta_auxiliar($con){
    
    $empleado = $_SESSION['user']['id_empleado'];
    $sql_unico = $con->prepare('SELECT * FROM beneficiarios WHERE id_empleado = ? ORDER BY id_beneficiario DESC');
    $sql_unico->execute(array($empleado));
    $beneficiario = $sql_unico->fetch();


    $nombres_aux = $_POST['nombres_auxiliar'];
    $apellido_p_aux = $_POST['apellido_p_auxiliar'];
    $apellido_m_aux = $_POST['apellido_m_auxiliar'];
    $telefono_auxiliar = $_POST['telefono_auxiliar'];
    $parentesco = $_POST['parentesco'];
    $id_del_beneficiario = $beneficiario['id_beneficiario'];
    
    $sql_agregar_beneficiario = 'INSERT INTO auxiliares VALUES (NULL, ?, ?, ?, ?, ?, ?)';
    $sentencia_agregar_beneficiario = $con->prepare($sql_agregar_beneficiario);

    try{
        $sentencia_agregar_beneficiario->execute(array($nombres_aux, $apellido_p_aux, $apellido_m_aux, $telefono_auxiliar, $id_del_beneficiario, $parentesco));
    }catch(Exception $e){
        echo 'Error al crear el auxiliar ',  $e->getMessage(), "\n";
    }  
}



function altas($con, $id_beneficiario, $id_capturista){

    

    $sql_agregar = 'INSERT INTO altas VALUES (NULL, ?, NULL, NULL, NULL, NULL, 1, 1, NULL, ?, NULL)';
    $sentencia_agregar = $con->prepare($sql_agregar);
    
    try{  
        $sentencia_agregar->execute(array($id_beneficiario, $id_capturista));
        return 0;
    }catch(Exception $e){
        echo 'Error en el alta: ',  $e->getMessage(), "\n";
        die();
    }  

}



function alta_beneficiario($con, $beneficiario){
 
    $sql_agregar = 'INSERT INTO beneficiarios VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $sentencia_agregar = $con->prepare($sql_agregar);    
    
    try{
        $sentencia_agregar->execute($beneficiario);
        $sentencia_alta = $con->prepare('SELECT LAST_INSERT_ID()');
        $sentencia_alta->execute();
        $last_id_beneficiario = $sentencia_alta->fetch();
        $id_beneficiario = intval($last_id_beneficiario[0]);
        return $id_beneficiario;
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }  

}


function actualizar($con, $beneficiario){

    $id = $beneficiario[0];
    $beneficiario = array_slice($beneficiario, 2);
    $sql_editar = "UPDATE beneficiarios SET nombres=?, apellido_p=?, apellido_m=?, nombre_c=?, vulnerable=?, genero=?, curp=?, numero_identificacion=?, telefono=?, email=?, whats=?, fecha_nacimiento=?, nivel=?, estado_civil=?, num_hijos=?, ocupacion=?, pensionado=?, enfermedades_cron=?, cp=?, dir_calle=?, dir_numero=?, dir_numero_int=?, id_colonia=?, otra_colonia=?, municipio=?, manzana=?, lote=?, dir_referencia=?, id_empleado=?, id_medio_contacto=?, id_origenes=?, id_promotores=?, zona_electoral=?, seccion_electoral=?, participo_eleccion=?, posicion=?, asisitio=?, afiliacion=?, observaciones=? WHERE id_beneficiario=$id";
    $sentencia_agregar = $con->prepare($sql_editar);
       
    try{
        $sentencia_agregar->execute($beneficiario);
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }  
}




if(array_key_exists("guardar_salir",$_POST)){
    $id_beneficiario = alta_beneficiario($con, $beneficiario);
    altas($con, $id_beneficiario, $id_capturista);

    if(($_POST['nombres_auxiliar'] !="")){
        alta_auxiliar($con);
    }
    header("Location: ../beneficiarios.php");
}

if(array_key_exists("continuar",$_POST)){
    actualizar($con, $beneficiario);
    header("Location: ../beneficiarios");
}

if(array_key_exists("inscribir",$_POST)){
    $id_beneficiario = alta_beneficiario($con, $beneficiario);
    altas($con, $id_beneficiario, $id_capturista);
    if(($_POST['nombres_auxiliar'] !="")){
        alta_auxiliar($con);
    }
    header("Location: ../programas.php?id=$id_beneficiario");
}
 
?>