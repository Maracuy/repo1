<?php

include_once('pruebas.php');

class CiudadanosLista{
    private $idCiudadano;
    private $indiceProcesoRealizado;
    private $indiceFechas;
    private $indiceAnotaciones;
    private $stringProcesosRealizados;
    private $stringFechas;
    private $stringAnotaciones;

    public function __construct($idCiudadano, $indiceProcesoRealizado, $indiceFechas, $indiceAnotaciones){
        $this->idCiudadano = $idCiudadano;
        $this->indiceProcesoRealizado = $indiceProcesoRealizado;
        $this->indiceFechas = $indiceFechas;
        $this->indiceAnotaciones = $indiceAnotaciones;
        $this->stringProcesosRealizados = "";
        $this->stringFechas = "";
        $this->stringAnotaciones = "";
    }
    
    // Getters de los indices
    public function getIdCiudadano(){
        return $this->idCiudadano;
    }

    public function getIndiceProcesoRealizado(){
        return $this->indiceProcesoRealizado;
    }

    public function getIndiceFechas(){
        return $this->indiceFechas;
    }

    public function getIndiceAnotaciones(){
        return $this->indiceAnotaciones;
    }

    // Getters de busqueda con el indice
    public function getProcesoPorIndiceRealizado($indiceProceso){
        $arreglo = $this->getIndiceProcesoRealizado();
        $existenciaDelIndice = self::getComprobarIndiceDeArreglo($arreglo, $indiceProceso);
        if($existenciaDelIndice){
            return $arreglo[$indiceProceso];
        }else{
            return false;
        }
    }

    public function getFechaPorIndice($indiceFecha){
        $arreglo = $this->getIndiceFechas();
        $existenciaDelIndice = self::getComprobarIndiceDeArreglo($arreglo, $indiceFecha);
        if($existenciaDelIndice){
            return $arreglo[$indiceFecha];
        }else{
            return false;
        }
    }

    public function getAnotacionesPorIndice($indiceAnotacion){
        $arreglo = $this->getIndiceAnotaciones();
        $existenciaDelIndice = self::getComprobarIndiceDeArreglo($arreglo, $indiceAnotacion);
        if($existenciaDelIndice){
            return $arreglo[$indiceAnotacion];
        }else{
            return false;
        }
    }

    // Funciones de validacion
    private static function getComprobarIndiceDeArreglo($arreglo, $indice){
        $existenciaDelIndice = isset($arreglo[$indice]) ? true : false;
        return $existenciaDelIndice;
    }

    // Setters Internos
    private function setAgregarProcesoRealizado($indiceProceso, $contenidoProceso){
        $valor = $this->getProcesoPorIndiceRealizado($indiceProceso);
        if(!$valor || $valor != true || $valor == ""){
            $this->indiceProcesoRealizado[$indiceProceso] = $contenidoProceso;
        }else{
            return false;
        }
    }

    private function setEliminarProcesoRealizado($indiceProceso){
        $valor = $this->getProcesoPorIndiceRealizado($indiceProceso);
        if($valor || !$valor != true || !$valor == ""){
            unset($this->indiceProcesoRealizado[$indiceProceso]);
        }else{
            return false;
        }
    }

    private function setAgregarFecha($indiceFecha, $contenidoFecha){
        $valor = $this->getFechaPorIndice($indiceFecha);
        if(!$valor || $valor != true || $valor == ""){
            $this->indiceFechas[$indiceFecha] = $contenidoFecha;
        }else{
            return false;
        }
    }

    private function setEliminarFecha($indiceFecha){
        $valor = $this->getFechaPorIndice($indiceFecha);
        if($valor || !$valor != true || !$valor == ""){
            unset($this->indiceFechas[$indiceFecha]);
        }else{
            return false;
        }
    }

    private function setAgregarAnotacion($indiceAnotacion, $contenidoAnotacion){
        $valor = $this->getAnotacionesPorIndice($indiceAnotacion);
        if(!$valor || $valor != true || $valor == ""){
            $this->indiceAnotaciones[$indiceAnotacion] = $contenidoAnotacion;
        }else{
            return false;
        }
    }

    private function setEliminarAnotacion($indiceAnotacion){
        $valor = $this->getAnotacionesPorIndice($indiceAnotacion);
        if($valor || !$valor != true || !$valor == ""){
            unset($this->indiceAnotaciones[$indiceAnotacion]);
        }else{
            return false;
        }
    }

    private function agregarRegistro(){
        $this->guardarIndicesAString($this->getIndiceProcesoRealizado(), $this->getIndiceFechas(), $this->getIndiceAnotaciones());
        ActualizarRegistros::actualizarDatosEnBDO($this->idCiudadano, $this->stringProcesosRealizados, $this->stringFechas, $this->stringAnotaciones);
    }

    private function guardarIndicesAString($indiceProceso, $indiceFechas, $indiceAnotaciones){
        $indiceProcesoCadena = self::unirIndiceYValorDeArregloAsociativo($indiceProceso);
        $indiceFechas = self::unirIndiceYValorDeArregloAsociativo($indiceFechas);
        $indiceAnotaciones = self::unirIndiceYValorDeArregloAsociativo($indiceAnotaciones);
        $this->stringProcesosRealizados = $indiceProcesoCadena;
        $this->stringFechas = $indiceFechas;
        $this->stringAnotaciones = $indiceAnotaciones;
    }

    private static function unirIndiceYValorDeArregloAsociativo($arreglo){
        $longitud = (count($arreglo) * 2);
        $clavesIndice = self::getClavesArregloAsociativo($arreglo);
        $valoresIndice = self::getValoresArregloAsociativo($arreglo);

        $turnoDeClave = true;
        $j = 0;
        $k = 0;
        for($i = 0; $i < $longitud; $i++){
            $arrayResultado[] = $turnoDeClave ? $clavesIndice[$j++] : $valoresIndice[$k++];
            $turnoDeClave ^= true;
        }
        $arrayResultado = implode('|', $arrayResultado);
        return $arrayResultado;
    }

    private static function getClavesArregloAsociativo($arreglo){
        $arregloIndices = [];
        foreach($arreglo as $indice => $value){
            $arregloIndices[] = $indice;
        }
        return $arregloIndices;
    }

    private static function getValoresArregloAsociativo($arreglo){
        return array_values($arreglo);
    }

    // Funciones de manipulacion de objeto
    public function setAgregarElementoAListaCiudadano($indiceGeneral, $contenidoProceso, $contenidoFecha, $contenidoAnotacion){
        $this->setAgregarProcesoRealizado($indiceGeneral, $contenidoProceso);
        $this->setAgregarFecha($indiceGeneral, $contenidoFecha);
        $this->setAgregarAnotacion($indiceGeneral, $contenidoAnotacion);
        $this->agregarRegistro();
    }

    public function setEliminarElementoAListaCiudadano($indiceGeneral){
        $this->setEliminarProcesoRealizado($indiceGeneral);
        $this->setEliminarFecha($indiceGeneral);
        $this->setEliminarAnotacion($indiceGeneral);
        $this->agregarRegistro();
    }
}

class ActualizarRegistros{
    private static function getConexion(){
        try{
            $conexion = new PDO('mysql:host=127.0.0.1:3309;dbname=thetest', 'root', 'password');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET UTF8");
        }catch(Exception $e){
            echo "linea del error: " . $e->getLine();
            die("<br>Error" . $e->getMessage());
        }
        return $conexion;
    }

    // modificar textos de error
    public static function actualizarDatosEnBDO($idCiudadano, $indiceProcesoRealizado, $indiceFechas, $indiceAnotaciones){
        setlocale(LC_ALL, "es_ES");
        $fecha = date("d") . "/" . date("m") . "/" . date("Y");

        $consulta = "SELECT ID_CIUDADANO FROM lista_ciudadanos_proceso_programa WHERE ID_CIUDADANO = :idCiudadano;";
        $resultado = self::getConexion()->prepare($consulta);
        $resultado->bindValue(":idCiudadano", $idCiudadano);
        $resultado->execute();
        $registro = $resultado->rowCount();

        if ($registro != 0) {

            $consulta = "UPDATE LISTA_CIUDADANOS_PROCESO_PROGRAMA SET INDICE_PROCESO = :indiceProceso, INDICE_FECHAS = :indiceFechas, INDICE_ANOTACIONES = :indiceAnotaciones, ULTIMA_ACTUALIZACION = :fecha WHERE ID_CIUDADANO = :idCiudadano;";

            $resultado = self::getConexion()->prepare($consulta);
            $resultado->bindValue(":idCiudadano", $idCiudadano);
            $resultado->bindValue(":indiceProceso", $indiceProcesoRealizado);
            $resultado->bindValue(":indiceFechas", $indiceFechas);
            $resultado->bindValue(":indiceAnotaciones", $indiceAnotaciones);
            $resultado->bindValue(":fecha", $fecha);
            $resultado->execute();

            if(!$resultado){
                echo "<br>error al actualizar";
            }else{
                // ELIMINAR ESTE ELSE, SOLO ES INFORMATIVO TEMPORAL
                echo "<br>se actualizo correctamente";
            }
        } else {

            $consulta = "INSERT INTO LISTA_CIUDADANOS_PROCESO_PROGRAMA(ID_CIUDADANO, INDICE_PROCESO, INDICE_FECHAS, INDICE_ANOTACIONES, ULTIMA_ACTUALIZACION) VALUES (:idCiudadano, :indiceProceso, :indiceFecha, :indiceAnotacion, :fecha);";

            $resultado = self::getConexion()->prepare($consulta);
            $resultado->bindValue(":idCiudadano", $idCiudadano);
            $resultado->bindValue(":indiceProceso", $indiceProcesoRealizado);
            $resultado->bindValue(":indiceFecha", $indiceFechas);
            $resultado->bindValue(":indiceAnotacion", $indiceAnotaciones);
            $resultado->bindValue(":fecha", $fecha);
            $resultado->execute();

            if(!$resultado){
                echo "<br>error al insertar";
            }else{
                // ELIMINAR ESTE ELSE, SOLO ES INFORMATIVO TEMPORAL
                echo "<br>se inserto correctamente";
            }
        }
    }
}