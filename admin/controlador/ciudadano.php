<?php

require_once 'ciudadanoSQL.php';
require_once 'CiudadanoC.php';

$ciudadano = (isset($ciudadano))?$ciudadano:'';

$campos = new Ciudadano();

//Area de condiciones para niveles limitados

if(isset($_GET['exists']) && $_GET['exists'] ==1){
    echo '
   <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <h3>Ciudadano Duplicado</h3>
           </div>
                <div class="modal-body">
                    Se encontró la misma CLAVE DE ELECTOR en la base de datos, a continuación se muestran los datos capturados anteriormente
                </div>
           <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
           </div>
      </div>
   </div>
</div>


<script>
      $(document).ready(function()
      {
        $("#mostrarmodal").modal("show");
      });
    </script>
';
    }


?>



<form method="POST" action="controlador/alta_ciudadano_sql.php">
<?php if(isset($id)):?>
<input type="hidden" id="id_ciudadano" name="id" value="<?php echo $id?>">
<input type="hidden" id="fecha_captura" name="fecha_captura" value="<?php echo $ciudadano['fecha_captura']?>">
<input type="hidden" id="id_registrante" name="id_registrante" value="<?php echo $ciudadano['id_registrante']?>">
<?php endif ?>

<?php if(!isset($id)):?>
    <input type="hidden" id="id_registrante" name="id_registrante" value="<?php echo $empleado?>">
<?php endif ?>


<div class="espaciadormio" style="height: 20px;"></div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <?php if(isset($id)):?>
                <h4>Editar Ciudadano: <br> <?php echo $ciudadano['nombres'] . " " . $ciudadano['apellido_p'] . " " . $ciudadano['apellido_m']; ?></h4>
            <?php endif ?>
            <?php if(!isset($id)):?>
                <h4>Capturar Ciudadano</h4>
            <?php endif ?>

        </div>

        <div class="form-group col-md-5">
            <a href="ciudadanos.php" class="btn btn-danger"> <i class="far fa-times-circle"></i>  Salir sin guardar </a>
        </div>

        <div class="form-group col-md-3">
            <?php if(isset($id)):?>
                <a  href="programas.php?id=<?php echo $id ?>" class="btn btn-success"> <i class="fas fa-hands-helping"></i> Programas y proceso </a>
            <?php endif?>

        </div>
    </div>


    <div class="espaciadormio" style="height: 10px;"></div>


    <div class="form-row">

        <?= $campos->CampoEditable($ciudadano, 'apellido_p', 'Apellido Paterno*',2, 'required', '') ?>
        <?= $campos->CampoEditable($ciudadano, 'apellido_m', 'Apellido Materno*',2, 'required', '') ?>
        <?= $campos->CampoEditable($ciudadano, 'nombres', 'Nombres*',2, 'required', '') ?>
        
        <?= $campos->Fechas($ciudadano, 'fecha_nacimiento', 'Fecha Nacimiento*',2) ?>

        <div class="form-group col-md-1">
            <label for="genero">Genero</label>
            <select class="form-control" id="genero" name="genero">
            <?php if(isset($ciudadano['genero']) && $ciudadano['genero'] != ""): ?>
                <option <?php if ($ciudadano['genero'] == 0 ) echo 'selected' ; ?> value=0>M</option>
                <option <?php if ($ciudadano['genero'] == 1 ) echo 'selected' ; ?> value=1>F</option>
            <?php endif ?>
            <?php if(!isset($ciudadano['genero'])):?>
                <option value="">No seleccionado</option>
                <option value=0>M</option>
                <option value=1>F</option>
            <?php endif?>
            </select>
        </div>
                
    </div> <!--Termina row-->
    <br>

    <div class="form-row">
        
        <?= $campos->CampoEditable($ciudadano, 'curp', 'CURP',2, '', '') ?>
        <?= $campos->CampoEditable($ciudadano, 'numero_identificacion', 'Clave Elector',2, '', 18) ?>
        <?= $campos->CampoEditable($ciudadano, 'email', 'Email',2, '', '') ?>
        <?= $campos->CampoEditable($ciudadano, 'telefono', 'Telefono (S/Espacios)',2, '', '') ?>
        <?= $campos->CampoEditable($ciudadano, 'otro_telefono', 'Telefono 2',1, '', '') ?>


        <div class="form-group col-md-1">
            <label for="whats">Whatsapp</label>
            <select class="form-control" id="whats" name="whats">
            <?php if(isset($ciudadano['whats']) && $ciudadano['whats'] != ""): ?>
                <option <?php if ($ciudadano['whats'] == 0 ) echo 'selected' ;?> value=0>No</option>
                <option <?php if ($ciudadano['whats'] == 1 ) echo 'selected' ;?> value=1>Si</option>
            <?php endif ?>
            <?php if(!isset($ciudadano['whats'])): ?>
                <option value=''> No seleccionado </option>
                <option value=0> No </option>
                <option value=1> Si </option>
            <?php endif ?>
            </select>
        </div>

    </div> <!--Termina row-->




    <br>


    <div class="form-row">
        <?= $campos->CampoEditable($ciudadano, 'dir_calle', 'Calle',2, '', '') ?>
        <?= $campos->CampoEditable($ciudadano, 'dir_numero', 'Numero',1, '', '') ?>
        <?= $campos->CampoEditable($ciudadano, 'dir_numero_int', 'Interno',1, '', '') ?>

        <div class="form-group col-md-2">
            <label for="id_colonia">Colonia</label>
            <select id="id_colonia" name="id_colonia" class="form-control">
            <?php
                $query = $mysqli->query("SELECT * FROM colonias");
                while ($colonias = mysqli_fetch_array($query)) {
                echo '<option ' . ($selected = ($ciudadano['id_colonia'] == $colonias['id']) ? "selected" : "") . ' value="'.$colonias['id'].'">'.$colonias['nombre_colonia'].'</option>';
                }?>
            </select>
        </div>

        <?= $campos->CampoEditable($ciudadano, 'otra_colonia', 'Otra Colonia',2, '', '') ?>
        <?= $campos->CampoEditable($ciudadano, 'dir_referencia', 'Ref. Dirección',3, '', '') ?>

    </div> <!--Termina row-->
<br>

<div class="form-row">

    <?= $campos->CampoEditable($ciudadano, 'manzana', 'Manzana',1, '', '') ?>
    <?= $campos->CampoEditable($ciudadano, 'lote', 'Lote',1, '', '') ?>
    <?= $campos->CampoEditable($ciudadano, 'cp', 'C.P.',1, '', '') ?>
    <?= $campos->CampoEditable($ciudadano, 'zona', 'Zona',1, '', '') ?>
    <?= $campos->CampoEditable($ciudadano, 'seccion_electoral', 'Sección',1, '', '') ?>


    <div class="form-group col-md-2">
        <label for="estado_civil">Estado Civil</label>
        <select class="form-control" id="estado_civil" name="estado_civil">
        <?php if(isset($ciudadano['estado_civil']) && $ciudadano['estado_civil'] != ""):?>
            <option <?php if ($ciudadano['whats'] == "soltero" ) echo 'selected'?> value="soltero">Soltero</option>
            <option <?php if ($ciudadano['whats'] == "casado" ) echo 'selected'?> value="casado">Casado</option>
            <option <?php if ($ciudadano['whats'] == "divorciado" ) echo 'selected'?> value="divorciado">Divorciado</option>
            <option <?php if ($ciudadano['whats'] == "viudo" ) echo 'selected'?> value="viudo">Viudo</option>
            <option <?php if ($ciudadano['whats'] == "concubinato" ) echo 'selected'?> value="concubinato">Concubinato</option>
            
        <?php endif ?>
        <?php if(!isset($ciudadano['estado_civil']) || $ciudadano['estado_civil'] == ""):?>
            <option value="">No Respondio</option>
            <option value="soltero">Soltero</option>
            <option value="casado">Casado</option>
            <option value="divorciado">Divorciado</option>
            <option value="viudo">Viudo</option>
            <option value="concubinato">Concubinato</option>
        <?php endif ?>
        </select>
    </div>

    <?= $campos->CampoEditable($ciudadano, 'municipio', 'Municipio',1, '', '') ?>
    <?= $campos->CampoEditable($ciudadano, 'origen', 'Origen',1, '', '') ?>


</div>
 

    
<?php if(isset($id)):?>
    <button class="btn btn-primary" type="submit" name="actualizar" id="actualizar"> <i class="fas fa-user-edit"></i> Editar</button>
<?php endif ?>

<?php if(!isset($id)):?>
    <button class="btn btn-primary" type="submit" name="continuar" id="continuar"> <i class="fas fa-user-edit"></i> Guardar y Continuar</button>
<?php endif ?>
    <a href="ciudadanos.php" class="btn btn-danger"> <i class="far fa-times-circle"></i>  Salir sin guardar </a>
    
    
  
</form>


<?php if(isset($id)):?>
    <form action="controlador/borrador_ciudadanos.php" method="post">
        <input type="hidden" name="id_ciudadano" value="<?= $id?>">
        <button type="submit" class="btn btn-danger mt-5 ml-5" name="borrar" id="borrar"><i class="fas fa-trash"></i> Eliminar</button>
    </form>
<?php endif ?>
<?php $con=null?>
<?php mysqli_close($mysqli)?>