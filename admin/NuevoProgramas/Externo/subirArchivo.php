<?php

// obtener datos del formulario
$nombre = strip_tags(htmlspecialchars($_POST['campoNameSubirRIS1']));
$archivo = $_FILES['campoNameSubirRIS2'];
$idUsuario = strip_tags(htmlspecialchars($_POST['campoNameSubirRIS0']));

// Variable que contiene los mensajes de error
$mensajeDeError = "";
$erroresComunes = 0;

// Existe un error en el campo FILE
$mensajeDeError .= ($archivo['error'] != 0) ? 'Ocurrió un error accediendo al archivo<br>' : '';
($archivo['error'] != 0) ? $erroresComunes++ : $erroresComunes;
// El titulo es menor a 2 caracteres
$mensajeDeError .= (strlen($nombre) <= 2) ? 'El nombre es muy corto (Inferior a 3 caracteres)<br>' : '';
(strlen($nombre) <= 2) ? $erroresComunes++ : $erroresComunes;
// El titulo es mayor a 25 caracteres
$mensajeDeError .= (strlen($nombre) > 30) ? 'El nombre es muy largo (Superior a 30 caracteres)<br>' : '';
(strlen($nombre) > 30) ? $erroresComunes++ : $erroresComunes;

// VALIDAR ARCHIVO
// Comprobar tipo de archivo
$tiposPermitidos = ['image/jpeg',
                    "image/pjpeg",
                    "image/gif",
                    "image/png",
                    "application/pdf",
                    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                    "application/vnd.ms-excel",
                    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                    "application/vnd.openxmlformats-officedocument.presentationml.presentation",
                    "application/vnd.openxmlformats-officedocument.wordprocessingml.template",
                    "application/vnd.ms-word.document.macroEnabled.12",
                    "application/vnd.ms-word.template.macroEnabled.12",
                    "application/msword",
                    "application/vnd.openxmlformats-officedocument.spreadsheetml.template",
                    "application/vnd.ms-excel.sheet.macroEnabled.12",
                    "application/vnd.ms-excel.template.macroEnabled.12",
                    "application/vnd.ms-excel.addin.macroEnabled.12",
                    "application/vnd.ms-excel.sheet.binary.macroEnabled.12",
                    "application/vnd.ms-powerpoint",
                    "application/vnd.openxmlformats-officedocument.presentationml.template",
                    "application/vnd.openxmlformats-officedocument.presentationml.slideshow",
                    "application/vnd.ms-powerpoint.addin.macroEnabled.12",
                    "application/vnd.ms-powerpoint.presentation.macroEnabled.12",
                    "application/vnd.ms-powerpoint.template.macroEnabled.12",
                    "application/vnd.ms-powerpoint.slideshow.macroEnabled.12"];

$erroresAprobados = false;

for($i = 0; $i < count($tiposPermitidos); $i++){
    if($archivo['type'] == $tiposPermitidos[$i]){
        $erroresAprobados = true;
    }
}

if(!$erroresAprobados){
    $erroresComunes++;
    $mensajeDeError .= "El archivo no corresponde con ningun tipo seleccionado<br>";
}

// Comprobar errores
if($archivo['error'] != 0){
    $erroresComunes++;
    $mensajeDeError .= "Ocurrió un error al cargar el archivo desde el directorio<br>";
}

// Comprobar peso
$pesoMB = ($archivo['size'] / 1048576);
$pesoMaximoMb = 6;

if($pesoMB > $pesoMaximoMb){
    $erroresComunes++;
    $mensajeDeError .= "El archivo supera los " . $pesoMaximoMb . "Mb permitidos<br>";
}

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

// Si no contiene ningun error anterior, subir
if($erroresComunes == 0){
    // La carpeta no existe y no se ha creado
    if(!file_exists($directorioDestino)){
        $mensajeDeError .= mkdir($directorioDestino, 0777, true) ? '' : 'El destino en el servidor no existe<br>';
    }else{
        // No se puede abrir el directorio
        if(opendir($directorioDestino)){
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
        }else{
            $mensajeDeError .=  "No fue posible acceder a la carpeta destino<br>";
        }
    }
}

// retorna el mensaje de error y de exito en caso de estar vacio
echo $mensajeDeError;
?>