<!-- Seccion de tabla con contenido [Hacer tabla y agregar paginacion]-->



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
                $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES WHERE FECHA BETWEEN '{$fechaInicialArmada} 00:00:00' AND '{$fechaFinalArmada} 23:59:00' ORDER BY ID DESC;";
            }else{
                $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES ORDER BY ID DESC;";
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
                $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES WHERE FECHA BETWEEN '{$fechaArmada} 00:00:00' AND '{$fechaActual} 23:59:00' ORDER BY ID DESC;";
            }else{
                $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES ORDER BY ID DESC;";
            }
            break;
        case 3: 
            // Tipo de consulta: Hoy
            $consulta = "SELECT * FROM REGISTRADOS_PROGRAMA WHERE YEAR(FECHA) = YEAR(CURRENT_DATE()) AND WEEK(FECHA) = WEEK(CURRENT_DATE()) AND DAY(FECHA) = DAY(CURRENT_DATE());";
            break;
        case 4: 
            // Tipo de consulta: Semanal
            $consulta = "SELECT * FROM REGISTRADOS_PROGRAMA WHERE YEAR(FECHA) = YEAR(CURRENT_DATE()) AND WEEK(FECHA) = WEEK(CURRENT_DATE());";
            break;
        case 5: 
            // Tipo de consulta: Mensual
            $consulta = "SELECT * FROM REGISTRADOS_PROGRAMA WHERE YEAR(FECHA) = YEAR(CURRENT_DATE()) AND MONTH(FECHA) = MONTH(CURRENT_DATE());";
            break;
        case 6: 
            // Tipo de consulta: Todos
            $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES ORDER BY ID DESC;";
            break;
        case 7: 
            // Tipo de consulta: Urgentes
            $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES WHERE URGENTE = TRUE;";
            break;
        case 8: 
            // Tipo de consulta: Nuevos
            $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES WHERE NUEVO = TRUE;";
            break;
        case 9: 
            // Tipo de consulta: Pendientes
            $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES WHERE PENDIENTE = TRUE;";
            break;
        case 10: 
            // Tipo de consulta: Vulnerables
            $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES WHERE VULNERABLE = TRUE;";
            break;
    }
}else{
    $consulta = "SELECT * FROM INFORMACION_BASICA_SOLICITUDES ORDER BY ID DESC;";
}

// Mostrar consulta ([Cuidado] solo visual, por y para referencias)
echo "consulta: {$consulta}";














?>













<!-- Tabla -->
<div class="ContenedorTablaGeneral">

    <!-- Corresponde a una fila de la tabla [Este es el titulo de las columnas]-->
    <div class="ContenedorFilasContenido">
        <div class="ItemFilaC">
            ID
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

    <!-- Corresponde a una fila de la tabla -->
    <div class="ContenedorFilasContenido">
        <div class="ItemFilaC">
            551d8b
        </div>
        <div class="ItemFilaC">
            {iconos}
        </div>
        <div class="ItemFilaC">
            Nombre (CURP)
        </div>
        <div class="ItemFilaC">
            Solicitud-Ejemplo
        </div>
        <div class="ItemFilaC">
            Departamento Inicial
        </div>
        <div class="ItemFilaC">
            Origen e
        </div>
        <div class="ItemFilaC">
            10%
        </div>
        <div class="ItemFilaC">
            dd/mm/aaaa
        </div>
    </div>

    <!-- Corresponde a una fila de la tabla -->
    <div class="ContenedorFilasContenido">
        <div class="ItemFilaC">
            551d8b
        </div>
        <div class="ItemFilaC">
            {iconos}
        </div>
        <div class="ItemFilaC">
            Nombre (CURP)
        </div>
        <div class="ItemFilaC">
            Solicitud-Ejemplo
        </div>
        <div class="ItemFilaC">
            Departamento Inicial
        </div>
        <div class="ItemFilaC">
            Origen e
        </div>
        <div class="ItemFilaC">
            10%
        </div>
        <div class="ItemFilaC">
            dd/mm/aaaa
        </div>
    </div>


</div>

<!-- Botones de la tabla -->
<div class="ContenedorDetallesTabla">
    <!-- Flecha direccional [Fijo] -->
    <div class="ElementoIconoPaginaContenedor ElementoIconoPaginaContenedorFlecha">
        <span>
            &#60;
        </span>
    </div>

    <!-- Numero Pagina [Dinamico]-->
    <div class="ElementoIconoPaginaContenedor">
        <span>
            N
        </span>
    </div>

    <!-- Flecha direccional [Fijo] -->
    <div class="ElementoIconoPaginaContenedor ElementoIconoPaginaContenedorFlecha">
        <span>
            &#62;
        </span>
    </div>
</div>