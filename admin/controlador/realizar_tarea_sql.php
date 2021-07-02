<?php
include '../../conection/conexion.php';

if(array_key_exists("realizada",$_POST)){

    $id_tarea = $_POST['id_tarea'];
    $sql_tarea_realizada = 'UPDATE tareas SET realizada = 1 WHERE id_tarea=?';
    $sentencia_tarea_realizada = $con->prepare($sql_tarea_realizada);
    $sentencia_tarea_realizada->execute(array($id_tarea));
    $url = "../muestra_tarea.php?id=". $id_tarea; 
    header("Refresh:0; $url");

}

if(array_key_exists("index_realizada",$_POST)){
    $id_tarea = $_POST['id_tarea'];
    $sql_tarea_realizada = 'UPDATE tareas SET realizada = 1 WHERE id_tarea=?';
    $sentencia_tarea_realizada = $con->prepare($sql_tarea_realizada);
    $sentencia_tarea_realizada->execute(array($id_tarea));
    header("Refresh:0; ../index.php");
}