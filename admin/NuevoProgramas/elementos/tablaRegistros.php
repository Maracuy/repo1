<!-- Seccion de tabla con contenido [Hacer que los resultados se muestren cada cierto tiempo sin necesidad de actualizar]-->
<?php

// Verificar fecha (solo numeros) de GET
function verificarVariable($abr){
    if(isset($_GET[$abr])){
        return filter_var($_GET[$abr], FILTER_SANITIZE_NUMBER_INT);
    }else{
        return false;
    }
}

// Definicion de la consulta SQL que se realizara segun sea el caso
if(isset($_GET['tc'])){
    $tipoConsulta = filter_var($_GET['tc'], FILTER_SANITIZE_NUMBER_INT);

    switch($tipoConsulta){
        case 1: 
            // Tipo de consulta: Fecha desde Hasta [Filtro terminado]
            $variablesFechas = [verificarVariable('di'), verificarVariable('mi'), verificarVariable('ai'), verificarVariable('df'),  verificarVariable('mf'), verificarVariable('af')];
            $errores = 0;
            foreach ($variablesFechas as $valor) {
                (!$valor) ? $errores++ : $errores;
            }

            if($errores == 0){
                $fechaInicialArmada = $variablesFechas[2] . "-" . $variablesFechas[1] . "-" . $variablesFechas[0];
                $fechaFinalArmada = $variablesFechas[5] . "-" . $variablesFechas[4] . "-" . $variablesFechas[3];
                $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES WHERE FECHA BETWEEN '{$fechaInicialArmada} 00:00:00' AND '{$fechaFinalArmada} 23:59:00' ORDER BY ID DESC";
            }else{
                $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES ORDER BY ID DESC";
            }
            break;
        case 2: 
            // Tipo de consulta: Fecha desde [Filtro terminado]
            setlocale(LC_ALL, "es_ES");
            $fechaActual = date("Y") . "-" . date("m") . "-" . date("d");
            $variablesFechas = [verificarVariable('dd'), verificarVariable('mm'), verificarVariable('aaaa')];
            $errores = 0;
            foreach ($variablesFechas as $valor) {
                (!$valor) ? $errores++ : $errores;
            }

            if($errores == 0){
                $fechaArmada = $variablesFechas[2] . "-" . $variablesFechas[1] . "-" . $variablesFechas[0];
                $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES WHERE FECHA BETWEEN '{$fechaArmada} 00:00:00' AND '{$fechaActual} 23:59:00' ORDER BY ID DESC";
            }else{
                $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES ORDER BY ID DESC";
            }
            break;
        case 3: 
            // Tipo de consulta: Hoy
            $consulta = "SELECT * FROM REGISTRADOS_PROGRAMA WHERE YEAR(FECHA) = YEAR(CURRENT_DATE()) AND WEEK(FECHA) = WEEK(CURRENT_DATE()) AND DAY(FECHA) = DAY(CURRENT_DATE())";
            break;
        case 4: 
            // Tipo de consulta: Semanal
            $consulta = "SELECT * FROM REGISTRADOS_PROGRAMA WHERE YEAR(FECHA) = YEAR(CURRENT_DATE()) AND WEEK(FECHA) = WEEK(CURRENT_DATE())";
            break;
        case 5: 
            // Tipo de consulta: Mensual
            $consulta = "SELECT * FROM REGISTRADOS_PROGRAMA WHERE YEAR(FECHA) = YEAR(CURRENT_DATE()) AND MONTH(FECHA) = MONTH(CURRENT_DATE())";
            break;
        case 6: 
            // Tipo de consulta: Todos
            $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES ORDER BY ID DESC";
            break;
        case 7: 
            // Tipo de consulta: Urgentes
            $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES WHERE URGENTE = TRUE";
            break;
        case 8: 
            // Tipo de consulta: Nuevos
            $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES WHERE NUEVO = TRUE";
            break;
        case 9: 
            // Tipo de consulta: Pendientes
            $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES WHERE PENDIENTE = TRUE";
            break;
        case 10: 
            // Tipo de consulta: Vulnerables
            $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES WHERE VULNERABLE = TRUE";
            break;
    }
}else{
    $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES ORDER BY ID DESC";
}

try{

    // Variables
    $registrosPorPagina = 4;
    $paginaActual = 0;
    $paginaDefinida = false;

    // Definiendo la pagina actual
    if(isset($_GET['page'])){
        $paginaDefinida = true;
        $valorPagina = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);
        (is_numeric($valorPagina)) ? $paginaActual = $valorPagina : $paginaActual = 1;
        ($paginaActual <= 0) ? $paginaActual = 1 : $paginaActual;
    }else{
        $paginaActual = 1;
    }

    $resultado = conectarDBO::conexion()->prepare($consulta);
    $resultado->execute(array());
    $numeroRegistros = $resultado->rowCount();
   // echo "<br>Registros: {$numeroRegistros}";
    $resultado->closeCursor();


    $paginasTotales = ceil($numeroRegistros / $registrosPorPagina);
   // echo "<br>Registros por pagina: {$registrosPorPagina}";
   // echo "<br>PaginasTotales: {$paginasTotales}";


    ($paginaActual > $paginasTotales) ? $paginaActual = $paginasTotales : $paginaActual;


    // linea que define desde donde se iniciara la paginacion (un mal trato podria causar errores)
    if($paginaActual <= 0){
        $empezarDesde = 0;
    }else{
        $empezarDesde = ($paginaActual - 1) * $registrosPorPagina;
    }

    // Generacion de nueva consulta para importar a la tabla
    $consulta = $consulta . " LIMIT " . $empezarDesde . ", " . $registrosPorPagina . ";";





}catch(Exception $e){
    echo "Linea del error: " . $e->getLine();
}

// archivo que incluye la consulta a la base de datos y formacion de tabla
include ('consultaTabla.php');

?>