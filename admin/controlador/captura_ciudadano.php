<?php

require_once 'ciudadanoSQL.php';
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

        <div class="form-group col-md-2">
            <label for="apellido_p">Apellido Paterno*</label>
            <?php if(isset($ciudadano['apellido_p'])){?>
                <input type="text" value="<?php echo $ciudadano['apellido_p']?>" class="form-control" id="apellido_p" name="apellido_p" required>
            <?php }else{
                echo '<input type="text" class="form-control" id="apellido_p" name="apellido_p">';
            }?>
        </div>

        <div class="form-group col-md-2">
            <label for="apellido_m">Apellido Materno*</label>
            <?php if(isset($ciudadano['apellido_m'])){?>
                <input type="text" value="<?php echo $ciudadano['apellido_m']?>" class="form-control" id="apellido_m" name="apellido_m" required>
            <?php }else{
                echo '<input type="text" class="form-control" id="apellido_m" name="apellido_m">';
            }?>
        </div>

        <div class="form-group col-md-2">
            <label for="nombres">Nombre(s)*</label>
            <?php if(isset($ciudadano['nombres'])){?>
                <input type="text" value="<?php echo $ciudadano['nombres']?>" class="form-control" id="nombres" name="nombres">
            <?php } else{
                echo '<input type="text" required class="form-control" id="nombres" name="nombres">';
            }?>
        </div>

        <div class="form-group col-md-2">
            <label for="fecha_nacimiento">Fecha Nacimiento</label>
            <?php if(isset($ciudadano['fecha_nacimiento'])){?>
                <input type="date" value="<?php echo $ciudadano['fecha_nacimiento']?>" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
            <?php }else{
                echo '<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">';
            }?>
        </div>

        <div class="form-group col-md-1">
            <label for="vulnerable">Vulnerable</label>
            <select class="form-control" id="vulnerable" name="vulnerable">
            <?php if(isset($ciudadano['vulnerable']) && $ciudadano['vulnerable'] != ""):?>
                <option <?php if ($ciudadano['vulnerable'] == 0 ) echo 'selected' ; ?> value=0>No</option>
                <option <?php if ($ciudadano['vulnerable'] == 1 ) echo 'selected' ; ?> value=1>Si</option>
            <?php endif?>
            <?php if(!isset($ciudadano['vulnerable'])):?>
                <option value="">No seleccionado</option>
                <option value=0>No</option>
                <option value=1>Si</option>
            <?php endif?>
            </select>
        </div>

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
        
        <div class="form-group col-md-2">
            <label for="curp">Curp</label>
            <?php if(isset($ciudadano['curp'])):?>
               <input type="text" value="<?php echo $ciudadano['curp']?>" class="form-control" id="curp" name="curp">
            <?php endif ?>
            <?php if(!isset($ciudadano['curp'])):?>
                <input type="text" class="form-control" id="curp" name="curp">
            <?php endif ?>
        </div>

        <div class="form-group col-md-2">
            <label for="numero_identificacion">Clave Elec.</label>
            <?php if(isset($ciudadano['numero_identificacion'])):?>
                <input type="text" value="<?php echo $ciudadano['numero_identificacion']?>" class="form-control" id="numero_identificacion" name="numero_identificacion">
            <?php endif ?>
            <?php if(!isset($ciudadano['numero_identificacion'])):?>
                <input type="text" class="form-control" id="numero_identificacion" name="numero_identificacion">
            <?php endif ?>
        </div>

        <div class="form-group col-md-2">
            <label for="email">Email</label>
            <?php if(isset($ciudadano['email'])):?>
                <input type="text" value="<?php echo $ciudadano['email']?>" class="form-control" id="email" name="email">
            <?php endif ?>
            <?php if(!isset($ciudadano['email'])):?>
                <input type="text" class="form-control" id="email" name="email">
            <?php endif ?>
        </div>
        
        <div class="form-group col-md-2">
            <label for="telefono">Telefono</label>
            <?php if(isset($ciudadano['telefono'])):?>
                <input type="tel" value="<?php echo $ciudadano['telefono']?>" class="form-control" id="telefono" name="telefono">
            <?php endif ?>
            <?php if(!isset($ciudadano['telefono'])):?>
                <input type="tel" class="form-control" id="telefono" name="telefono">
            <?php endif ?>
        </div>
        
        <div class="form-group col-md-2">
            <label for="otro_telefono">Otro Telefono</label>
            <?php if(isset($ciudadano['otro_telefono'])):?>
                <input type="text" value="<?php echo $ciudadano['otro_telefono']?>" class="form-control" id="otro_telefono" name="otro_telefono">
            <?php endif ?>
            <?php if(!isset($ciudadano['otro_telefono'])):?>
                <input type="text" class="form-control" id="otro_telefono" name="otro_telefono">
            <?php endif ?>
        </div>

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
            
            
        <div class="form-group col-md-2">
            <label for="dir_calle">Calle</label>
            <?php if(isset($ciudadano['dir_calle'])):?>
                <input type="text" value="<?php echo $ciudadano['dir_calle']?>" class="form-control" id="dir_calle" name="dir_calle">
            <?php endif ?>
            <?php if(!isset($ciudadano['dir_calle'])):?>
                <input type="text" class="form-control" id="dir_calle" name="dir_calle">
            <?php endif ?>
        </div>

        <div class="form-group col-md-1">
            <label for="dir_numero">Numero</label>
            <?php if(isset($ciudadano['dir_numero'])):?>
                <input type="text" value="<?php echo $ciudadano['dir_numero']?>" class="form-control" id="dir_numero" name="dir_numero">
            <?php endif ?>
            <?php if(!isset($ciudadano['dir_numero'])):?>
                <input type="text" class="form-control" id="dir_numero" name="dir_numero">
            <?php endif ?>
        </div>

        <div class="form-group col-md-1">
            <label for="dir_numero_int">No. int.</label>
            <?php if(isset($ciudadano['dir_numero_int'])):?>
                <input type="text" value="<?php echo $ciudadano['dir_numero_int']?>" class="form-control" id="dir_numero_int" name="dir_numero_int">
            <?php endif ?>
            <?php if(!isset($ciudadano['dir_numero_int'])):?>
                <input type="text" class="form-control" id="dir_numero_int" name="dir_numero_int">
            <?php endif ?>
        </div>

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

        <div class="form-group col-md-2">
            <label for="otra_colonia">Otra Colonia</label>
            <?php if(isset($ciudadano['otra_colonia'])):?>
                <input type="text" value="<?php echo $ciudadano['otra_colonia']?>" class="form-control" id="otra_colonia" name="otra_colonia">
            <?php endif ?>
            <?php if(!isset($ciudadano['otra_colonia'])):?>
                <input type="text" class="form-control" id="otra_colonia" name="otra_colonia">
            <?php endif ?>
        </div>
        
        <div class="form-group col-md-3">
            <label for="dir_referencia">Referencia de domicilio</label>
            <?php if(isset($ciudadano['dir_referencia'])):?>
                <input type="text" value="<?php echo $ciudadano['dir_referencia']?>" class="form-control" id="dir_referencia" name="dir_referencia">
            <?php endif ?>
            <?php if(!isset($ciudadano['dir_referencia'])):?>
                <input type="text" class="form-control" id="dir_referencia" name="dir_referencia">
            <?php endif ?>
        </div>


    </div> <!--Termina row-->
<br>

<div class="form-row">


    <div class="form-group col-md-1">
        <label for="manzana">Manzana</label>
        <?php if(isset($ciudadano['manzana'])):?>
            <input type="text" value="<?php echo $ciudadano['manzana']?>" class="form-control" id="manzana" name="manzana">
        <?php endif ?>
        <?php if(!isset($ciudadano['manzana'])):?>
            <input type="text" class="form-control" id="manzana" name="manzana">
        <?php endif ?>
    </div>

    <div class="form-group col-md-1">
        <label for="lote">Lote</label>
        <?php if(isset($ciudadano['lote'])):?>
            <input type="text" value="<?php echo $ciudadano['lote']?>" class="form-control" id="lote" name="lote">
        <?php endif ?>
        <?php if(!isset($ciudadano['lote'])):?>
            <input type="text" class="form-control" id="lote" name="lote">
        <?php endif ?>
    </div>

    <div class="form-group col-md-1">
        <label for="cp">C.P.</label>
        <?php if(isset($ciudadano['cp'])):?>
            <input type="number" value="<?php echo $ciudadano['cp']?>" class="form-control" id="cp" name="cp">
        <?php endif ?>
        <?php if(!isset($ciudadano['cp'])):?>
            <input type="text" class="form-control" id="cp" name="cp">
        <?php endif ?>
    </div>


    <div class= "form-group col-md-1">
        <label for="zona">Zona</label> 
        <?php if(isset($ciudadano['zona'])):?>
            <input type="text" value="<?php echo $ciudadano['zona']?>" class="form-control" id="zona" name="zona">
        <?php endif ?>
        <?php if(!isset($ciudadano['zona'])):?>
            <input type="text" class="form-control" id="zona" name="zona">
        <?php endif ?>

    </div>

    <div class= "form-group col-md-1">
        <label for="seccion_electoral">SECC.</label> 
        <?php if(isset($ciudadano['seccion_electoral'])):?>
            <input type="text" value="<?php echo $ciudadano['seccion_electoral']?>" class="form-control" id="seccion_electoral" name="seccion_electoral">
        <?php endif ?>
        <?php if(!isset($ciudadano['seccion_electoral'])):?>
            <input type="text" class="form-control" id="seccion_electoral" name="seccion_electoral">
        <?php endif ?>

    </div>        



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

    <div class="form-group col-md-2">
        <label for="ocupacion">Ocupación</label>
        <?php if(isset($ciudadano['ocupacion'])):?>
            <input type="text" value="<?php echo $ciudadano['ocupacion']?>" class="form-control" id="ocupacion" name="ocupacion">
        <?php endif ?>
        <?php if(!isset($ciudadano['ocupacion'])):?>
            <input type="text" class="form-control" id="ocupacion" name="ocupacion">
        <?php endif ?>
    </div>

    <div class="form-group col-md-1">
        <label for="pensionado">Pensionado</label>
        <select class="form-control" id="pensionado" name="pensionado">
        <?php if(isset($ciudadano['pensionado'])) :?>
            <option <?php if ($ciudadano['pensionado'] == 0 ) echo 'selected' ;?> value=0>No</option>
            <option <?php if ($ciudadano['pensionado'] == 1 ) echo 'selected' ;?> value=1>Si</option>
        <?php endif ?>
        <?php if(!isset($ciudadano['pensionado']) || $ciudadano['pensionado'] != "" ) :?>
            <option value=0>No</option>
            <option value=1>Si</option>
        <?php endif ?>
        
        </select>
    </div>

    <div class="form-group col-md-2">
        <label for="origen">Referencia</label>
        <?php if(isset($ciudadano['origen'])):?>
            <input type="text" value="<?php echo $ciudadano['origen']?>" class="form-control" id="origen" name="origen">
        <?php endif ?>
        <?php if(!isset($ciudadano['origen'])):?>
            <input type="text" class="form-control" id="origen" name="origen">
        <?php endif ?>
    </div>

</div>
 

    
<?php if(isset($id)):?>
    <button class="btn btn-primary" type="submit" name="actualizar" id="actualizar"> <i class="fas fa-user-edit"></i> Editar</button>
<?php endif ?>

<?php if(!isset($id)):?>
    <button class="btn btn-primary" type="submit" name="continuar" id="continuar"> <i class="fas fa-user-edit"></i> Guardar y Continuar</button>
<?php endif ?>
    <a href="ciudadanos.php" class="btn btn-danger"> <i class="far fa-times-circle"></i>  Salir sin guardar </a>
    
    
  
</form>


<?php $con=null?>
<?php mysqli_close($mysqli)?>