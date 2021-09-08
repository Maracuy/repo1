<?php

if (isset($_POST["botonEnviarPeticion"])) {

    include_once('../conection/conexion.php');

    $peticion = $_POST['peticionnombrepeticion'];
    $destino = $_POST['peticionnombredestino'];
    $folio = $_POST['peticionnombrefolio'];
    $prioridad = $_POST['peticionnombreprioridad'];
    $estado = "pendiente";
    $fechaFinal = "pendiente";
    setlocale(LC_ALL, "es_ES");
    $fecha = date("d") . "/" . date("m") . "/" . date("Y");

    $consulta100= "INSERT INTO peticiones_programas(NOMBRE_COMPLETO, PETICION, FOLIO, PRIORIDAD, DESTINO, ESTADO, FECHA_INICIO, FECHA_FINAL) VALUES (:nombre, :peticion, :folio, :prioridad, :destino, :estado, :fechainicio, :fechafinal);";
    $resultado200 = $con->prepare($consulta100);
    $resultado200->bindValue(":nombre", $_SESSION['user']['curp']);
    $resultado200->bindValue(":peticion", $peticion);
    $resultado200->bindValue(":folio", $folio);
    $resultado200->bindValue(":prioridad", $prioridad);
    $resultado200->bindValue(":destino", $destino);
    $resultado200->bindValue(":estado", $estado);
    $resultado200->bindValue(":fechainicio", $fecha);
    $resultado200->bindValue(":fechafinal", $fechaFinal);
    $resultado200->execute();

    if($resultado200){
        echo "<div class=\"modalFolioConsulta\"><div class=\"contenedorModalFolioConsulta\">Petición enviada, su folio es: {$folio}, asegurese de guardarlo bien<div class=\"contenedorCerrarModalFolio\"><a href=\"solicitudIndex.php\" class=\"btn btn-danger\">Cerrar</a></div></div></div>";
    }else{
        echo "error al ejecutar la consulta";
    }
}


if (isset($_POST["busquedafolioboton"])) {
    $folio = $_POST['busquedafoliocampo'];
    $consulta2 = "SELECT NOMBRE_COMPLETO, ESTADO, FECHA_INICIO, FECHA_FINAL FROM peticiones_programas WHERE FOLIO = :folioCaptura;";
    $resultado5 = $con->prepare($consulta2);
    $resultado5->bindValue(":folioCaptura", $folio);
    $resultado5->execute();
    $registrosNo = $resultado5->rowCount();
    $idCiudadanoRegistro = $resultado5->fetch(PDO::FETCH_ASSOC);
    if($registrosNo != 0){
        echo "<div class=\"modalFolioConsulta\"><div class=\"contenedorModalFolioConsulta\">Ciudadano (CURP): {$idCiudadanoRegistro['NOMBRE_COMPLETO']}. Estado de la petición: {$idCiudadanoRegistro['ESTADO']}. Fecha de envio: {$idCiudadanoRegistro['FECHA_INICIO']}. Fecha de respuesta {$idCiudadanoRegistro['FECHA_FINAL']}<div class=\"contenedorCerrarModalFolio\"><a href=\"solicitudIndex.php\" class=\"btn btn-danger\">Cerrar</a></div></div></div>";
    }else{
        echo "<div class=\"modalFolioConsulta\"><div class=\"contenedorModalFolioConsulta\">No se encontraron resultados para el folio: {$folio}<div class=\"contenedorCerrarModalFolio\"><a href=\"solicitudIndex.php\" class=\"btn btn-danger\">Cerrar</a></div></div></div>";
    }

}
if (isset($_GET["opcion"])) {
    $opcionClickeada = htmlentities(addslashes($_GET["opcion"]));
    switch ($opcionClickeada) {
        case 1:
?>
        <div class="contenedor2FormularioNuevaPeticion">
            <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
                <div class="contenedor2FichaSeleccion">
                        <div class="contenedor2FichasTextos titluloFichas2">
                            <p>
                                Ingrese el folio
                            </p>
                        </div>
                        <div class="contenedor2FichasTextos contenedor3FichasTexto">
                            <div class="contenedor3FichasCampo">
                                <input type="text" class="contenedor3fichasInput" name="busquedafoliocampo">
                            </div>
                        </div>
                        <div class="contenedor2FichasTextos contenedor3FichasTexto">
                            <div class="contenedor3FichasCampo">
                                <input type="submit" name="busquedafolioboton" class="btn btn-success" value="Enviar">
                            </div>
                        </div>
                </div>
            </form>
        </div>
<?php
            break;
        case 2:
?>
<script>
    function agregarFolio(){
        let campo = document.getElementById('campoFolio3');
        campo.value = Math.random().toString(36).substr(2, 5);
        return true;
    }
</script>
            <div class="contenedor2FormularioNuevaPeticion">
                <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST" onsubmit="return agregarFolio();">
                    <div class="contenedor2FichaSeleccion">
                        <div class="contenedor2FichasTextos titluloFichas2">
                            <p>
                                Completar información
                            </p>
                        </div>
                        <div class="contenedor2FichasTextos contenedor3FichasTexto">
                            <div class="contenedor3FichasCampo">
                                <label class="contenedor3fichasLabel">
                                    Destino
                                </label>
                            </div>
                            <div class="contenedor3FichasCampo">
                                <input type="text" class="contenedor3fichasInput" name="peticionnombredestino">
                            </div>
                        </div>
                        <div class="contenedor2FichasTextos contenedor3FichasTexto">
                            <div class="contenedor3FichasCampo">
                                <label class="contenedor3fichasLabel">
                                    Peticion detallada
                                </label>
                            </div>
                            <div class="contenedor3FichasCampo">
                                <input type="text" class="contenedor3fichasInput" name="peticionnombrepeticion">
                            </div>
                        </div>
                        <div class="contenedor2FichasTextos contenedor3FichasTexto">
                            <div class="contenedor3FichasCampo">
                                <label class="contenedor3fichasLabel">
                                    Prioridad
                                </label>
                            </div>
                            <div class="contenedor3FichasCampo">
                               <!-- <input type="text" class="contenedor3fichasInput">-->
                                <select class="contenedor3fichasInput" name="peticionnombreprioridad">
                                    <option value="baja" selected>Baja</option>
                                    <option value="alta">Alta</option>
                                </select>
                            </div>
                        </div>
                            <input type="text" class="contenedor3fichasInput folioEscondido" name="peticionnombrefolio" id="campoFolio3">
                        <div class="contenedor2FichasTextos contenedor3FichasTexto">
                            <div class="contenedor3FichasCampo">
                                <input type="submit" name="botonEnviarPeticion" class="btn btn-success" value="Enviar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
<?php
            break;
    }
} else {
    echo "<div class=\"contenedorGeneral2FichaSeleccion\"><div class=\"contenedor2FichaSeleccion\"><div class=\"contenedor2FichasTextos titluloFichas2\"><p>Seleccione una acción</p></div><a href=\"solicitudIndex.php?opcion=1\" class=\"contenedor2Estilos2\"><div class=\"contenedor2FichasTextos\"><p>Revisar una petición</p></div></a><a href=\"solicitudIndex.php?opcion=2\" class=\"contenedor2Estilos2\"><div class=\"contenedor2FichasTextos\"><p>Enviar nueva petición</p></div></a></div></div>";
}

?>