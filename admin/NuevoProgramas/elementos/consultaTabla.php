
<!-- Tabla -->
<div class="ContenedorTablaGeneral">
    <!-- Corresponde a una fila de la tabla [Este es el titulo de las columnas]-->
    <div class="ContenedorFilasContenido elementoPrincipalTablaTitulo">
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

<?php
$servidorURLCorto = $_SERVER['PHP_SELF'];
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

                    <!-- MODIFICAR FUNCIONES DE LOS ICONOS [SE REPRESENTAN EN TEXTO PLANO POR AHORA] -->
                    <!-- MODIFICAR FUNCIONES DE LOS ICONOS [SE REPRESENTAN EN TEXTO PLANO POR AHORA] -->
                    <!-- MODIFICAR FUNCIONES DE LOS ICONOS [SE REPRESENTAN EN TEXTO PLANO POR AHORA] -->

                    <?=$registro["ID"]?>
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
    echo "Linea del error: " . $e->getLine();
}
?>
</div>

<!--    PAGINACION    -->
<?php
if($paginaDefinida){
    $url= $_SERVER["REQUEST_URI"];
    $arrayURL = explode("&", $url);
    array_pop($arrayURL);
    $urlReconstruida = "";
    $itemNumero = 0;
    foreach($arrayURL as $value){
        if($itemNumero != 0){ 
            $urlReconstruida .= "&" . $value;   
        }else{
            $urlReconstruida .= $value;   
        }
        $itemNumero++;
    }
}else{
    $urlReconstruida = $_SERVER["REQUEST_URI"];
}
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