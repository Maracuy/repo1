<?php
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}

if(empty($_GET['id'])){
    echo "No exite esta pagina";
    die();
}else{
    $id = $_GET['id'];
    include 'controlador/menu_proceso.php';
}

$consulta = $con->query("SELECT * FROM puestos_defensa WHERE id_ciudadano = $id");
$alta = $consulta->fetch(PDO::FETCH_ASSOC);

if(!$alta):
    // Si el ciudadano no tiene un alta, apareceran 2 botones?>
    <a href="electoral.php?id=">Boton1</a>

<?php endif;

echo "<h4>Electoral</h4>";

if(isset($alta['id_defensa']) && $alta['id_defensa'] != ''){

    echo "Zona: " . $alta['zona'];
    echo "<br>";
    echo "RG: " . $alta['rg'];
    echo "<br>";
    echo "Seccion: " . $alta['seccion'];
    echo "<br>";
    echo "Casilla: " . $alta['casilla'];
    echo "<br>";
    echo "Puesto: " . $alta['puesto'];
    echo "<br>";

}

if(isset($alta['id_zona']) && $alta['id_zona'] != ''){
    $id_zona = $alta['id_zona'];
    $consultaz = $con->query("SELECT * FROM zonas WHERE id_zona = $id_zona");
    $zona = $consultaz->fetch(PDO::FETCH_ASSOC);   
    echo "Representante de la Zona: " . $zona['zona'];
    echo "<br>";
}

?>
<br>
<form method="POST" action="controlador/electoralsql.php">

<input id = "id" name = "id" type = "hidden" value = "<?php echo $id?>">


<div class="form-row"><br>

    <div class="form-group col-md-2">
        <label for="previo">Participo Eleccion Previa</label>
        <select class="form-control" id="previo" name="previo">
        <?php if(isset($alta['previo'])) :?>
            <option <?php if ($alta['previo'] == '' ) echo 'selected' ;?> value="">No definido</option>
            <option <?php if ($alta['previo'] == 0 ) echo 'selected' ;?> value=0>No</option>
            <option <?php if ($alta['previo'] == 1 ) echo 'selected' ;?> value=1>Si</option>
        <?php endif ?>
        <?php if(!isset($alta['previo']) || $alta['previo'] != "" ) :?>
            <option value="">Aun No Definido</option>
            <option value=0>No</option>
            <option value=1>Si</option>
        <?php endif ?>
        </select>
    </div> 

    <div class="form-group col-md-2">
        <label for="posicion_prev">Posicion (Opciones)</label>
        <?php if(isset($alta['posicion_prev'])):?>
            <input type="text" value="<?php echo $alta['posicion_prev']?>" class="form-control" id="posicion_prev" name="posicion_prev">
        <?php endif ?>
        <?php if(!isset($alta['posicion_prev'])):?>
            <input type="text" class="form-control" id="posicion_prev" name="posicion_prev">
        <?php endif ?>
    </div>
    
    
    <div class="form-group col-md-1 ">
        <label for="asistio">Asistio</label>
        <select class="form-control" id="asistio" name="asistio">
        <?php if(isset($alta['asistio'])) :?>
            <option <?php if ($alta['asistio'] == "" ) echo 'selected' ;?> value=0>No Definido</option>
            <option <?php if ($alta['asistio'] == 0 ) echo 'selected' ;?> value=0>No</option>
            <option <?php if ($alta['asistio'] == 1 ) echo 'selected' ;?> value=1>Si</option>
            <?php endif ?>
            <?php if(!isset($alta['asistio'])) :?>
                <option value="">No Definido</option>
                <option value=0>No</option>
                <option value=1>Si</option>
                <?php endif ?>
            </select>
        </div> 


    <div class="form-group col-md-1">
        <label for="compromiso">Compromiso</label>
        <select class="form-control" id="compromiso" name="compromiso">
        <?php if(isset($alta['compromiso']) && $alta['compromiso'] != '') :?>
            <option <?php if ($alta['compromiso'] == '' ) echo 'selected' ;?> value=''>Vacio</option>
            <option <?php if ($alta['compromiso'] == 1 ) echo 'selected' ;?> value=1>1</option>
            <option <?php if ($alta['compromiso'] == 2 ) echo 'selected' ;?> value=2>2</option>
            <option <?php if ($alta['compromiso'] == 3 ) echo 'selected' ;?> value=3>3</option>
            <option <?php if ($alta['compromiso'] == 4 ) echo 'selected' ;?> value=4>4</option>
            <option <?php if ($alta['compromiso'] == 5 ) echo 'selected' ;?> value=5>5</option>
        <?php endif ?>
        <?php if(!isset($alta['compromiso'])) :?>
            <option value=''>Vacio</option>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
        <?php endif ?>
        </select>
    </div> 

    <div class="form-group col-md-2">
        <label for="afiliacion">Afiliacion (Opcional)</label>
        <?php if(isset($alta['afiliacion'])):?>
            <input type="text" value="<?php echo $alta['afiliacion']?>" class="form-control" id="afiliacion" name="afiliacion">
            <?php endif ?>
            <?php if(!isset($alta['afiliacion'])):?>
                <input type="text" class="form-control" id="afiliacion" name="afiliacion">
                <?php endif ?>
    </div>   


    <div class="form-group col-md-1">
        <label for="cubre">Cubre?</label>
        <select class="form-control" id="cubre" name="cubre">

        <?php if(isset($alta['cubre']) && $alta['cubre'] != "" ) :?>
            <option <?php if ($alta['cubre'] == '' ) echo 'selected' ;?> value=''>No Definido</option>
            <option <?php if ($alta['cubre'] == 0 ) echo 'selected' ;?> value=0>No</option>
            <option <?php if ($alta['cubre'] == 1 ) echo 'selected' ;?> value=1>Si</option>
            <?php endif ?>
            <?php if(!isset($alta['cubre'])):?>
                <option value=''>No Definido</option>
                <option value=0>No</option>
                <option value=1>Si</option>
                <?php endif ?>
            </select>
        </div> 


   </div>
    <div class="form-group col-md-2">
        <label for="origen">Origen (Opciones?)</label>
        <?php if(isset($alta['origen'])):?>
            <input type="text" value="<?php echo $alta['origen']?>" class="form-control" id="origen" name="origen">
        <?php endif ?>
        <?php if(!isset($alta['origen'])):?>
            <input type="text" class="form-control" id="origen" name="origen">
        <?php endif ?>
    </div>


    <div class="dropdown-divider"></div>

<br>
    
<?php if(isset($id)):?>
    <button class="btn btn-primary" type="submit" name="actualizar" id="actualizar"> <i class="fas fa-user-edit"></i> Editar</button>
<?php endif ?>

<?php if(!isset($id)):?>
    <button class="btn btn-primary" type="submit" name="continuar" id="continuar"> <i class="fas fa-user-edit"></i> Guardar y Continuar</button>
<?php endif ?>
    <a href="altas.php" class="btn btn-danger"> <i class="far fa-times-circle"></i>  Salir sin guardar </a>

  
</form>


<?php $con=null?>
<?php mysqli_close($mysqli)?>