<?php
session_start();
if(!$_POST){
    die();
}
if(!$_SESSION){
    die();
}
require_once '../../conection/conexion.php';

$id_ciudadano = $_POST['id_ciudadano'];

function BorrarDefensa($con, $id_ciudadano){
    $stm = $con->query("SELECT id_defensa FROM puestos_defensa WHERE id_ciudadano = $id_ciudadano");
    $puesto_defensa = $stm->fetch();

    if($puesto_defensa){
        $puesto_defensa = intval($puesto_defensa['id_defensa']);
    }
    if(!$puesto_defensa){
        return 0;
    }else{
        $campos = "UPDATE 
        puestos_defensa SET
        id_ciudadano = NULL, 
        previo = NULL, 
        posicion_prev = NULL, 
        asistio = NULL, 
        compromiso = NULL, 
        afiliacion = NULL, 
        origen = NULL, 
        cubre = NULL, 
        up = NULL, 
        inamovible = NULL, 
        morena = NULL, 
        ine = NULL, 
        pago = NULL, 
        confirmacion = NULL 
        WHERE id_ciudadano = $id_ciudadano";
        $nrows = $con->exec($campos);
        return 1;
    }
}

function BorrarCapacitaciones($con, $id_ciudadano){
    $nrows = $con->exec("DELETE FROM capacitaciones_defensa WHERE id_ciudadano = $id_ciudadano");
    return 1;
    return 0;
}

function BorrarCiudadano($con, $id_ciudadano){
    if($id_ciudadano < 3){
        return 0;
    }
    $nrows = $con->exec("DELETE FROM ciudadanos WHERE id_ciudadano = $id_ciudadano");    
}

if(array_key_exists("borrar",$_POST)){
    BorrarDefensa($con, $id_ciudadano);
    BorrarCapacitaciones($con, $id_ciudadano);
    BorrarCiudadano($con, $id_ciudadano);
    header("Location: ../ciudadanos.php");
} 
?>