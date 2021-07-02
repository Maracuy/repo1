<?php
$sql_query_promotores = $con->prepare("SELECT * FROM promotores");
$sql_query_promotores->execute();
$resultado_promotores = $sql_query_promotores->fetchALL();


?>


<div class="espaciadormio" style="height: 50px;"></div>

<div class="dropdown-divider"></div>

<div class="container-fluid bg-light">

    <h4>Promotores registrados:</h4>
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
                foreach($resultado_promotores as $resultado_promotores): ?>
                <tr>
                <th scope='row'><?php echo $resultado_promotores['id'] ?> </th>
                
                <td>  <?php echo $resultado_promotores['nombre']?></td>
                <td>  <?php echo $resultado_promotores['abreviatura']?> </td>
                <td> <?php echo $resultado_promotores['descripcion']?> </td>

                <input type="hidden" value="<?php echo $resultado_promotores['id']?>" name="id">
                <input type="hidden" value="promotores" name="table_name">
                
                <td><button type="submit" class="btn btn-link" name="eliminar_icono"><i class="far fa-trash-alt"></i>  </button></td>
              
                
                </tr>
            
            <?php endforeach;?>
        </form>
    </tbody>
    </table>


    <div class="dropdown-divider"></div>


    <h4>Registrar Promotor</h4>



    <form method="post" action="controlador/ajustes/ajustes_mysql.php">
        <div class="form-row">

            <div class="form-group col-md-3">
                <label for="nombre_promotor">Nombre</label>
                <input type="text" class="form-control" id="nombre_promotor" name="nombre_promotor">
            </div>
            <div class="form-group col-md-2">
                <label for="abreviatura_promotor">Abreviatura</label>
                <input type="text" class="form-control" id="abreviatura_promotor" name="abreviatura_promotor">
            </div>        
            <div class="form-group col-md-4">
                <label for="descripcion_promotor">Descripción</label>
                <input type="textarea" class="form-control" id="descripcion_promotor" name="descripcion_promotor">
            </div>
        </div>

        <button type="submit" value="Enviar este formulario" formmethod="POST" class="btn btn-primary" id="guardar_promotor" name="guardar_promotor">Registrar Nuevo Promotor</button>
        
    </form>

</div>

<div class="dropdown-divider"></div>
