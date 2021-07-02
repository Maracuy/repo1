<?php
// Este es el nuevo archivo nuevo que MUESTR tareas

// Primero las condiciones del nivel...
$nivel = $_SESSION['user']['nivel'];
$id = $_SESSION['user']['id_ciudadano'];
if($nivel > 5){
    echo "Este nivel no cuenta con los permisos necesarios";
}

if(($nivel < 5) && ($nivel > 0)){
    $sql_tareas_demi = $con->prepare("SELECT * FROM tareas WHERE id_ciudadano_crea_tarea = $id");
    $sql_tareas_parami= $con->prepare("SELECT * FROM tareas WHERE id_ciudadano_asigna_tarea = $id");
}

if($nivel ==1 ){
    $sql_tareas_demi = $con->prepare("SELECT * FROM tareas WHERE id_tarea NOT IN (SELECT id_tarea FROM tareas WHERE id_ciudadano NOT IN (SELECT id_ciudadano FROM ciudadanos WHERE nivel = 0))");
    $sql_tareas_parami= $con->prepare("SELECT * FROM tareas");
}


$sql_tareas_demi->execute(array($myuser));
$tareas = $sql_tareas_demi->fetchALL();


$sql_yo_asigno = $con->prepare('SELECT *, ciudadanos.usuario_sistema, DATEDIFF(tareas.fecha_limite, CURDATE()) AS "dias" FROM tareas, ciudadanos WHERE tareas.id_empleado_crea_tarea = ? AND id_empleado_asigna_tarea = ciudadanos.id_ciudadano AND tareas.realizada =0 ORDER BY creada_date DESC');
$sql_yo_asigno->execute(array($myuser));
$yo_asigno = $sql_yo_asigno->fetchALL();





?>