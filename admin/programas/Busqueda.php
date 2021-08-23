<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</head>

<body>

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
            // variables "temporales", deberian ser definidas dinamicamente
            $varCiudadano = 4;
            $varProceso = 13;
            
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
                        $objeto = new CiudadanosLista($varCiudadano , $varProceso);
                        $objeto->setAddElemento($proceso, $descripcion, $fecha, $nota);
                        /*
                        Agregar redireccion
                        */
                        break;
                    case 2:
                        $proceso = htmlentities(addslashes($_GET["procesor"]));
                        $objeto = new CiudadanosLista($varCiudadano , $varProceso);
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
                        $objeto = new CiudadanosLista($varCiudadano , $varProceso);
                        $objeto->setEditarElemento($proceso, $descripcion, $fecha, $nota);
                        /*
                        Agregar redireccion
                        */
                        break;
                }
            } else {
                $objeto = new CiudadanosLista($varCiudadano , $varProceso);
            }
            ?>
        </tbody>
        
    </table>

    <!-- Redireccion manual [Utilizada despues de una accion por ulr] (se eliminara cuando se redireccione dinamicamente) -->
    <div style="width:100%;padding:50px 0;display: flex;align-items: center;justify-content: center;">
            <p>Click aqui despues de realizar una accion para limpiar url (temporal) ----</p>
        <a href="registro_programas.php" class="btn btn-success">
            Redireccion Manual
        </a>
    </div>

    
</body>

</html>