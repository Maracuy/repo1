<?php
session_start();
require_once '../../conection/conexion.php';


if(array_key_exists("buscar_beneficiario",$_POST)){
    include 'beneficiarios_todos.php';
}

if(array_key_exists("registrar_tarea",$_POST)){

    $id_empleado_crea_tarea = $_SESSION['user']['id_empleado'];
    $tarea_titulo = $_POST['tarea']['titulo'];
    $tarea_descripcion = nl2br($_POST['tarea']['descripcion']);
    $tarea_responsable = $_POST['tarea']['responsable'];
    $tarea_fecha_limite = $_POST['tarea']['fecha_limite'];
    $tarea_beneficiario_id = ($_POST['tarea']['beneficiario_id'] != "" ) ? $_POST['tarea']['beneficiario_id'] : 0;

    $sql_agregar_tarea = 'INSERT INTO tareas VALUES (NULL, ?, ?, CURDATE(), ?, ?, ?, ?, 0, 0)';
    $agregar_tarea = $con->prepare($sql_agregar_tarea);

    try{
        $agregar_tarea->execute(array($id_empleado_crea_tarea, $tarea_responsable, $tarea_titulo, $tarea_descripcion, $tarea_fecha_limite, $tarea_beneficiario_id));
        header("Location: ../index.php");

    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }  

}
