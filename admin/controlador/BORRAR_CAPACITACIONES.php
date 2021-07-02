<?php
require_once '../../conection/conexion.php';

$sentencia = "SELECT capacitacion1, capacitacion2, id_ciudadano FROM puestos_defensa WHERE capacitacion1 = 1 OR capacitacion2 = 1 ORDER BY id_ciudadano";
$stm = $con->query($sentencia);
$capacitaciones = $stm->fetchAll(PDO::FETCH_ASSOC);

var_dump($capacitaciones);

foreach($capacitaciones as $capacitacion){
    $id = $capacitacion['id_ciudadano'];
    if($capacitacion['capacitacion1'] == 1){
        $sql_editar = "INSERT INTO capacitaciones_defensa (capacitacion1, id_ciudadano) VALUES (1, $id)";
        $sentencia_agregar = $con->prepare($sql_editar);
        try {
            $sentencia_agregar->execute();
            echo 'Se agrego del ciudadano: ' . $id . '<br>';
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    if($capacitacion['capacitacion2'] == 1 && $capacitacion['capacitacion1'] == 0){
        $sql_editar = "INSERT INTO capacitaciones_defensa (capacitacion2, id_ciudadano) VALUES (1, $id)";
        $sentencia_agregar = $con->prepare($sql_editar);
        try {
            $sentencia_agregar->execute();
            echo 'Se agrego del ciudadano: ' . $id . '<br>';
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    if($capacitacion['capacitacion1']==1 && $capacitacion['capacitacion2'] ==1)  {
        $sql_editar = "UPDATE capacitaciones_defensa SET capacitacion2 = 1 WHERE id_ciudadano = $id";
        $sentencia_agregar = $con->prepare($sql_editar);
        try {
            $sentencia_agregar->execute();
            echo 'Se agrego del ciudadano: ' . $id . '<br>';
        }catch(\Throwable $th){
            echo 'Error: ' . $id . '<br>';
        }
    }
   
}    
?> 