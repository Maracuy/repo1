<?php
// Desmarcar cuando se quiera realizar alguna prueba
// include_once('pruebas.php');

class ConexionBase{
    public static function getConexion(){
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
}

class CiudadanosLista{
    protected $idCiudadano;
    protected $idProceso;
    private $indiceProcesosRealizados = array();
    private $indiceFechasRealizadas = array();
    private $indiceAnotacionesRealizadas = array();
    private $stringProcesos = "";
    private $stringFechas = "";
    private $stringAnotaciones = "";
    private $stringProcesosDBO = "";
    private $stringFechasDBO = "";
    private $arrayProcesosDBO = array();
    private $arrayFechasDBO = array();

    public function __construct($idCiudadano, $idProceso){
        $this->idCiudadano = $idCiudadano;
        $this->idProceso = $idProceso;

        // Llamada a la base para iniciar datos
        $this->getDatosDBO($idCiudadano, $idProceso);

        // Llamar a la funcion que extrae procesos
        $this->getProcesosPrograma();

        // llamar a la funcion que guarda los datos en el objeto
        $this->setProcesosProgramasArray();

        // llamar a la funcion que revisa los procesos ya realizados
        $this->getRevisarProcesosCompletados();

    }

    // Obtener el id del objeto (Ciudadano)
    public function getIdCiudadano(){
        return $this->idCiudadano;
    }

    // [Validar indice de un arreglo asociativo] (Recibe indice, arreglo) {retorna verdadero o falso segun corresponda}
    public function existenciaIndiceEnArray($indice, $arreglo){
        return array_key_exists($indice, $arreglo) ? true : false;
    }

    // [Validar si una variable se encuentra vacia] (Recibe valor) {retorna verdadero o falso segun corresponda}
    public static function isEmpty($valor){
        return empty($valor) ? true : false;
    }

    // [Extraer claves de un arreglo asociativo] (Recibe arreglo) {retorna un arreglo con todas las claves}
    public static function getClavesDeArregloAsociativo($arreglo){
        $arregloResultando = array();
        foreach ($arreglo as $item => $value){
            $arregloResultando[] = $item;
        }
        return $arregloResultando;
    }

    // [Extraer valores de un arreglo asociativo] (Recibe arreglo) {retorna un arreglo con todos los valores}
    public static function getValoresDeArregloAsociativo($arreglo){
        $arregloResultando = array();
        foreach ($arreglo as $item => $value){
            $arregloResultando[] = $value;
        }
        return $arregloResultando;
    }
    
    // [Interpretacion, convertir de arreglo asociativo a string] (Recibe arreglo) {retorna una cadena convertida de un arreglo}
    public function arregloACadena($arreglo){
        if(!self::isEmpty($arreglo)){
            $longitud = (count($arreglo) * 2);
            $clavesIndice = self::getClavesDeArregloAsociativo($arreglo);
            $valoresIndice = self::getValoresDeArregloAsociativo($arreglo);
            $turnoDeClave = true;
            $j = 0;
            $k = 0;
            for($i = 0; $i < $longitud; $i++){
                $arrayResultado[] = $turnoDeClave ? $clavesIndice[$j++] : $valoresIndice[$k++];
                $turnoDeClave ^= true;
            }
            $arrayResultado = implode('|', $arrayResultado);
            return $arrayResultado;
        }else{
            return "";
        }
    }

    // [Interpretacion, convertir de string a arreglo asociativo] (Recibe cadena) {retorna un arreglo asociativo convertido de un string}
    public function cadenaAArreglo($cadena){
        if(!self::isEmpty($cadena)){
            $arreglo = explode("|", $cadena);
            $arregloAsociativo = array();
            $arregloLongitud = count($arreglo);
            for($i = 0; $i < $arregloLongitud; $i++){
                $arregloAsociativo += [$arreglo[$i] => $arreglo[++$i]];
            }
            return $arregloAsociativo;
        }else{
            return array();
        }
    }

    // [Agregar Registro] (recibe indice, nombreProceso, fechaCompletado, anotacion) {Agrega un elemento al arreglo de datos con un indice}
    public function setAddElemento($indice, $proceso, $fecha, $anotacion){
        $contadorPermisos = 0;
        if(!$this->existenciaIndiceEnArray($indice, $this->indiceProcesosRealizados)){
            $this->indiceProcesosRealizados[$indice] = $proceso;
            $contadorPermisos++;
        }
        if(!$this->existenciaIndiceEnArray($indice, $this->indiceFechasRealizadas)){
            $this->indiceFechasRealizadas[$indice] = $fecha;
            $contadorPermisos++;
        }
        if(!$this->existenciaIndiceEnArray($indice, $this->indiceAnotacionesRealizadas)){
            $this->indiceAnotacionesRealizadas[$indice] = $anotacion;
            $contadorPermisos++;
        }
        if(!$contadorPermisos != 3){
            $this->setUpdateBDO();
        }
    }

    // [Eliminar Registro] (recibe indice) {Elimina un elemento al arreglo de datos con un indice}
    public function setDeleteElemento($indice){
        $contadorPermisos = 0;
        if($this->existenciaIndiceEnArray($indice, $this->indiceProcesosRealizados)){
            unset($this->indiceProcesosRealizados[$indice]);
            $contadorPermisos++;
        }
        if($this->existenciaIndiceEnArray($indice, $this->indiceFechasRealizadas)){
            unset($this->indiceFechasRealizadas[$indice]);
            $contadorPermisos++;
        }
        if($this->existenciaIndiceEnArray($indice, $this->indiceAnotacionesRealizadas)){
            unset($this->indiceAnotacionesRealizadas[$indice]);
            $contadorPermisos++;
        }
        if(!$contadorPermisos != 3){
            $this->setUpdateBDO();
        }
    }

    // [Editar Registro] (recibe indice, nombreProceso, fechaCompletado, anotacion) {edita un elemento al arreglo de datos con un indice}
    public function setEditarElemento($indice, $proceso, $fecha, $anotacion){
        $contadorPermisos = 0;
        if($this->existenciaIndiceEnArray($indice, $this->indiceProcesosRealizados)){
            $this->indiceProcesosRealizados[$indice] = $proceso;
            $contadorPermisos++;
        }
        if($this->existenciaIndiceEnArray($indice, $this->indiceFechasRealizadas)){
            $this->indiceFechasRealizadas[$indice] = $fecha;
            $contadorPermisos++;
        }
        if($this->existenciaIndiceEnArray($indice, $this->indiceAnotacionesRealizadas)){
            $this->indiceAnotacionesRealizadas[$indice] = $anotacion;
            $contadorPermisos++;
        }
        if(!$contadorPermisos != 3){
            $this->setUpdateBDO();
        }
    }

    // [Busqueda por indice - proceso] (recibe indice) {retorna una cadena (proceso) con el valor del contenido segun el indice}
    public function getBusquedaProceso($indice){
        $existencia = $this->existenciaIndiceEnArray($indice, $this->indiceProcesosRealizados);
        return $existencia ? $this->indiceProcesosRealizados[$indice] : false;
    }

    // [Busqueda por indice - fecha] (recibe indice) {retorna una cadena (fecha) con el valor del contenido segun el indice}
    public function getBusquedaFecha($indice){
        $existencia = $this->existenciaIndiceEnArray($indice, $this->indiceFechasRealizadas);
        return $existencia ? $this->indiceFechasRealizadas[$indice] : false;
    }

    // [Busqueda por indice - Anotaciones] (recibe indice) {retorna una cadena (Anotaciones) con el valor del contenido segun el indice}
    public function getBusquedaAnotaciones($indice){
        $existencia = $this->existenciaIndiceEnArray($indice, $this->indiceAnotacionesRealizadas);
        return $existencia ? $this->indiceAnotacionesRealizadas[$indice] : false;
    }

    // [Busqueda por indice - procesos lista] (recibe indice) {retorna una cadena (proceso) con el valor del contenido segun el indice}
    public function getBusquedaProcesosLista($indice){
        $existencia = $this->existenciaIndiceEnArray($indice, $this->arrayProcesosDBO);
        return $existencia ? $this->arrayProcesosDBO[$indice] : false;
    }

    // [Busqueda por indice - fechas lista] (recibe indice) {retorna una cadena (fechas) con el valor del contenido segun el indice}
    public function getBusquedaFechasLista($indice){
        $existencia = $this->existenciaIndiceEnArray($indice, $this->arrayFechasDBO);
        return $existencia ? $this->arrayFechasDBO[$indice] : false;
    }

    // [Guardar arreglo en objeto como texto] (no recibe nada, es una funcion) {Guarda un arreglo en variables de texto para base de datos}
    public function setVariablesString(){
        $this->stringProcesos = $this->arregloACadena($this->indiceProcesosRealizados);
        $this->stringFechas = $this->arregloACadena($this->indiceFechasRealizadas);
        $this->stringAnotaciones = $this->arregloACadena($this->indiceAnotacionesRealizadas);
    }

    // [Extraer datos de la base e inciar variables] (recibe idCiudadano, idProceso) {consulta la base con los datos requeridos e inicializa variables}
    private function getDatosDBO($idCiudadano, $idProceso){
        setlocale(LC_ALL, "es_ES");
        $fecha = date("d") . "/" . date("m") . "/" . date("Y");
        $consulta31 = "SELECT ID_CIUDADANO FROM lista_ciudadanos_proceso_programa WHERE ID_CIUDADANO = :idCiudadano;";
        $resultado32 = ConexionBase::getConexion()->prepare($consulta31);
        $resultado32->bindValue(":idCiudadano", $idCiudadano);
        $resultado32->execute();
        $registro33 = $resultado32->rowCount();


        if ($registro33 != 0) {
            $consulta9 = "SELECT INDICE_PROCESO, INDICE_FECHAS, INDICE_ANOTACIONES FROM lista_ciudadanos_proceso_programa WHERE ID_CIUDADANO = :idCiudadano AND ID_PROCESO = :idProceso;";
            $resultado10 = ConexionBase::getConexion()->prepare($consulta9);
            $resultado10->bindValue(":idCiudadano", $idCiudadano);
            $resultado10->bindValue(":idProceso", $idProceso);
            $resultado10->execute();
            $resultado11 = $resultado10->fetch(PDO::FETCH_ASSOC);

            if(!$resultado11){
                echo "<br>error al consultar error, {$idCiudadano}, {$idProceso}<br>";

                
            }else{
                $this->indiceProcesosRealizados = $this->cadenaAArreglo($resultado11['INDICE_PROCESO']);
                $this->indiceFechasRealizadas = $this->cadenaAArreglo($resultado11['INDICE_FECHAS']);
                $this->indiceAnotacionesRealizadas = $this->cadenaAArreglo($resultado11['INDICE_ANOTACIONES']);
            }






        }else{
            $consulta25 = "INSERT INTO LISTA_CIUDADANOS_PROCESO_PROGRAMA(ID_CIUDADANO, ID_PROCESO, INDICE_PROCESO, INDICE_FECHAS, INDICE_ANOTACIONES, ULTIMA_ACTUALIZACION) VALUES (:idCiudadano, :idProceso, :indiceProceso, :indiceFecha, :indiceAnotacion, :fecha);";
            $resultado26 = ConexionBase::getConexion()->prepare($consulta25);
            $resultado26->bindValue(":idCiudadano", $idCiudadano);
            $resultado26->bindValue(":idProceso", $idProceso);
            $resultado26->bindValue(":indiceProceso", "");
            $resultado26->bindValue(":indiceFecha", "");
            $resultado26->bindValue(":indiceAnotacion", "");
            $resultado26->bindValue(":fecha", $fecha);
            $resultado26->execute();
            if(!$resultado26){
                echo "<br>error al insertar<br>";
            }else{
                $this->indiceProcesosRealizados = array();
                $this->indiceFechasRealizadas = array();
                $this->indiceAnotacionesRealizadas = array();
            }
        }
    }

    // [Actualizar datos a la base] (Debe ser llamado desde una funcion add, delete, update) {Actualiza registros en la base}
    private function setUpdateBDO(){
        setlocale(LC_ALL, "es_ES");
        $fecha = date("d") . "/" . date("m") . "/" . date("Y");
        $this->setVariablesString();
        $consulta = "UPDATE LISTA_CIUDADANOS_PROCESO_PROGRAMA SET INDICE_PROCESO = :indiceProceso, INDICE_FECHAS = :indiceFechas, INDICE_ANOTACIONES = :indiceAnotaciones, ULTIMA_ACTUALIZACION = :fecha WHERE ID_CIUDADANO = :idCiudadano;";
            $resultado = ConexionBase::getConexion()->prepare($consulta);
            $resultado->bindValue(":idCiudadano", $this->idCiudadano);
            $resultado->bindValue(":indiceProceso", $this->stringProcesos);
            $resultado->bindValue(":indiceFechas", $this->stringFechas);
            $resultado->bindValue(":indiceAnotaciones", $this->stringAnotaciones);
            $resultado->bindValue(":fecha", $fecha);
            $resultado->execute();
            if(!$resultado){
                echo "<br>error al actualizar<br>";
            }
    }

    // [Obtener procesos de los programas] (Debe ser llamado desde el constructor) {Consulta los procesos existentes y los guarda en texto}
    private function getProcesosPrograma(){
        $idProceso = $this->idProceso;
        $consulta6 = "SELECT PASOS, FECHAS FROM LISTA_PROCESOS WHERE ID_PROGRAMA = :idProceso";
        $resultado6 = ConexionBase::getConexion()->prepare($consulta6);
        $resultado6->bindValue(":idProceso", $this->idProceso);
        $resultado6->execute();
        $resultado7 = $resultado6->fetch(PDO::FETCH_ASSOC);

        if(!$resultado7){
            echo "<br>error al consultar obtener , {$idProceso}<br>";
        }else{
            $this->stringProcesosDBO = $resultado7['PASOS'];
            $this->stringFechasDBO = $resultado7['FECHAS'];
        }
    }

    // [Guardar datos de procesos programa] (Debe ser llamado desde el constructor) {convierte los datos obtenidos y los convierte en arreglo}
    private function setProcesosProgramasArray(){
        $this->arrayProcesosDBO = $this->cadenaAArreglo($this->stringProcesosDBO);
        $this->arrayFechasDBO = $this->cadenaAArreglo($this->stringFechasDBO);
    }

    // [Comparar datos obtenidos con disponibles] (Debe ser llamado desde el constructor) {Revisa cuales son los procesos ya realizados con las listas obtenida}
    protected function getRevisarProcesosCompletados(){

        $programasRealizados = $this->indiceProcesosRealizados;
        $listaProcesos = $this->arrayProcesosDBO;
        $programasRealizadosLista = array();
        $indiceHTML = 0;

        foreach ($programasRealizados as $item => $value){
            $programasRealizadosLista[] = $item;
        }

        foreach ($listaProcesos as $item => $value){
            $totalComparaciones = 0;
            $coincidencias = 0;

            foreach($programasRealizadosLista as $comparacion){
                ++$totalComparaciones;
                if($comparacion == $item){
                    $coincidencias--;
                }else{
                    $coincidencias++;
                }
            }
            $indiceHTML++;
            if($coincidencias != $totalComparaciones){
                // Se detecto que el programa esta completo
                echo "
                <tr>
                    <td>".$this->getBusquedaProcesosLista($item)."</td>
                    <td>".$this->getBusquedaFecha($item)."</td>
                    <td>".$this->getBusquedaFechasLista($item)."</td>
                    <td>Completado</td>
                    <td>".$this->getBusquedaAnotaciones($item)."<input id=\"btnCerrarModal3\" class=\"btn btnEditarCampo\" type=\"button\" value=\"Editar\" onclick=\"
                    crearCamposEditables3({$indiceHTML}, {$item});\"></td>
                    <td><input type=\"button\" value=\"Desmarcar\" onclick=\"crearCamposEditables2({$indiceHTML}, {$item});\" class=\"btn btn-danger\"></td>
                </tr>";
            }else{
                // No realizado aun
                echo "
                <tr>
                    <td>".$this->getBusquedaProcesosLista($item)."</td>
                    <td>-</td>
                    <td>".$this->getBusquedaFechasLista($item)."</td>
                    <td>Pendiente</td>
                    <td>Solo disponible al completar</td>
                    <td><input type=\"button\" value=\"Completar\" onclick=\"crearCamposEditables({$indiceHTML}, {$item});\" class=\"btn btn-success\"></td>
                </tr>";
            }
        }
    }
}