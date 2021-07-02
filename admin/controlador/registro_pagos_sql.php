<?php
session_start();
require_once '../../conection/conexion.php';

if(!$_POST){
    die();
}


if($_POST){
    $id_beneficiario = $_POST['id_beneficiario'];
    $id_pagos = (isset($_POST['id_pagos']) && $_POST['id_pagos'] != "") ? $_POST['id_pagos']  : NULL;
    $forma_de_pago = (isset($_POST['id_paforma_de_pagogos']) && $_POST['forma_de_pago'] != "") ? $_POST['forma_de_pago']  : NULL;
    $year_on_curse = (isset($_POST['year_on_curse']) && $_POST['year_on_curse'] != "") ? $_POST['year_on_curse']  : NULL;
    $id_alta = (isset($_POST['id_alta']) && $_POST['id_alta'] != "") ? $_POST['id_alta']  : NULL;
    $fecha_de_pago_bim_1 = (isset($_POST['fecha_de_pago_bim_1']) && $_POST['fecha_de_pago_bim_1'] != "") ? $_POST['fecha_de_pago_bim_1']  : NULL;
    $fecha_de_pago_bim_2 = (isset($_POST['fecha_de_pago_bim_2']) && $_POST['fecha_de_pago_bim_2'] != "") ? $_POST['fecha_de_pago_bim_2']  : NULL;
    $fecha_de_pago_bim_3 = (isset($_POST['fecha_de_pago_bim_3']) && $_POST['fecha_de_pago_bim_3'] != "") ? $_POST['fecha_de_pago_bim_3']  : NULL;
    $fecha_de_pago_bim_4 = (isset($_POST['fecha_de_pago_bim_4']) && $_POST['fecha_de_pago_bim_4'] != "") ? $_POST['fecha_de_pago_bim_4']  : NULL;
    $fecha_de_pago_bim_5 = (isset($_POST['fecha_de_pago_bim_5']) && $_POST['fecha_de_pago_bim_5'] != "") ? $_POST['fecha_de_pago_bim_5']  : NULL;
    $fecha_de_pago_bim_6 = (isset($_POST['fecha_de_pago_bim_6']) && $_POST['fecha_de_pago_bim_6'] != "") ? $_POST['fecha_de_pago_bim_6']  : NULL;
    $exito = (isset($_POST['exito']) && $_POST['exito'] != "") ? $_POST['exito']  : 0;
    $pago = array(
        $id_pagos,
        $forma_de_pago,
        $year_on_curse,
        $id_alta,
        $fecha_de_pago_bim_1,
        $fecha_de_pago_bim_2,
        $fecha_de_pago_bim_3,
        $fecha_de_pago_bim_4,
        $fecha_de_pago_bim_5,
        $fecha_de_pago_bim_6,
        $exito
    );
}

function registrarPago($con, $pago){
    $sql_pago = "INSERT INTO pagos_adulto_mayor VALUES (?, ? ,? ,? ,? ,? ,? ,? ,? ,?, ?)";
    $consulta_pago = $con->prepare($sql_pago);
    
    try{
        $consulta_pago->execute($pago);
    }catch(Exception $e){
        echo 'Problema al registrar pago: ',  $e->getMessage(), "\n";
        die();
    }  
}

function actualizarPago($con, $pago){
    
    array_push($pago,$pago[0]);
    $pago = array_slice($pago, 1);

    echo var_dump($pago);
    $sql_pago = "UPDATE pagos_adulto_mayor SET forma_de_pago = ?, year_on_curse = ?, id_alta = ? ,fecha_de_pago_bim_1=? ,fecha_de_pago_bim_2=? ,fecha_de_pago_bim_3=? ,fecha_de_pago_bim_4=? ,fecha_de_pago_bim_5=? ,fecha_de_pago_bim_6=?, exito=? WHERE id_pagos=?";
    $consulta_pago = $con->prepare($sql_pago);
    
    try{
        $consulta_pago->execute($pago);
    }catch(Exception $e){
        echo 'Problema al actualizar pago: ',  $e->getMessage(), "\n";
        die();
    }
}




if(array_key_exists("registro_nuevo_pago",$_POST)){
    registrarPago($con, $pago);
    header("Location: ../registro_pagos.php?id_beneficiario=$id_beneficiario&id_alta=$id_alta");
}

if(array_key_exists("actualizar_pago", $_POST)){
    actualizarPago($con, $pago);
    header("Location: ../registro_pagos.php?id_beneficiario=$id_beneficiario&id_alta=$id_alta");
}