<?php

// obtener datos del formulario
$nombre = strip_tags(htmlspecialchars($_POST['campoNameSubirRIS1']));
$archivo = $_FILES['campoNameSubirRIS2'];


$idUsuario = strip_tags(htmlspecialchars($_POST['campoNameSubirRIS0']));

/*
- name
- type
- tmp_name
- error
- size
*/

// Variable que contiene los mensajes de error
$mensajeDeError = "";

// Existe un error en el campo FILE
$mensajeDeError .= ($archivo['error'] != 0) ? 'Ocurrió un error accediendo al archivo<br>' : '';
// El titulo es menor a 2 caracteres
$mensajeDeError .= (strlen($nombre) <= 2) ? 'El nombre es muy corto (Inferior a 3 caracteres)<br>' : '';
// El titulo es mayor a 25 caracteres
$mensajeDeError .= (strlen($nombre) > 30) ? 'El nombre es muy largo (Superior a 30 caracteres)<br>' : '';

// VALIDAR ARCHIVO

// RENOMBRAR Y SUBIR ARCHIVO

// Asignar nombre aleatorio para el archivo
date_default_timezone_set('America/Mexico_City');
$nuevoNombreArchivo = date("dmYGi") . mt_rand(1,10000);

// obtener la extension del archivo
$extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);

// unir el nombre aleatorio y extension
$nuevoNombreArchivoConExtension = $nuevoNombreArchivo . "." . $extension;

// Destino para los archivos subidos
$directorioDestino = "../documentos";

// La carpeta no existe y no se ha creado
if(!file_exists($directorioDestino)){
    $mensajeDeError .= mkdir($directorioDestino, 0777, true) ? '' : 'El destino en el servidor no existe<br>';
}

// No se puede abrir el directorio
$mensajeDeError .= opendir($directorioDestino) ? '' : 'No fue posible acceder a la carpeta destino<br>';

// Nueva ruta para el archivo
$archivoPreparado = $directorioDestino . '/' . $nuevoNombreArchivoConExtension;


// Subir el archivo a la carpeta destino
if(move_uploaded_file($archivo['tmp_name'], $archivoPreparado)){
    // el archivo se subio correctamente
    try{
        include_once('conexiones.php');
        $consultaSQL = "INSERT INTO INFORMACION_BASICA_DOCUMENTOS(NOM_EN_SERVIDOR, NOM_EN_PANTALLA, EXTENSION, ID_PROPIETARIO, FECHA) VALUES(:nombreServidor, :nombrePantalla, :extensionArchivo, :idPropietario, now());";
        $resultadoSQL = conectarDBO::conexion()->prepare($consultaSQL);
        $resultadoSQL->bindValue(":nombreServidor", $nuevoNombreArchivoConExtension);
        $resultadoSQL->bindValue(":nombrePantalla", $nombre);
        $resultadoSQL->bindValue(":extensionArchivo", $extension);
        $resultadoSQL->bindValue(":idPropietario", $idUsuario);
        $resultadoSQL->execute();
    }catch(Exception $e){
      //  echo "Linea del error: " . $e->getLine();
        $mensajeDeError .= "Ocurrió un error al escribir los datos en la base";
    }

}else{
    // no se subio el archivo
    $mensajeDeError .= "Ocurrió un error al intentar mover el archivo hacia el destino<br>";
}


















// retorna el mensaje de error y de exito en caso de estar vacio
echo $mensajeDeError;

?>