<?php

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

// mostrar datos de la persona y registrarlo (Tercer paso)
if (isset($_GET["curp"])) {

   // echo "esta guardada la curp por url<br>";

    // Revisar si la persona se encuentra ya registrada en el programa
    $programaParaRegistrar = htmlentities(addslashes($_GET["registro"]));
    $curpParaRegistrar = htmlentities(addslashes($_GET["curp"]));

    include_once("busquedaPersonas.php");

    
























} else {

    // Se selecciono un programa y se puede iniciar la busqueda por CURP
    // Ejemplo de CURP: AAAA000000AAAAAA00

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

                echo "<div class=\"lname-containerMostrarDatosConfirmacion\"><div class=\"lname-containerDatosConfirmacionBox\">";

                

                echo "<p>Antes de continuar, revise los datos</p>";
                echo "<p>Programa a registrar (ID): " . $_GET["registro"] . "</p>";
                echo "<p>CURP: " . $curpUsuario . "</p>";

                echo "</div><div class=\"lname-containerDatosConfirmacionBox\">";

                echo "<br><a href=\"{$urlCorta}\" class=\"btn btn-danger\">No, Regresar</a>";
                echo "<br><a href=\"{$urlCompleta}\" class=\"btn btn-success\">Si, Continuar</a>";

                echo "</div></div>";





            } else {
                // el ciudadano NO esta registrado, lanzar formulario de registro
                echo "<br>El ciudadano no esta registrado";
                /*
                *
                *
                * AQUI SE HARAN OTRAS VALIDACIONES EN CASO DE QUE LA PERSONA NO EXISTA
                *               
                */






            }

        } else {
            // mostrar formulario de busqueda CURP (Segundo paso)

            echo "<div class=\"lname-containerFormCURP\"><form method=\"post\" onsubmit=\"return verificarCurp();\" action=\"{$_SERVER['PHP_SELF']}?registro={$_GET["registro"]}\">
            <input type=\"text\" id=\"inputSmForm\" class=\"form-control\" name=\"inputSmForm\" placeholder=\"CURP\" maxlength=\"18\" minlength=\"18\">
            <input type=\"submit\" name=\"btnSmForm\" class=\"btn btn-success\" value=\"Verificar\">
            <p id=\"mensajeVerificacion\"></p>
            </form></div>";

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

?>