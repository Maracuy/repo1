<?php $id_beneficiario = $_GET['id'] ?>

<form method="POST">

    <div class="form-row">

        <input type="hidden" value="<?php echo $id_beneficiario?>" name="id_beneficiario">

        <div class="form-group col-md-2">
            <label for="nombres_auxiliar">Nombre(s)</label>
            <input type="text" class="form-control" id="nombres_auxiliar" name="nombres_auxiliar">
        </div>

        <div class="form-group col-md-2">
            <label for="apellido_p_auxiliar">Apellido Paterno</label>
            <input type="text" class="form-control" id="apellido_p_auxiliar" name="apellido_p_auxiliar">
        </div>

        <div class="form-group col-md-2">
            <label for="apellido_m_auxiliar">Apellido Materno</label>
            <input type="text" class="form-control" id="apellido_m_auxiliar" name="apellido_m_auxiliar">
        </div>

        <div class="form-group col-md-2">
            <label for="telefono_auxiliar">Telefono</label>
            <input type="tel" class="form-control" id="telefono_auxiliar" name="telefono_auxiliar">
        </div>

        
        <div class="form-group col-md-2">
            <label for="parentesco">Parentesco</label>
            <select class="form-control" id="parentesco" name="parentesco">
            <option value="ninguno">Ninguno</option>
            <option value="padre">Padre</option>
            <option value="hijo">Hijo</option>
            <option value="hermano">Hermano</option>
            <option value="otro">Otro</option>
            </select>
        </div>
    </div>

    <button class="btn btn-primary" type="submit" name="guardar_salir" id="guardar_salir"> <i class="far fa-save mr-2"></i>  Guardar</button>

</form>



<?php

if($_POST){
    $nombres_aux = $_POST['nombres_auxiliar'];
    $apellido_p_aux = $_POST['apellido_p_auxiliar'];
    $apellido_m_aux = $_POST['apellido_m_auxiliar'];
    $telefono_auxiliar = $_POST['telefono_auxiliar'];
    $id_beneficiario = $_POST['id_beneficiario'];
    $parentesco = $_POST['parentesco'];
    
    $sql_agregar_beneficiario = 'INSERT INTO auxiliares VALUES (NULL, ?, ?, ?, ?, ?, ?)';
    $sentencia_agregar_beneficiario = $con->prepare($sql_agregar_beneficiario);

    try{
        $sentencia_agregar_beneficiario->execute(array($nombres_aux, $apellido_p_aux, $apellido_m_aux, $telefono_auxiliar, $id_beneficiario, $parentesco));
        echo "<script> alert (Guardado con exito)</script> ";
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }  





}

?>