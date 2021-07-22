<?php
// Ejemplo de CURP: AAAA000000AAAAAA00
// Clase (Objeto) para agrupar y extraer datos de los programas
class ObjectTable{
    private $idPro;
    private $typePro;
    private $namePro;
    private $shortNamePro;
    public function __construct($idPro, $typePro, $namePro, $shortNamePro){
        $this->idPro = $idPro;
        $this->typePro = $typePro;
        $this->namePro = $namePro;
        $this->shortNamePro = $shortNamePro;
    }
    public function getProgramId(){
        return $this->idPro;
    }
    public function getProgramType(){
        return $this->typePro;
    }
    public function getProgramName(){
        return $this->namePro;
    }
    public function getProgramShortName(){
        return $this->shortNamePro;
    }
}

// Clase para extraer datos de formulario
class ExtraerFormulario{
    public static function setVariablePost($nombreInput){
        return strip_tags(htmlspecialchars($_POST[$nombreInput]));
    }
}

// mostrar datos de la persona y registrarlo (Tercer paso)
if (isset($_GET["curp"])) {
    // Revisar si la persona se encuentra ya registrada en el programa
    $programaParaRegistrar = htmlentities(addslashes($_GET["registro"]));
    $curpParaRegistrar = htmlentities(addslashes($_GET["curp"]));
    include_once "../conection/conexion.php";
    $buscarregistrocurp = "SELECT id_ciudadano FROM ciudadanos WHERE curp= :curp";
    $resultado = $con->prepare($buscarregistrocurp);
    $resultado->bindValue(":curp", $curpParaRegistrar);
    $resultado->execute();
    $registrosNo = $resultado->rowCount();
    if ($registrosNo != 0) {
        // Ya se encuentra registrado, no se puede hacer algo mas   
        $idCiudadanoFromBase = $resultado->fetch(PDO::FETCH_ASSOC);
        $idCiudadanoFromBase = $idCiudadanoFromBase['id_ciudadano'];
        $buscarprogramaregistrado = "SELECT * FROM programas_registro WHERE ID_CIUDADANO_REGISTRADO = :id_ciudadano_registrado AND ID_PROGRAMA_REGISTRADO = :id_programa_registrado;";
        $resultado2 = $con->prepare($buscarprogramaregistrado);
        $resultado2->bindValue(":id_ciudadano_registrado", $idCiudadanoFromBase);
        $resultado2->bindValue(":id_programa_registrado", $programaParaRegistrar);
        $resultado2->execute();
        $registrosNo2 = $resultado2->rowCount();
        if ($registrosNo2 != 0) {
            echo "<div class=\"lname-containerMostrarDatosConfirmacion\">
            <div class=\"lname-containerDatosConfirmacionBox\">
            <p>El ciudadano ({$curpParaRegistrar}) ya se encuentra registrado en este programa ({$programaParaRegistrar})</p>
            </div><div class=\"lname-containerDatosConfirmacionBox\">
            <a href=\"{$_SERVER['PHP_SELF']}\" class=\"btn btn-danger\">Volver al inicio</a>
            </div></div>";
        } else {
            $revisarcamposciudadano = "SELECT apellido_p, apellido_m, nombres, fecha_nacimiento, curp, email, telefono, whats, dir_calle, dir_numero, dir_numero_int, id_colonia, otra_colonia, dir_referencia, manzana, lote, cp, zona, seccion_electoral, municipio, origen FROM ciudadanos WHERE id_ciudadano = :id_ciudadano;";
            $resultado3 = $con->prepare($revisarcamposciudadano);
            $resultado3->bindValue(":id_ciudadano", $idCiudadanoFromBase);
            $resultado3->execute();
            $camposTablaCiudadanos = $resultado3->fetch(PDO::FETCH_ASSOC);
            if (isset($_POST["nameBtnEnviarFormulario"])) {
                $apellidoPaterno = ExtraerFormulario::setVariablePost("nameInputApellidoP");
                $apellidoMaterno = ExtraerFormulario::setVariablePost("nameInputApellidoM");
                $nombres = ExtraerFormulario::setVariablePost("nameInputNombre");
                $fechaNacimiento = ExtraerFormulario::setVariablePost("nameInputFechaNacimiento");
                $curp = ExtraerFormulario::setVariablePost("nameInputCURP");
                $email = ExtraerFormulario::setVariablePost("nameInputEmail");
                $telefono = ExtraerFormulario::setVariablePost("nameInputTelefono");
                $whatsApp = ExtraerFormulario::setVariablePost("nameInputWhatsApp");
                $calle = ExtraerFormulario::setVariablePost("nameInputCalle");
                $numero = ExtraerFormulario::setVariablePost("nameInputNumero");
                $interno = ExtraerFormulario::setVariablePost("nameInputInterno");
                $colonia = ExtraerFormulario::setVariablePost("nameInputColonia");
                $otraColonia = ExtraerFormulario::setVariablePost("nameInputOtraColonia");
                $referenciaDireccion = ExtraerFormulario::setVariablePost("nameInputReferenciaDireccion");
                $manzana = ExtraerFormulario::setVariablePost("nameInputManzana");
                $lote = ExtraerFormulario::setVariablePost("nameInputLote");
                $codigoPostal = ExtraerFormulario::setVariablePost("nameInputCodigoPostal");
                $zona = ExtraerFormulario::setVariablePost("nameInputZona");
                $seccion = ExtraerFormulario::setVariablePost("nameInputSeccion");
                $municipio = ExtraerFormulario::setVariablePost("nameInputMunicipio");
                $origen = ExtraerFormulario::setVariablePost("nameInputOrigen");
                $consulta = "UPDATE ciudadanos SET apellido_p = :apellido_p, apellido_m = :apellido_m, nombres = :nombres, fecha_nacimiento = :fecha_nacimiento, curp = :curp, email = :email, telefono = :telefono, whats = :whats, dir_calle = :dir_calle, dir_numero = :dir_numero, dir_numero_int = :dir_numero_int, id_colonia = :id_colonia, otra_colonia = :otra_colonia, dir_referencia = :dir_refencia, manzana = :manzana, lote = :lote, cp = :cp, zona = :zona, seccion_electoral = :seccion_electoral, municipio = :municipio, origen = :origen WHERE curp = :curp_ciudadano;";
                $resultado4 = $con->prepare($consulta);
                $resultado4->bindValue(":apellido_p", $apellidoPaterno);
                $resultado4->bindValue(":apellido_m", $apellidoMaterno);
                $resultado4->bindValue(":nombres", $nombres);
                $resultado4->bindValue(":fecha_nacimiento", $fechaNacimiento);
                $resultado4->bindValue(":curp", $curp);
                $resultado4->bindValue(":email", $email);
                $resultado4->bindValue(":telefono", $telefono);
                $resultado4->bindValue(":whats", $whatsApp);
                $resultado4->bindValue(":dir_calle", $calle);
                $resultado4->bindValue(":dir_numero", $numero);
                $resultado4->bindValue(":dir_numero_int", $interno);
                $resultado4->bindValue(":id_colonia", $colonia);
                $resultado4->bindValue(":otra_colonia", $otraColonia);
                $resultado4->bindValue(":dir_refencia", $referenciaDireccion);
                $resultado4->bindValue(":manzana", $manzana);
                $resultado4->bindValue(":lote", $lote);
                $resultado4->bindValue(":cp", $codigoPostal);
                $resultado4->bindValue(":zona", $zona);
                $resultado4->bindValue(":seccion_electoral", $seccion);
                $resultado4->bindValue(":municipio", $municipio);
                $resultado4->bindValue(":origen", $origen);
                $resultado4->bindValue(":curp_ciudadano", $curpParaRegistrar);
                $resultado4->execute();
                if ($resultado4) {
                    $consulta2 = "SELECT id_ciudadano FROM ciudadanos WHERE curp = :curpCiudadano;";
                    $resultado5 = $con->prepare($consulta2);
                    $resultado5->bindValue(":curpCiudadano", $curpParaRegistrar);
                    $resultado5->execute();
                    $idCiudadanoRegistro = $resultado5->fetch(PDO::FETCH_ASSOC);
                    $idCiudadanoRegistro = $idCiudadanoRegistro['id_ciudadano'];
                    if ($resultado5) {
                        $consulta3 = "INSERT INTO programas_registro(ID_PROGRAMA_REGISTRADO, ID_CIUDADANO_REGISTRADO, FECHA_REGISTRO) VALUES (:idPrograma, :idCiudadano, :fecha)";
                        $resultado6 = $con->prepare($consulta3);
                        setlocale(LC_ALL, "es_ES");
                        $fecha = date("d") . "/" . date("m") . "/" . date("Y");
                        $resultado6->bindValue(":idPrograma", $programaParaRegistrar);
                        $resultado6->bindValue(":idCiudadano", $idCiudadanoRegistro);
                        $resultado6->bindValue(":fecha", $fecha);
                        $resultado6->execute();
                        if (!$resultado6) {
                            echo "<div class=\"lname-containerMostrarDatosConfirmacion\"><div class=\"lname-containerDatosConfirmacionBox\">
                            <p>Ocurrio un error al registrar, intentelo nuevamente</p>
                            </div><div class=\"lname-containerDatosConfirmacionBox\">
                            <a href=\"{$_SERVER['PHP_SELF']}\" class=\"btn btn-danger\">Volver al inicio</a></div></div>";
                        }else{
                            echo "<div class=\"lname-containerMostrarDatosConfirmacion\"><div class=\"lname-containerDatosConfirmacionBox\">
                            <p>El ciudadano ({$curpParaRegistrar}) se registro correctamente en  el programa (id: {$programaParaRegistrar})</p>
                            </div><div class=\"lname-containerDatosConfirmacionBox\"><a href=\"{$_SERVER['PHP_SELF']}\" class=\"btn btn-primary\">Volver al inicio</a></div></div>";
                        }
                    } else {
                        echo "<div class=\"lname-containerMostrarDatosConfirmacion\"><div class=\"lname-containerDatosConfirmacionBox\">
                        <p>Ocurrio un error al registrar, intentelo nuevamente</p>
                        </div><div class=\"lname-containerDatosConfirmacionBox\">
                        <a href=\"{$_SERVER['PHP_SELF']}\" class=\"btn btn-danger\">Volver al inicio</a></div></div>";
                    }
                } else {
                    echo "<div class=\"lname-containerMostrarDatosConfirmacion\">
                    <div class=\"lname-containerDatosConfirmacionBox\">
                    <p>Ocurrio un error al registrar, intentelo nuevamente</p>
                    </div><div class=\"lname-containerDatosConfirmacionBox\">
                    <a href=\"{$_SERVER['PHP_SELF']}\" class=\"btn btn-danger\">Volver al inicio</a></div></div>";
                }
            } else {
                echo "<div class=\"lname-containerMostrarDatosConfirmacion\"><div class=\"lname-containerDatosConfirmacionBox\">
                <p>Información del ciudadano</p>
                </div></div>";
                include_once("formCiudadanos.php");
            }
        }
    } else {
        // el ciudadano ingresado no existe, registrar por completo
        lanzarFormularioRegistroCiudadano();
    }
} else {
    // Se selecciono un programa y se puede iniciar la busqueda por CURP
    if (isset($_GET["registro"])) {
        if (isset($_POST["btnSmForm"])) {
            include_once "../conection/conexion.php";
            $sql = "SELECT * FROM ciudadanos WHERE curp= :curp";
            $resultado = $con->prepare($sql);
            $curpUsuario = htmlentities(addslashes($_POST["inputSmForm"]));
            $resultado->bindValue(":curp", $curpUsuario);
            $resultado->execute();
            $registrosNo = $resultado->rowCount();
            if ($registrosNo != 0) {
                // el ciudadano si esta registrado, verificar datos y registrar
                $urlCorta = $_SERVER['PHP_SELF'] . "?registro=" . $_GET["registro"];
                $urlCompleta = $urlCorta . "&curp=" . $curpUsuario;
                echo "<div class=\"lname-containerMostrarDatosConfirmacion\"><div class=\"lname-containerDatosConfirmacionBox\"><p>Antes de continuar, revise los datos</p><p>Programa a registrar (ID): " . $_GET["registro"] . "</p><p>CURP: " . $curpUsuario . "</p></div><div class=\"lname-containerDatosConfirmacionBox\"><br><a href=\"{$urlCorta}\" class=\"btn btn-danger\">No, Regresar</a><br><a href=\"{$urlCompleta}\" class=\"btn btn-success\">Si, Continuar</a></div></div>";
            } else {
                // el ciudadano NO esta registrado, lanzar formulario de registro
                lanzarFormularioRegistroCiudadano();
            }
        } else {
            // mostrar formulario de busqueda CURP (Segundo paso)
            echo "<div class=\"lname-containerFormCURP\"><form method=\"post\" onsubmit=\"return verificarCurp();\" action=\"{$_SERVER['PHP_SELF']}?registro={$_GET["registro"]}\">
            <input type=\"text\" id=\"inputSmForm\" class=\"form-control\" name=\"inputSmForm\" placeholder=\"CURP\" maxlength=\"18\" minlength=\"18\">
            <input type=\"submit\" name=\"btnSmForm\" class=\"btn btn-success\" value=\"Verificar\">
            <p id=\"mensajeVerificacion\"></p></form></div>";
        }
    } else {
        // Consulta y agrupacion en un arreglo de objetos con el que se trabajara (Primer paso)
        include_once "../conection/conexion.php";
        $consulta = $con->query("SELECT * FROM PROGRAMAS_BASE");
        $arrayObjectResult = array();
        while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $arrayObjectResult[] = new ObjectTable($resultado['ID_PROGRAMA'], strtolower($resultado['TIPO_PROGRAMA']), $resultado['NOMBRE_PROGRAMA'], $resultado['NOMBRE_CORTO_PROGRAMA']);
        }
        // Seleccion (conteo) de tipos de programas disponibles
        $searchSim = array();
        foreach ($arrayObjectResult as $index2S) {
            $searchSim[] = $index2S->getProgramType();
        }
        // Eliminacion de duplicados
        $searchSim = array_unique($searchSim, SORT_STRING);
        // Creacion de las tablas de forma dinamica
        foreach ($searchSim as $keyValue) {
            echo "<table><tbody><tr><td colspan=\"4\">{$keyValue}</td></tr>";
            echo "<th>ID</th><th>Nombre</th><th>Abreviación</th><th>Acción</th></tr><tr>";
            foreach ($arrayObjectResult as $keyValue2) {
                if ($keyValue == $keyValue2->getProgramType()) {
                    $containTxt = "<tr><td>" . $keyValue2->getProgramId() . "</td>";
                    $containTxt .= "<td>" . $keyValue2->getProgramName() . "</td>";
                    $containTxt .= "<td>" . $keyValue2->getProgramShortName() . "</td>";
                    // Falta programar accion get del boton utilizando este id (agregar ruta)
                    $containTxt .= "<td> <a href=\"registro_programas.php?registro=" . $keyValue2->getProgramId() . "\">Registrar</a></td></tr>";
                    echo $containTxt;
                }
            }
            echo "</tbody></table>";
        }
    }
}

function lanzarFormularioRegistroCiudadano(){
    if (isset($_POST["nameBtnEnviarFormulario2"])) {
        $apellidoPaterno = ExtraerFormulario::setVariablePost("nameInputApellidoP");
        $apellidoMaterno = ExtraerFormulario::setVariablePost("nameInputApellidoM");
        $nombre = ExtraerFormulario::setVariablePost("nameInputNombre");
        $fechaNacimiento = ExtraerFormulario::setVariablePost("nameInputFechaNacimiento");
        $curp = ExtraerFormulario::setVariablePost("nameInputCURP");
        $email = ExtraerFormulario::setVariablePost("nameInputEmail");
        $telefono = ExtraerFormulario::setVariablePost("nameInputTelefono");
        include "../conection/conexion.php";
        $sql5 = "INSERT INTO ciudadanos(apellido_p, apellido_m, nombres, fecha_nacimiento, curp, email, telefono) VALUES (:apellidoP, :apellidoM, :nombre, :fechaNacimiento, :curp, :email, :telefono);";
        $resultado7 = $con->prepare($sql5);
        $resultado7->bindValue(":apellidoP", $apellidoPaterno);
        $resultado7->bindValue(":apellidoM", $apellidoMaterno);
        $resultado7->bindValue(":nombre", $nombre);
        $resultado7->bindValue(":fechaNacimiento", $fechaNacimiento);
        $resultado7->bindValue(":curp", $curp);
        $resultado7->bindValue(":email", $email);
        $resultado7->bindValue(":telefono", $telefono);
        $resultado7->execute();
        if($resultado7){
            $curpInformacion = htmlentities(addslashes($_GET["curp"]));
            $registroInformacion = htmlentities(addslashes($_GET["registro"]));
            $urlRedireccion = $_SERVER['PHP_SELF'] . "?registro={$registroInformacion}&curp={$curpInformacion}";
            echo "<div class=\"lname-containerMostrarDatosConfirmacion\"><div class=\"lname-containerDatosConfirmacionBox\">
            <p>El ciudadano ({$curpInformacion}) se registro correctamente, A continuación revise sus datos para registrar al programa (id: {$registroInformacion})</p></div><div class=\"lname-containerDatosConfirmacionBox\"><a href=\"{$_SERVER['PHP_SELF']}\" class=\"btn btn-danger\">Regresar</a><a href=\"{$urlRedireccion}\" class=\"btn btn-success\">Continuar</a></div></div>";
        }else{
            echo "<div class=\"lname-containerMostrarDatosConfirmacion\">
            <div class=\"lname-containerDatosConfirmacionBox\">
            <p>Ocurrio un error al registrar, intentelo nuevamente</p>
            </div><div class=\"lname-containerDatosConfirmacionBox\">
            <a href=\"{$_SERVER['PHP_SELF']}\" class=\"btn btn-danger\">Volver al inicio</a></div></div>";
        }
    }else{
        $curpUsuario = htmlentities(addslashes($_POST["inputSmForm"]));
        $programaParaRegistrar = htmlentities(addslashes($_GET["registro"]));
        echo "<div class=\"lname-containerMostrarDatosConfirmacion\"><div class=\"lname-containerDatosConfirmacionBox\"><p>Información requerida</p></div></div>";
        include_once("formCiudadano.php");
    }
}

?>