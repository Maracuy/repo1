<form method="post" action="<?=$_SERVER['PHP_SELF'] . "?registro={$programaParaRegistrar}&curp={$curpParaRegistrar}"; ?>" class="formClassFillData">
    <div>
        <label for="">Apellido Paterno&#42;</label>
        <input type="text" name="nameInputApellidoP" class="form-control" <?php if(!$camposTablaCiudadanos['apellido_p'] == null || !empty($camposTablaCiudadanos['apellido_p'])){echo "value=\"{$camposTablaCiudadanos['apellido_p']}\" readonly";}?> required>
    </div>
    <div>
        <label for="">Apellido Materno&#42;</label>
        <input type="text" name="nameInputApellidoM" class="form-control" <?php if(!$camposTablaCiudadanos['apellido_m'] == null || !empty($camposTablaCiudadanos['apellido_m'])){echo "value=\"{$camposTablaCiudadanos['apellido_m']}\" readonly";}?> required>
    </div>
    <div>
        <label for="">Nombre&#40;s&#41;&#42;</label>
        <input type="text" name="nameInputNombre" class="form-control" <?php if(!$camposTablaCiudadanos['nombres'] == null || !empty($camposTablaCiudadanos['nombres'])){echo "value=\"{$camposTablaCiudadanos['nombres']}\" readonly";}?> required>
    </div>
    <div>
        <label for="">Fecha de nacimiento&#42;</label>
        <input type="date" name="nameInputFechaNacimiento" class="form-control" <?php if(!$camposTablaCiudadanos['fecha_nacimiento'] == null || !empty($camposTablaCiudadanos['fecha_nacimiento'])){echo "value=\"{$camposTablaCiudadanos['fecha_nacimiento']}\" readonly";}?> required>
    </div>
    <div>
        <label for="">CURP&#42;</label>
        <input type="text" name="nameInputCURP" class="form-control" <?php if(!$camposTablaCiudadanos['curp'] == null || !empty($camposTablaCiudadanos['curp'])){echo "value=\"{$camposTablaCiudadanos['curp']}\" readonly";}?> required>
    </div>
    <div>
        <label for="">EMAIL&#42;</label>
        <input type="email" name="nameInputEmail" class="form-control" <?php if(!$camposTablaCiudadanos['email'] == null || !empty($camposTablaCiudadanos['email'])){echo "value=\"{$camposTablaCiudadanos['email']}\" readonly";}?> required>
    </div>
    <div>
        <label for="">Telefono&#42;</label>
        <input type="number" name="nameInputTelefono" class="form-control" <?php if(!$camposTablaCiudadanos['telefono'] == null || !empty($camposTablaCiudadanos['telefono'])){echo "value=\"{$camposTablaCiudadanos['telefono']}\" readonly";}?> required>
    </div>
    <div>
        <label for="">WhatsApp</label>
        <select name="nameInputWhatsApp" class="form-control" <?php if(!$camposTablaCiudadanos['whats'] == null || !empty($camposTablaCiudadanos['whats'])){echo " readonly";}?>>
            <option value="" <?php if($camposTablaCiudadanos['whats'] === ""){echo " selected";}?>>No seleccionado</option>
            <option value="0" <?php if($camposTablaCiudadanos['whats'] == 0){echo " selected";}?>>Si</option>
            <option value="1" <?php if($camposTablaCiudadanos['whats'] == 1){echo " selected";}?>>No</option>
        </select>
    </div>
    <div>
        <label for="">Calle</label>
        <input type="text" name="nameInputCalle" class="form-control" <?php if(!$camposTablaCiudadanos['dir_calle'] == null || !empty($camposTablaCiudadanos['dir_calle'])){echo "value=\"{$camposTablaCiudadanos['dir_calle']}\" readonly";}?>>
    </div>
    <div>
        <label for="">Numero</label>
        <input type="text" name="nameInputNumero" class="form-control" <?php if(!$camposTablaCiudadanos['dir_numero'] == null || !empty($camposTablaCiudadanos['dir_numero'])){echo "value=\"{$camposTablaCiudadanos['dir_numero']}\" readonly";}?>>
    </div>
    <div>
        <label for="">Interno</label>
        <input type="text" name="nameInputInterno" class="form-control" <?php if(!$camposTablaCiudadanos['dir_numero_int'] == null || !empty($camposTablaCiudadanos['dir_numero_int'])){echo "value=\"{$camposTablaCiudadanos['dir_numero_int']}\" readonly";}?>>
    </div>
    <div>
        <label for="">Colonia</label>
        <input type="text" name="nameInputColonia" class="form-control" <?php if(!$camposTablaCiudadanos['id_colonia'] == null || !empty($camposTablaCiudadanos['id_colonia'])){echo "value=\"{$camposTablaCiudadanos['id_colonia']}\" readonly";}?>>
    </div>
    <div>
        <label for="">Otra Colonia</label>
        <input type="text" name="nameInputOtraColonia" class="form-control" <?php if(!$camposTablaCiudadanos['otra_colonia'] == null || !empty($camposTablaCiudadanos['otra_colonia'])){echo "value=\"{$camposTablaCiudadanos['otra_colonia']}\" readonly";}?>>
    </div>
    <div>
        <label for="">Ref. Direccion</label>
        <input type="text" name="nameInputReferenciaDireccion" class="form-control" <?php if(!$camposTablaCiudadanos['dir_referencia'] == null || !empty($camposTablaCiudadanos['dir_referencia'])){echo "value=\"{$camposTablaCiudadanos['dir_referencia']}\" readonly";}?>>
    </div>
    <div>
        <label for="">Manzana</label>
        <input type="text" name="nameInputManzana" class="form-control" <?php if(!$camposTablaCiudadanos['manzana'] == null || !empty($camposTablaCiudadanos['manzana'])){echo "value=\"{$camposTablaCiudadanos['manzana']}\" readonly";}?>>
    </div>
    <div>
        <label for="">Lote</label>
        <input type="text" name="nameInputLote" class="form-control" <?php if(!$camposTablaCiudadanos['lote'] == null || !empty($camposTablaCiudadanos['lote'])){echo "value=\"{$camposTablaCiudadanos['lote']}\" readonly";}?>>
    </div>
    <div>
        <label for="">C.P.</label>
        <input type="text" name="nameInputCodigoPostal" class="form-control" <?php if(!$camposTablaCiudadanos['cp'] == null || !empty($camposTablaCiudadanos['cp'])){echo "value=\"{$camposTablaCiudadanos['cp']}\" readonly";}?>>
    </div>
    <div>
        <label for="">Zona</label>
        <input type="text" name="nameInputZona" class="form-control" <?php if(!$camposTablaCiudadanos['zona'] == null || !empty($camposTablaCiudadanos['zona'])){echo "value=\"{$camposTablaCiudadanos['zona']}\" readonly";}?>>
    </div>
    <div>
        <label for="">Seccion</label>
        <input type="text" name="nameInputSeccion" class="form-control" <?php if(!$camposTablaCiudadanos['seccion_electoral'] == null || !empty($camposTablaCiudadanos['seccion_electoral'])){echo "value=\"{$camposTablaCiudadanos['seccion_electoral']}\" readonly";}?>>
    </div>
    <div>
        <label for="">Municipio</label>
        <input type="text" name="nameInputMunicipio" class="form-control" <?php if(!$camposTablaCiudadanos['municipio'] == null || !empty($camposTablaCiudadanos['municipio'])){echo "value=\"{$camposTablaCiudadanos['municipio']}\" readonly";}?>>
    </div>
    <div>
        <label for="">Origen</label>
        <input type="text" name="nameInputOrigen" class="form-control" <?php if(!$camposTablaCiudadanos['origen'] == null || !empty($camposTablaCiudadanos['origen'])){echo "value=\"{$camposTablaCiudadanos['origen']}\" readonly";}?>>
    </div>
    <div>
        <button class="btn btn-primary" type="submit" name="nameBtnEnviarFormulario"> <i class="fas fa-user-edit" aria-hidden="true"></i> Guardar e inscribir</button>
    </div>
</form>