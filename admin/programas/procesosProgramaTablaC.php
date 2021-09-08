<?php
include_once('../conection/conexion.php');

if (isset($_GET["curpCiudadano"])) {







?>













    <table>
        <tr>
            <td colspan="6">
                Lista de procesos
            </td>
        </tr>
        <tr>
            <th>Descripcion</th>
            <th>Fecha Realizado</th>
            <th>Fecha Limite</th>
            <th>Estado</th>
            <th>Anotación</th>
            <th>Acciones</th>
        </tr>
        <tbody id="contenidoResultado">

            <!-- Mover codigo php a un archivo externo e incluirlo -->
            <?php
            
            include_once('../conection/conexion.php');
            // variables "temporales", deberian ser definidas dinamicamente
          //   $varCiudadano = $_GET["curpCiudadano"];
          //   $obtenerPrograma = $_GET["idprogramarevision"];
            // variables "temporales", deberian ser definidas dinamicamente
           $varCiudadano = 3;
            $varProceso = 1;
            /*
                $sql = "SELECT ID_PROCESO FROM lista_procesos WHERE ID_PROGRAMA = :idProgramaProcesos;";
                $resultado = $con->prepare($sql);
                $resultado->bindValue(":idProgramaProcesos", $obtenerPrograma);
                $resultado->execute();
                $resultado2 = $resultado->fetch(PDO::FETCH_ASSOC);
                $varProceso = $resultado2['ID_PROCESO'];
    
*/

            // Resto del programa
            include_once "programas/objetos.php";

            if (isset($_POST['btnCompletarRegistro'])) {
                $accion = htmlentities(addslashes($_GET["agregar"]));
                switch ($accion) {
                    case 1:
                        $proceso = htmlentities(addslashes($_GET["procesor"]));
                        $descripcion = htmlentities(addslashes($_POST["inputDescripcion"]));
                        $fecha = htmlentities(addslashes($_POST["inputFecha"]));
                        $nota = htmlentities(addslashes($_POST["inputNota"]));
                        $objeto = new CiudadanosLista($varCiudadano, $varProceso);
                        $objeto->setAddElemento($proceso, $descripcion, $fecha, $nota);
                        /*
                            Agregar redireccion
                            */
                        break;
                    case 2:
                        $proceso = htmlentities(addslashes($_GET["procesor"]));
                        $objeto = new CiudadanosLista($varCiudadano, $varProceso);
                        $objeto->setDeleteElemento($proceso);
                        /*
                            Agregar redireccion
                            */
                        break;
                    case 3:
                        $proceso = htmlentities(addslashes($_GET["procesor"]));
                        $descripcion = htmlentities(addslashes($_POST["inputDescripcion3"]));
                        $fecha = htmlentities(addslashes($_POST["inputFecha3"]));
                        $nota = htmlentities(addslashes($_POST["inputNota3"]));
                        $objeto = new CiudadanosLista($varCiudadano, $varProceso);
                        $objeto->setEditarElemento($proceso, $descripcion, $fecha, $nota);
                        /*
                            Agregar redireccion
                            */
                        break;
                }
            } else {
                $objeto = new CiudadanosLista($varCiudadano, $varProceso);
            }
            ?>
        </tbody>

    </table>

    <!-- Redireccion manual [Utilizada despues de una accion por ulr] (se eliminara cuando se redireccione dinamicamente) -->
    <div style="width:100%;padding:50px 0;display: flex;align-items: center;justify-content: center;">
        <p>Click aqui despues de realizar una accion para limpiar url (temporal) ----</p>
        <a href="procesosPrograma.php" class="btn btn-success">
            Redireccion Manual
        </a>





    </div>

    <script>
        var ruta2 = location.href;
        console.log(ruta2);
    </script>











<?php
































} else {
    if (isset($_GET["idprogramarevision"])) {
        $programa = htmlentities(addslashes($_GET["idprogramarevision"]));
        $sql51 = "SELECT ID_CIUDADANO_REGISTRADO FROM programas_registro WHERE ID_PROGRAMA_REGISTRADO = :programaRegistrado";
        $resultado52 = $con->prepare($sql51);
        $resultado52->bindValue(":programaRegistrado", $programa);
        $resultado52->execute();
        echo "<div class=\"contenedorBotonesMenuAcciones\"><div class=\"contenedorMenuAcciones\"><div class=\"contenedorMenuFichaTitulo\"><span>Seleccione el ciudadano</span></div><div class=\"contenedorMenuFichaDescripcion\">";
        while ($resultado3 = $resultado52->fetch(PDO::FETCH_ASSOC)) {
            $sql2 = "SELECT curp from ciudadanos where id_ciudadano = :idCiudadanoCurp";
            $resultado2 = $con->prepare($sql2);
            $resultado2->bindValue(":idCiudadanoCurp",  $resultado3['ID_CIUDADANO_REGISTRADO']);
            $resultado2->execute();
            $resultado2 = $resultado2->fetch(PDO::FETCH_ASSOC);
            echo "<a href=\"procesosPrograma.php?idprogramarevision={$programa}&curpCiudadano={$resultado3['ID_CIUDADANO_REGISTRADO']}\" class=\"linkSinEstilosNuevo\"><div class=\"contenedorTextoDescripcionFichas\"><p>{$resultado2['curp']}</p></div></a>";
        }
        echo "<div class=\"contenedorTextoDescripcionFichas contenedorBotonDeFichas\"><a href=\"procesosPrograma.php\" class=\"btn btn-danger\">Regresar</a></div></div></div></div>";
    } else {
        echo "<div class=\"contenedorBotonesMenuAcciones\"><div class=\"contenedorMenuAcciones\"><div class=\"contenedorMenuFichaTitulo\"><span>Seleccione el programa</span></div><div class=\"contenedorMenuFichaDescripcion\">";
        $consulta = $con->query("SELECT ID_PROGRAMA, NOMBRE_PROGRAMA FROM PROGRAMAS_BASE");
        while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "<a href=\"procesosPrograma.php?idprogramarevision={$resultado['ID_PROGRAMA']}\" class=\"linkSinEstilosNuevo\"><div class=\"contenedorTextoDescripcionFichas\"><p>{$resultado['NOMBRE_PROGRAMA']}</p></div></a>";
        }
        echo "</div></div></div>";
    }
}

?>