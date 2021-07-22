<form method="post" action="<?=$_SERVER['PHP_SELF'] . "?registro={$programaParaRegistrar}&curp={$curpUsuario}"; ?>" class="formClassFillData">
    <div>
        <label for="">Apellido Paterno&#42;</label>
        <input type="text" name="nameInputApellidoP" class="form-control" required>
    </div>
    <div>
        <label for="">Apellido Materno&#42;</label>
        <input type="text" name="nameInputApellidoM" class="form-control" required>
    </div>
    <div>
        <label for="">Nombre&#40;s&#41;&#42;</label>
        <input type="text" name="nameInputNombre" class="form-control" required>
    </div>
    <div>
        <label for="">CURP&#42;</label>
        <input type="text" name="nameInputCURP" class="form-control" <?php if(isset($curpUsuario)){echo "value=\"{$curpUsuario}\" readonly";}?> required>
    </div>
    <div>
        <label for="">Email&#42;</label>
        <input type="email" name="nameInputEmail" class="form-control" required>
    </div>
    <div>
        <label for="">Telefono&#42;</label>
        <input type="number" name="nameInputTelefono" class="form-control" required>
    </div>
    <div>
    <label for="">Fecha de nacimiento&#42;</label>
        <input type="date" name="nameInputFechaNacimiento" class="form-control" required>
    </div>
    <div>
        <button class="btn btn-primary" type="submit" name="nameBtnEnviarFormulario2">
            Registrar
        </button>
    </div>
</form>