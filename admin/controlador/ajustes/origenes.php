<?php
$tabla_name = "origenes"; 
$sql_query = $con->prepare("SELECT * FROM origenes");
$sql_query->execute();
$resultado_origenes = $sql_query->fetchALL();
?>

<div class="dropdown-divider"></div>

<div class="container-fluid bg-light">

    <h4>Origenes registrados:</h4>
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Abreviatura</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Eliminar</th>

        </tr>
    </thead>
    <form method="POST" action="controlador/ajustes/ajustes_mysql.php">
        <tbody>
            <?php
                foreach($resultado_origenes as $dato_origenes): ?>
                <tr>
                <th scope='row'><?php echo $dato_origenes['id'] ?> </th>
                
                <td>  <?php echo $dato_origenes['nombre']?></td>
                <td>  <?php echo $dato_origenes['abreviatura']?> </td>
                <td> <?php echo $dato_origenes['descripcion']?> </td>

                <input type="hidden" value="<?php echo $dato_origenes['id']?>" name="id">
                <input type="hidden" value="origenes" name="table_name">
                
                <td><button type="submit" class="btn btn-link" name="eliminar_icono"><i class="far fa-trash-alt"></i>  </button></td>
              
                
                </tr>
            
            <?php endforeach;?>
        </form>
    </tbody>
    </table>


    <div class="dropdown-divider"></div>


    <h4>Registrar Nuevo Origen</h4>



    <form method="post" action="controlador/ajustes/ajustes_mysql.php">
        <div class="form-row">

            <div class="form-group col-md-3">
                <label for="nombre_origen">Nombre</label>
                <input type="text" class="form-control" id="nombre_origen" name="nombre_origen">
            </div>
            <div class="form-group col-md-2">
                <label for="abreviatura_origen">Abreviatura</label>
                <input type="text" class="form-control" id="abreviatura_origen" name="abreviatura_origen">
            </div>
            <div class="form-group col-md-4">
                <label for="descripcion_origen">Descripción</label>
                <input type="textarea" class="form-control" id="descripcion_origen" name="descripcion_origen">
            </div>
        </div>

            <button type="submit" value="Enviar este formulario" formmethod="POST" class="btn btn-primary" id="guardar_origen" name="guardar_origen">Registrar Nuevo Origen</button>
        
    </form>

</div>

<div class="dropdown-divider"></div>



                