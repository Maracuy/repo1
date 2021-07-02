<?php
/**
 * Comprobacion de usuario registrado
 */
if (empty($_SESSION['user']) ){
    echo "no estas registrado";
    die();
}


/**
 * Primero verificamos que Exista el ALTA
 * Si se trae un alta, ya sabemos que es un proceso existente y podemos extraer los datos solo con esta informacion.
 */
if(isset($_GET['id_alta'])){
    $id_alta = $_GET['id_alta'];
    $stm = $con->query("SELECT * FROM altas WHERE id_alta = $id_alta");
    $alta = $stm->fetch();

    $stm = $con->query("SELECT * FROM procesos WHERE id_alta = $id_alta");
    $procesos = $stm->fetchAll(PDO::FETCH_ASSOC);

    $id_ciudadano = $alta['id_ciudadano'];
    
    if(isset($alta['id_programa_f'])){
        $tipo = 1;
        $id_programa = $alta['id_programa_f'];
    }
    if(isset($alta['id_programa_e'])){
        $tipo = 2;
        $id_programa = $alta['id_programa_e'];
    }
    if(isset($alta['id_programa_m'])){
        $tipo = 3;
        $id_programa = $alta['id_programa_m'];
    }

}



/**
 * Luego verificamos que se mande el id del ciudadano, si si existe lo asignamos a la variable.
 * Tambien verificamos que se reciba el id del programa, no se puede trabajar sin esos 2 datos.
 * Y el tipo del programa.
 */
if(!isset($_GET['id_alta'])){
    if(!isset($_GET['id_ciudadano']) OR !isset($_GET['id_programa'])){
    echo "Esta pagina no existe";
    die();
    }
    $id_ciudadano = $_GET['id_ciudadano'];
    $id_programa = $_GET['id_programa'];
    $tipo = (isset($_GET['tipo']) && $_GET['tipo'] != '') ? $_GET['tipo'] : NULL;
    $id_alta = NULL;
}
?>

<a href="programas.php?id=<?php echo $id_ciudadano ?>" class="btn btn-primary mr-3 ml-5 mt-3 "> <i class="fas fa-arrow-left"></i>Regresar</a>

<div class="espaciadormio" style="height: 30px;"></div>

<form method="POST" action="controlador/proceso_sql.php">


    <input type="hidden" name="id_ciudadano" value="<?php echo $id_ciudadano ?>">
    <input type="hidden" name="id_programa" value="<?php echo $id_programa ?>">
    <input type="hidden" name="tipo" value="<?php echo $tipo ?>">
    <?php if(isset($id_alta)):?>
    <input type="hidden" name="id_alta" value="<?php echo $id_alta ?>">
    <?php endif ?>

<?php if(isset($procesos)):

    foreach($procesos as $proceso):?>
        <div class="card bg-light w-75">
        <div class="card-body">
            <h5 class="card-title"><?php echo $_SESSION['user']['nombres'] . " ---  " . $proceso['fecha']?></h5>
            <p class="card-text"><?php echo $proceso['descripcion']?></p>
            <br>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="controlador/proceso_sql.php?proceso=<?php echo 1 ?>" type="button" class="btn btn-danger">Inicio</a>
                <a href="controlador/proceso_sql.php?proceso=<?php echo 2 ?>" type="button" class="btn btn-warning">En Proceso</a>
                <a href="controlador/proceso_sql.php?proceso=<?php echo 3 ?>" type="button" class="btn btn-secondary">Finalizando</a>
                <a href="controlador/proceso_sql.php?terminado=<?php echo $id_alta ?>" type="button" class="btn btn-success">Terminado</a>
            </div>
        </div>
        </div>
<?php endforeach;
endif;?>


<br>

<div class="form-row">
    <div class="col-md-7">
        <label for="descripcion">descripcion:</label>
        <textarea class="form-control col-md-7" id="descripcion" name="descripcion" placeholder="Descripcion del proceso"></textarea>
    </div>
</div>

<br>


<button class="btn btn-primary mr-3 ml-5 mt-3 " type="submit" name="nuevo" id="nuevo"> <i class="fas fa-save"></i> Guardar registro</button>

</form>


