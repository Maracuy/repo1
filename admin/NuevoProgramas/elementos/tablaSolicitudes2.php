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

// Paginación (Variables)
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

    include_once('../Externo/conexiones.php');

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
   // echo "Linea del error: " . $e->getLine();
   echo "Ocurrió un error al obtener la paginación (selector de página)";
}

?>

<!-- Tabla -->
<div class="ContenedorTablaGeneral">
    <!-- Corresponde a una fila de la tabla [Este es el titulo de las columnas]-->
    <div class="ContenedorFilasContenido elementoPrincipalTablaTitulo">
        <div class="ItemFilaC">
            Folio
        </div>
        <div class="ItemFilaC">
            Propiedades
        </div>
        <div class="ItemFilaC">
            Beneficiario
        </div>
        <div class="ItemFilaC">
            Solicitud
        </div>
        <div class="ItemFilaC">
            Departamento
        </div>
        <div class="ItemFilaC">
            Origen
        </div>
        <div class="ItemFilaC">
            Avance
        </div>
        <div class="ItemFilaC">
            Fecha/Hora
        </div>
    </div>

<?php
$servidorURLCorto = "inicioProgramas.php";

try{

    $resultado = conectarDBO::conexion()->prepare($consulta);
    $resultado->execute(array());

    while($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
        ?>
        <a href="<?=$servidorURLCorto?>?ids=<?=$registro["ID"]?>" class="etiquetaAFilasSES"> 
            <!-- Corresponde a una fila de la tabla -->
            <div class="ContenedorFilasContenido">
                <div class="ItemFilaC">
                    <?=$registro["ID_SOLICITUD"]?>
                </div>
                <div class="ItemFilaC">
                    <span class="itemTablaEstadoGeneralRIS <?php if($registro["NUEVO"]){echo "itemTablaEstadoGeneralRISNuevo";}?>">
                        n
                    </span>
                    <span class="itemTablaEstadoGeneralRIS <?php if($registro["PENDIENTE"]){echo "itemTablaEstadoGeneralRISPendiente";}?>">
                        p
                    </span>
                    <span class="itemTablaEstadoGeneralRIS <?php if($registro["URGENTE"]){echo "itemTablaEstadoGeneralRISUrgente";}?>">
                        u
                    </span>
                    <span class="itemTablaEstadoGeneralRIS <?php if($registro["VULNERABLE"]){echo "itemTablaEstadoGeneralRISVulnerable";}?>">
                        v
                    </span>
                </div>
                <div class="ItemFilaC">
                    <?=$registro["NOMBRE_BENEFICIARIO"]?>&#32; &#40;<?=$registro["CURP_BENEFICIARIO"]?>&#41;
                </div>
                <div class="ItemFilaC">
                    <?=$registro["SOLICITUD_NOMBRE"]?>
                </div>
                <div class="ItemFilaC">
                    <?=$registro["DEPARTAMENTO"]?>
                </div>
                <div class="ItemFilaC">
                    <?=$registro["ORIGEN"]?>
                </div>
                <div class="ItemFilaC">
                    <?=$registro["AVANCE_SOLICITUD"]?>&#37;
                </div>
                <div class="ItemFilaC">
                    <?=$registro["FECHA"]?>
                </div>
            </div>
        </a>
<?php
    }
    $resultado->closeCursor();
}catch(Exception $e){
   // echo "Linea del error: " . $e->getLine();
   echo "Error al consultar los datos";
}

?>
</div>

<!--    PAGINACION    -->
<?php

$link = 'inicioProgramas.php';
$extensionConsulta = '?';

if(isset($_GET['tc'])){

    $tc = filter_var($_GET['tc'], FILTER_SANITIZE_NUMBER_INT);
    $extensionConsulta .= 'tc=' . $tc;

    // REVISAR SI ESTA ASIGNADO UN FILTRO QUE MODIFIQUE URL
    if($tc == 2){
        // PRIMER FILTRO

        $dd = filter_var($_GET['dd'], FILTER_SANITIZE_NUMBER_INT);
        $mm = filter_var($_GET['mm'], FILTER_SANITIZE_NUMBER_INT);
        $aaaa = filter_var($_GET['aaaa'], FILTER_SANITIZE_NUMBER_INT);

        $adicion = '&dd=' . $dd . '&mm=' . $mm . '&aaaa=' . $aaaa;
        $extensionConsulta .= $adicion;

    }else if($tc == 1){
        // SEGUNDO FILTRO

        $di = filter_var($_GET['di'], FILTER_SANITIZE_NUMBER_INT);
        $mi = filter_var($_GET['mi'], FILTER_SANITIZE_NUMBER_INT);
        $ai = filter_var($_GET['ai'], FILTER_SANITIZE_NUMBER_INT);
        $df = filter_var($_GET['df'], FILTER_SANITIZE_NUMBER_INT);
        $mf = filter_var($_GET['mf'], FILTER_SANITIZE_NUMBER_INT);
        $af = filter_var($_GET['af'], FILTER_SANITIZE_NUMBER_INT);

        $adicion = '&di=' . $di . '&mi=' . $mi . '&ai=' . $ai . '&df=' . $df . '&mf=' . $mf . '&af=' . $af;
        $extensionConsulta .= $adicion;

    }


}else{
    $extensionConsulta .= 'tc=6';
}

$urlReconstruida = $link . $extensionConsulta;
$paginaDinamica = $paginaActual;

?>

<!-- Botones de la tabla -->
<div class="ContenedorDetallesTabla">
    <!-- Flecha direccional [Fijo] -->
    <?php
    // pagina anterior
    if($paginaActual > 1){
        echo "<a href=\"{$urlReconstruida}&page=". ($paginaDinamica - 1) ."\" class=\"etiquetaABotonesDinamicosSE\"><div class=\"ElementoIconoPaginaContenedor ElementoIconoPaginaContenedorFlecha\"><span>&#60;</span></div></a>";
    }else{
        //imprimir pagina deshabilitada
        echo "<div class=\"ElementoIconoPaginaContenedor ElementoIconoPaginaContenedorFlecha ElementoIconoPaginaContenedorFlechaDisabled\"><span>&#60;</span></div>";
    }
    ?>
    <!-- Numero Pagina [Dinamico] -->
    <div class="ElementoIconoPaginaContenedor ElementoIconoPaginaContenedorPaginadorContador">
        <span>
            <?=$paginaActual?>&#47;<?=$paginasTotales?>
        </span>
    </div>
    <!-- Flecha direccional [Fijo] -->
    <?php
    // pagina siguiente
    if($paginaActual < $paginasTotales){
        echo "<a href=\"{$urlReconstruida}&page=". ($paginaDinamica + 1) ."\" class=\"etiquetaABotonesDinamicosSE\"><div class=\"ElementoIconoPaginaContenedor ElementoIconoPaginaContenedorFlecha\"><span>&#62;</span></div></a>";
    }else{
        //imprimir pagina deshabilitada
        echo "<div class=\"ElementoIconoPaginaContenedor ElementoIconoPaginaContenedorFlecha ElementoIconoPaginaContenedorFlechaDisabled\"><span>&#62;</span></div>";
    }
    ?>
</div>