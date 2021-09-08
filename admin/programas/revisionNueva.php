<?php
if (isset($_GET["idpeticion"])) {
    $idPeticion = $_GET["idpeticion"];
    include_once('../conection/conexion.php');
    setlocale(LC_ALL, "es_ES");
    $fecha = date("d") . "/" . date("m") . "/" . date("Y");
    $estadoFolioFinal = "Resuelto";
    $consulta1698 = "UPDATE peticiones_programas SET ESTADO = :estadoFolio, FECHA_FINAL = :fechaFolio WHERE ID = :idFolio;";
    $resultado1698 = $con->prepare($consulta1698);
    $resultado1698->bindValue(":estadoFolio", $estadoFolioFinal);
    $resultado1698->bindValue(":fechaFolio", $fecha);
    $resultado1698->bindValue(":idFolio", $idPeticion);
    $resultado1698->execute();

    if(!$resultado1698){
        echo "<div class=\"modalFolioConsulta\"><div class=\"contenedorModalFolioConsulta\">No fue posible actualizar<div class=\"contenedorCerrarModalFolio\"><a href=\"{$_SERVER['PHP_SELF']}\" class=\"btn btn-danger\">Cerrar</a></div></div></div>";
    }else{
        echo "<div class=\"modalFolioConsulta\"><div class=\"contenedorModalFolioConsulta\">Se actualizaron los datos correctamente<div class=\"contenedorCerrarModalFolio\"><a href=\"{$_SERVER['PHP_SELF']}\" class=\"btn btn-success\">Cerrar</a></div></div></div>";
    }


}else{
    ?>
    <table>
    <tr>
        <td colspan="5">
            Lista de Peticiones
        </td>
    </tr>
    <tr>
        <th>Solicitante</th>
        <th>Peticion</th>
        <th>Destino</th>
        <th>Fecha petición</th>
        <th>Fecha completado</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    <tbody id="contenidoResultado">
    <?php
        include_once('../conection/conexion.php');
        $consulta100 = $con->query("SELECT * FROM peticiones_programas");
        while ($resultado085 = $consulta100->fetch(PDO::FETCH_ASSOC)) {
            $textoImpresion = "<tr><td>{$resultado085['NOMBRE_COMPLETO']}</td><td>{$resultado085['PETICION']}</td><td>{$resultado085['DESTINO']}</td><td>{$resultado085['FECHA_INICIO']}</td><td>{$resultado085['FECHA_FINAL']}</td><td>{$resultado085['ESTADO']}</td>";
            if($resultado085['ESTADO'] == "pendiente"){
                $textoImpresion .= " <td><a href=\"{$_SERVER['PHP_SELF']}?idpeticion={$resultado085['ID']}\">Completar</a>";
            }else{
                $textoImpresion .= "<td>Sin acciones disponibles</a>";
            }
            $textoImpresion .= "</tr>";
            echo $textoImpresion;
        }
    ?>
    </tbody>
</table>

<?php

}





?>