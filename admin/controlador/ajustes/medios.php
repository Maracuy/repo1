<?php
$sql_query_medio_contacto = $con->prepare("SELECT * FROM medio_contacto");
$sql_query_medio_contacto->execute();
$resultado_medio_contacto = $sql_query_medio_contacto->fetchALL();


?>


<div class="espaciadormio" style="height: 50px;"></div>

<div class="dropdown-divider"></div>

<div class="container-fluid bg-light">

    <h4>Medios registrados:</h4>
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
                foreach($resultado_medio_contacto as $dato_medio): ?>
                <tr>
                <th scope='row'><?php echo $dato_medio['id'] ?> </th>
                
                <td>  <?php echo $dato_medio['nombre']?></td>
                <td>  <?php echo $dato_medio['abreviatura']?> </td>
                <td> <?php echo $dato_medio['descripcion']?> </td>

                <input type="hidden" value="<?php echo $dato_medio['id']?>" name="id">
                <input type="hidden" value="medio_contacto" name="table_name">
                
                <td><button type="submit" class="btn btn-link" name="eliminar_icono"><i class="far fa-trash-alt"></i>  </button></td>
              
                
                </tr>
            
            <?php endforeach;?>
        </form>
    </tbody>
    </table>


    <div class="dropdown-divider"></div>


    <h4>Registrar Nuevo Medio</h4>



    <form method="post" action="controlador/ajustes/ajustes_mysql.php">
        <div class="form-row">

            <div class="form-group col-md-3">
                <label for="inputZip">Nombre</label>
                <input type="text" class="form-control" id="nombre_medio" name="nombre_medio">
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Abreviatura</label>
                <input type="text" class="form-control" id="abreviatura_medio" name="abreviatura_medio">
            </div>        
            <div class="form-group col-md-4">
                <label for="inputZip">Descripción</label>
                <input type="textarea" class="form-control" id="descripcion_medio" name="descripcion_medio">
            </div>
        </div>

        <button type="submit" value="Enviar este formulario" formmethod="POST" class="btn btn-primary" id="guardar_medio" name="guardar_medio">Registrar Nuevo Origen</button>
        
    </form>

</div>

<div class="dropdown-divider"></div>
