<?php 
$id_auxiliar = $_GET['id'];
$sql_query = $con->prepare("SELECT * FROM auxiliares WHERE id_auxiliar=?");
$sql_query->execute(array($id_auxiliar));
$auxiliar = $sql_query->fetch();

?>
    

    <form method="POST">

        <div class="form-row">

            <input type="hidden" value="<?php echo $id_auxiliar?>" name="id_beneficiario">
            <div class="form-group col-md-2">
                <label for="nombres_auxiliar">Nombre(s)</label>
                <input type="text" value="<?php echo $auxiliar['nombres_auxiliar']?>" class="form-control" id="nombres_auxiliar" name="nombres_auxiliar">
            </div>

            <div class="form-group col-md-2">
                <label for="apellido_p_auxiliar">Apellido Paterno</label>
                <input type="text" value="<?php echo $auxiliar['apellido_p_auxiliar']?>" class="form-control" id="apellido_p_auxiliar" name="apellido_p_auxiliar">
            </div>

            <div class="form-group col-md-2">
                <label for="apellido_m_auxiliar">Apellido Materno</label>
                <input type="text" value="<?php echo $auxiliar['apellido_m_auxiliar']?>" class="form-control" id="apellido_m_auxiliar" name="apellido_m_auxiliar">
            </div>

            <div class="form-group col-md-2">
                <label for="telefono_auxiliar">Telefono</label>
                <input type="tel" value="<?php echo $auxiliar['telefono_auxiliar']?>" class="form-control" id="telefono_auxiliar" name="telefono_auxiliar">
            </div>

            
            <div class="form-group col-md-2">
                <label for="parentesco">Parentesco</label>
                <select class="form-control" id="parentesco" name="parentesco">
                <?php echo $echo_auxiliar = ($auxiliar['nivel'] == "") ? "<option value=''> No seleccionado </option>" : ""; ?>
                <option <?php if ($auxiliar['parentesco'] == "ninguno" ) echo 'selected' ; ?> value="ninguno">Ninguno</option>
                <option <?php if ($auxiliar['parentesco'] == "padre" ) echo 'selected' ; ?> value="padre">Padre</option>
                <option <?php if ($auxiliar['parentesco'] == "hijo" ) echo 'selected' ; ?> value="hijo">Hijo</option>
                <option <?php if ($auxiliar['parentesco'] == "hermano" ) echo 'selected' ; ?> value="hermano">Hermano</option>
                <option <?php if ($auxiliar['parentesco'] == "otro" ) echo 'selected' ; ?> value="otro">Otro</option>
                </select>
            </div>
        </div>
        <button class="btn btn-primary" type="submit" name="guardar_salir" id="guardar_salir"> <i class="far fa-save mr-2"></i>  Actualizar</button>

    </form>


<!--     Se quiere hacer una sola clase con todas las actualizaciones... Pero mientras... -->


<?php
if($_POST){
    $nombres_aux = $_POST['nombres_auxiliar'];
    $apellido_p_aux = $_POST['apellido_p_auxiliar'];
    $apellido_m_aux = $_POST['apellido_m_auxiliar'];
    $telefono_auxiliar = $_POST['telefono_auxiliar'];
    $id_beneficiario = $_POST['id_beneficiario'];
    $parentesco = $_POST['parentesco'];
    
    $sql_editar = "UPDATE auxiliares SET nombres_auxiliar=?, apellido_p_auxiliar=?, apellido_m_auxiliar=?, telefono_auxiliar=?, parentesco=? WHERE id_auxiliar = ?";
    $sentencia_agregar = $con->prepare($sql_editar);

    try{
        $sentencia_agregar->execute(array($nombres_aux, $apellido_p_aux, $apellido_m_aux, $telefono_auxiliar, $parentesco, $id_auxiliar));
        echo "Se actualizo correctamente";
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }  
}

?>