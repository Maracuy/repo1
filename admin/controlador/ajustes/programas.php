<?php
$sql_programas_federales = $con->prepare("SELECT * FROM programas_federales WHERE id_programa_federal != 1");
$sql_programas_federales->execute();
$programas_federales = $sql_programas_federales->fetchALL();


$sql_programas_estatales = $con->prepare("SELECT * FROM programas_estatales WHERE id_programa_estatal != 1");
$sql_programas_estatales->execute();
$programas_estatales = $sql_programas_estatales->fetchALL();


$sql_programas_municipales = $con->prepare("SELECT * FROM programas_municipales WHERE id_programa_municipal != 1");
$sql_programas_municipales->execute();
$programas_municipales = $sql_programas_municipales->fetchALL();

?>

<div class="dropdown-divider"></div>
<div class="espaciadormio" style="height: 50px;"></div>

<h3>Programas existentes:</h3>
<div class="espaciadormio" style="height: 50px;"></div>

<div class="container-fluid bg-light">


    <h4>Programas federales</h4>
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Abreviatura</th>
        <th scope="col">Descripción</th>
        <th scope="col">Eliminar</th>

        </tr>
    </thead>
    <form method="POST" action="controlador/ajustes/ajustes_mysql.php">
        <tbody>
            <?php
                foreach($programas_federales as $federal): ?>
                <tr>                
                    <td>  <?php echo $federal['nombre']?></td>
                    <td>  <?php echo $federal['abreviatura']?> </td>
                    <td> <?php echo $federal['descripcion']?> </td>
                <td><a href="controlador/ajustes/ajustes_mysql.php?id_programa_federal=<?php echo $federal['id_programa_federal'] ?>"> <i class="far fa-trash-alt ml-3"></i></a></td>
                </tr>
            
            <?php endforeach;?>
        </form>
    </tbody>
    </table>


    <div class="dropdown-divider"></div>

    <div class="espaciadormio" style="height: 50px;"></div>

    <h4>Registrar Nuevo Programa Federal</h4>



    <form method="post" action="controlador/ajustes/ajustes_mysql.php">
        <div class="form-row">

            <div class="form-group col-md-3">
                <label for="nombre_programa">Nombre de Programa</label>
                <input type="text" class="form-control" id="nombre_programa" name="nombre_programa">
            </div>
            <div class="form-group col-md-2">
                <label for="abreviatura_programa">Abreviatura</label>
                <input type="text" class="form-control" id="abreviatura_programa" name="abreviatura_programa">
            </div>
            <div class="form-group col-md-4">
                <label for="descripcion_programa">Descripción</label>
                <input type="textarea" class="form-control" id="descripcion_programa" name="descripcion_programa">
            </div>
        </div>
            <button type="submit" value="Enviar este formulario" formmethod="POST" class="btn btn-primary" id="guardar_programa_federal" name="guardar_programa_federal">Registrar Programa Federal</button>
    </form>
</div>

<div class="dropdown-divider"></div>

<div class="espaciadormio" style="height: 50px;"></div>


                

<div class="container-fluid bg-light">

<h4>Programas Estatales</h4>
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Abreviatura</th>
        <th scope="col">Descripción</th>
        <th scope="col">Eliminar</th>

        </tr>
    </thead>
    <form method="POST" action="controlador/ajustes/ajustes_mysql.php">
        <tbody>
            <?php
                foreach($programas_estatales as $estatal): ?>
                <tr>                
                    <td>  <?php echo $estatal['nombre']?></td>
                    <td>  <?php echo $estatal['abreviatura']?> </td>
                    <td> <?php echo $estatal['descripcion']?> </td>
                <td><a href="controlador/ajustes/ajustes_mysql.php?id_programa_estatal=<?php echo $estatal['id_programa_estatal'] ?>"> <i class="far fa-trash-alt ml-3"></i></a></td>
                </tr>
            
            <?php endforeach;?>
        </form>
    </tbody>
    </table>


    <div class="dropdown-divider"></div>

    <div class="espaciadormio" style="height: 50px;"></div>

    <h4>Registrar Nuevo Programa Estatal</h4>



    <form method="post" action="controlador/ajustes/ajustes_mysql.php">
        <div class="form-row">

            <div class="form-group col-md-3">
                <label for="nombre_programa">Nombre de Programa</label>
                <input type="text" class="form-control" id="nombre_programa" name="nombre_programa">
            </div>
            <div class="form-group col-md-2">
                <label for="abreviatura_programa">Abreviatura</label>
                <input type="text" class="form-control" id="abreviatura_programa" name="abreviatura_programa">
            </div>
            <div class="form-group col-md-4">
                <label for="descripcion_programa">Descripción</label>
                <input type="textarea" class="form-control" id="descripcion_programa" name="descripcion_programa">
            </div>
        </div>

            <button type="submit" value="Enviar este formulario" formmethod="POST" class="btn btn-primary" id="guardar_programa_estatal" name="guardar_programa_estatal">Registrar Programa Estatal</button>
        
    </form>

</div>

<div class="dropdown-divider"></div>

<div class="espaciadormio" style="height: 50px;"></div>




<div class="container-fluid bg-light">

    <h4>Programas Municipal</h4>
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Abreviatura</th>
            <th scope="col">Descripción</th>
            <th scope="col">Eliminar</th>

            </tr>
        </thead>
        <form method="POST" action="controlador/ajustes/ajustes_mysql.php">
            <tbody>
                <?php
                    foreach($programas_municipales as $municipal): ?>
                    <tr>                
                        <td>  <?php echo $municipal['nombre']?></td>
                        <td>  <?php echo $municipal['abreviatura']?> </td>
                        <td> <?php echo $municipal['descripcion']?> </td>
                    <td><a href="controlador/ajustes/ajustes_mysql.php?id_programa_municipal=<?php echo $municipal['id_programa_municipal'] ?>"> <i class="far fa-trash-alt ml-3"></i></a></td>
                    </tr>
                
                <?php endforeach;?>
            </form>
        </tbody>
        </table>


        <div class="dropdown-divider"></div>


        <h4>Registrar Nuevo Programa Municipal</h4>



        <form method="post" action="controlador/ajustes/ajustes_mysql.php">
            <div class="form-row">

                <div class="form-group col-md-3">
                    <label for="nombre_programa">Nombre de Programa Municipal</label>
                    <input type="text" class="form-control" id="nombre_programa" name="nombre_programa">
                </div>
                <div class="form-group col-md-2">
                    <label for="abreviatura_programa">Abreviatura</label>
                    <input type="text" class="form-control" id="abreviatura_programa" name="abreviatura_programa">
                </div>
                <div class="form-group col-md-4">
                    <label for="descripcion_programa">Descripción</label>
                    <input type="textarea" class="form-control" id="descripcion_programa" name="descripcion_programa">
                </div>
            </div>

                <button type="submit" value="Enviar este formulario" formmethod="POST" class="btn btn-primary" id="guardar_programa_municipal" name="guardar_programa_municipal">Registrar Programa Municipal</button>
            
        </form>

</div>
