<?php

session_start();
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}

if(!isset($_POST)){
    die();
}

include_once '../../conection/conexion.php';

$tipo = (isset($_POST['tipo']) && $_POST['tipo'] != '') ? $_POST['tipo'] : '';

$id_empleado = $_SESSION['user']['id_ciudadano'];
$id = $_POST['id'];
$dir_subida = '../ciudadanos/' . $id . '/';

$nombre_archivo = $_FILES['userfile']['name'];
$tipo_archivo = $_FILES['userfile']['type'];

$tamano_archivo = $_FILES['userfile']['size'];


if(!is_dir($dir_subida)){
    mkdir($dir_subida, 0755);
}


function subir($con, $nombre_archivo, $tipo_archivo, $tamano_archivo, $dir_subida, $id, $id_empleado, $tipo){

    $fichero_subido = ($dir_subida . $nombre_archivo);

    //compruebo si las características del archivo son las que deseo
    if (!((strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 1000000000))) {
           echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
    }else{
           if (move_uploaded_file($_FILES['userfile']['tmp_name'],  $fichero_subido)){


                $sql_agregar = "INSERT INTO documentos(id_ciudadano_subida, id_ciudadano_documento, tipo_documento) VALUES(?,?,?)";
                $sentencia_agregar = $con->prepare($sql_agregar);

                try{
                    $sentencia_agregar->execute(array($id_empleado, $id, $tipo));
                } catch (\Throwable $th) {
                    echo 'Error al dar alta imagen en tabla documentos: ' . $th;
                    die();
                }   
                
                $last = $con->lastInsertId();

                $newname = $dir_subida . $tipo . $last .'.jpg';

                rename($fichero_subido, $newname);
                header("Location: ../archivos_ciudadanos.php?id=$id");
           }else{
                  echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
           }
    }
}



if(array_key_exists("subir",$_POST)){
    subir($con, $nombre_archivo, $tipo_archivo, $tamano_archivo, $dir_subida, $id, $id_empleado, $tipo);
}



function eliminar($con, $id, $tipo){
    //$hoy = date("Y-m-d H:i:s");

    $sql_editar = "UPDATE documentos SET fecha_borrada = NOW() WHERE id_ciudadano_documento = ? AND tipo_documento = ?";
    $sentencia_agregar = $con->prepare($sql_editar);
    try{
        $sentencia_agregar->execute(array($id, $tipo));
        header("Location: ../archivos_ciudadanos.php?id=$id");
    } catch (\Throwable $th) {
        echo $th;
        die();
    }
}


if($_GET['delete']){
    $id  = $_GET['id'];
    $tipo = $_GET['delete'];
    eliminar($con, $id, $tipo);
}



?>