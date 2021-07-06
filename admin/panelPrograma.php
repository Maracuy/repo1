<style>
table{
    margin: 20px;
}
th, tr, td{
    border: 1px solid rgba(0,0,0,.3);
    padding: 8px;
}

th:last-child, tr:last-child, td:last-child{
    border: none;
    padding: 8px;
}
</style>

<?php

    // Clase (Objeto) para agrupar y extraer datos de los programas
    class ObjectTable{
        private $idPro;
        private $typePro;
        private $namePro;
        private $shortNamePro;

        public function __construct($idPro, $typePro, $namePro, $shortNamePro) {
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

    // Consulta y agrupacion en un arreglo de objetos con el que se trabajara
    include_once("../conection/conexion.php");
    $consulta = $con->query("SELECT * FROM PROGRAMAS_BASE");
    $arrayObjectResult = array();

    while($resultado = $consulta->fetch(PDO::FETCH_ASSOC)){
        $arrayObjectResult[] = new ObjectTable($resultado['ID_PROGRAMA'],strtolower($resultado['TIPO_PROGRAMA']) , $resultado['NOMBRE_PROGRAMA'], $resultado['NOMBRE_CORTO_PROGRAMA']);
    }

    // Seleccion (conteo) de tipos de programas disponibles
    $searchSim = array();

    foreach($arrayObjectResult as $index2S){
        $searchSim[] = $index2S->getProgramType();
    }

    // Eliminacion de duplicados
    $searchSim = array_unique($searchSim, SORT_STRING);

    // Creacion de las tablas de forma dinamica
    foreach($searchSim as $keyValue){

        echo "<table><tbody><tr><td colspan=\"4\">{$keyValue}</td></tr>";
        echo "<th>ID</th><th>Nombre</th><th>Abreviación</th><th>Acción</th></tr><tr>";

        foreach($arrayObjectResult as $keyValue2){
            if($keyValue == $keyValue2->getProgramType()){
                $containTxt = "<tr><td>" . $keyValue2->getProgramId() . "</td>";
                $containTxt .= "<td>" . $keyValue2->getProgramName() . "</td>";
                $containTxt .= "<td>" . $keyValue2->getProgramShortName() . "</td>";

                // Falta programar accion get del boton utilizando este id (agregar ruta)
                $containTxt .= "<td> <a href=\"". $keyValue2->getProgramId() . "\">Registrar</a></td></tr>";
                echo $containTxt;
            }
        }
        echo "</tbody></table>";
    }

?>