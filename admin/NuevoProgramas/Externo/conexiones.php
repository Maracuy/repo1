<?php
class conectarDBO{
    public static function conexion(){
        try{
            $conexion = new PDO('mysql:host=127.0.0.1:3309;dbname=thetest;charset=utf8', 'root', 'password');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET UTF8");
        }catch(Exception $e){
            echo "Error en linea: " . $e->getLine();
            die("<br>Detalles: " . $e->getMessage());
        }
        return $conexion;
    }
}
?>