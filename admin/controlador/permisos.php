<?php
$id = $_GET['id'];

$stm = $con->query("SELECT * FROM ciudadanos WHERE id_ciudadano = $id");
$ciudadano = $stm->fetch(PDO::FETCH_ASSOC);

include 'menu_proceso.php';
include 'controlador/ClassPermisos.php';

$permiso = new Permisos();

echo 'Administrador: ' . $_SESSION['user']['nombres'] . "  -  Nivel: " . $_SESSION['user']['nivel'] . "<br>";
echo 'Ciudadano actual: ' . $ciudadano['nombres'] . " " . $ciudadano['apellido_p'] . "  -  Nivel actual: " . $ciudadano['nivel'] . "<br>";

if($_SESSION['user']['nivel'] >= 2 ){
    echo "Tu no debes ver esto";
    die();
}

?>

<br>
<?php if($ciudadano['usuario_sistema']){
    echo '<h4>El Usuario ' . $ciudadano['nombres'] . ' ya cuenta con un usuario</h4>';
}else{
    echo '<h4>Crear usuario y contraseña</h4>';
}?>
<form action="controlador/permisossql.php" method="post">

    <input type="hidden" name="id" value="<?=$ciudadano['id_ciudadano']?>">

    <div class="form-row">

        <div class="form-group col-md-2">
            <?php if($_SESSION['user']['nombres'] <= 2){
                if ($ciudadano['usuario_sistema']) {
                    echo 'Tiene usuario: ' . '<br> <b>' . $ciudadano['usuario_sistema'] . '</b>';
                }else{
                    echo '<label for="usuario_sistema">Usuario</label>'. 
                    '<input type="text" class="form-control" id="usuario_sistema" name="usuario_sistema">';
                }
            } ?>

        </div>

        <div class="form-group col-md-2">
        <?php  if($_SESSION['user']['nombres'] <= 2){
            if ($ciudadano['contrasenia']) {
                echo '<label for="contrasenia">Asignar una nueva contraseña</label>'.
                 '<input type="password" class="form-control" id="contrasenia" name="contrasenia">';
            }else{
                echo '<label for="contrasenia">Contraseña</label>'. 
                '<input type="password" class="form-control" id="contrasenia" name="contrasenia">';
            }
        }
    
 ?>
        </div>

        <?php if(!$ciudadano['contrasenia']) :?>
            <div class="form-group col-md-2">
                <label for="nivel">Nivel</label>
                <select id="nivel" name="nivel" class="form-control">
                    <?php
                        $query = $mysqli->query("SELECT * FROM permisos");
                        while ($permiso = mysqli_fetch_array($query)) {
                            echo '<option value="9">Definir</option>';
                            echo '<option value="'.$permiso['numero'].'">'.$permiso['nombre'].'</option>';
                    }?>
                </select>
            </div>
        <?php endif ?>
        
        <div class="form-group col-md-2">
        <?php
        if ($ciudadano['contrasenia']) {
            echo '<button class="btn btn-primary mt-4" type="submit" name="actualizar" id="actualizar"> <i class="fas fa-user-edit"></i> Actualizar</button>';
        }else{
            echo '<button class="btn btn-primary mt-4" type="submit" name="crear" id="crear"> <i class="fas fa-user-edit"></i> Crear</button>';
        }?> 
        </div>
    </div> 
</form>

<br>

<form action="controlador/permisossql.php" method="post">
<input type="hidden" name="id" value="<?=$ciudadano['id_ciudadano']?>">
<?php 
if($_SESSION['user']['nivel'] < 3):
    if($ciudadano['contrasenia']):?>
        <h4>Modificar nivel</h4>
        <div class="form-group col-md-2">
            <label for="nivel_mod">Nivel</label>
            <select id="nivel_mod" name="nivel_mod" class="form-control">
            <?php
                $query = $mysqli->query("SELECT * FROM permisos");
                while ($permiso = mysqli_fetch_array($query)) {
                    echo '<option ' . ($selected = ($permiso['numero'] == $ciudadano['nivel']) ? "selected" : "") . ' value="'.$permiso['numero'].'">'.$permiso['nombre'].'</option>';
            }?>
            </select>
            <button class="btn btn-primary mt-4" type="submit" name="nivel" id="nivel"> <i class="fas fa-user-edit"></i> Modificar Nivel</button>
<?php endif;
endif?>
</form>