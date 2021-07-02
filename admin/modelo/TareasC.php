<?php

class ConsultaTareas extends DBConexion{

    public function MuestraTareas($id_ciudadano){
        $consulta = "SELECT tareas.*, c1.nombres AS manda, c2.nombres AS recibe 
        FROM tareas 
        LEFT JOIN ciudadanos c1 ON tareas.id_ciudadano_crea_tarea = c1.id_ciudadano
        LEFT JOIN ciudadanos c2 ON tareas.id_ciudadano_recibe_tarea = c2.id_ciudadano
        WHERE id_ciudadano_crea_tarea = $id_ciudadano OR id_ciudadano_recibe_tarea = $id_ciudadano";
        $sql = DBConexion::Conexion()->prepare($consulta);
        $sql->execute();
        return $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function NuevaTarea($id_ciudadano){
        $consulta = "INSERT INTO tareas
        (id_ciudadano_crea_tarea, id_ciudadano_recibe_tarea, fecha_limite, tarea_titulo, tarea_descripcion, prioridad)
        VALUES(?,?,?,?,?,?)";
        $sql = DBConexion::Conexion()->prepare($consulta);
        if($sql->execute()){
            $resultado = self::MuestraTareas($id_ciudadano);
            return $resultado;
        }
    }
}


?>