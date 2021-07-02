<form method="POST" action="controlador/alta_benef_sql.php">


<?php
        $id = $_GET['id'];
        $sql_query = $con->prepare('SELECT * FROM beneficiarios WHERE id_beneficiario = ?');
        $sql_query->execute(array($id));
        $editable = $sql_query->fetch();

?>

<input type="hidden" id="id_beneficiario" name="id_beneficiario" value="<?php echo $id?>">
<input type="hidden" name="fecha_captura" value="<?php echo $editable['fecha_captura']?>">

<div class="espaciadormio" style="height: 20px;"></div>



    <div class="form-row">
        <div class="form-group col-md-4">
            <h4>Editar Beneficiario</h4>
        </div>

        <div class="form-group col-md-5">
            <a href="beneficiarios.php" class="btn btn-danger"> <i class="far fa-times-circle"></i>  Salir sin guardar </a>
        </div>

        <div class="form-group col-md-3">
            <a  href="programas.php?id=<?php echo $id ?>" class="btn btn-success"> <i class="fas fa-hands-helping"></i> Programas y proceso </a>
        </div>
    </div>



    <div class="espaciadormio" style="height: 30px;"></div>



    <div class="form-row">

        <div class="form-group col-md-2">
            <label for="nombres">Nombre(s)*</label>
            <input type="text" value="<?php echo $editable['nombres']?>" class="form-control" id="nombres" name="nombres">
        </div>

        <div class="form-group col-md-2">
            <label for="apellido_p">Apellido Paterno*</label>
            <input type="text" value="<?php echo $editable['apellido_p']?>" class="form-control" id="apellido_p" name="apellido_p" required>
        </div>

        <div class="form-group col-md-2">
            <label for="apellido_m">Apellido Materno*</label>
            <input type="text"  value="<?php echo $editable['apellido_m']?>" class="form-control" id="apellido_m" name="apellido_m" required>
        </div>

        <div class="form-group col-md-2">
            <label for="fecha_nacimiento">Fecha Nacimiento</label>
            <input type="date" value="<?php echo $editable['fecha_nacimiento']?>" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
        </div>

        <div class="form-group col-md-1">
            <label for="vulnerable">Vulnerable</label>
            <select class="form-control" id="vulnerable" name="vulnerable">
            <?php if ($editable['vulnerable'] == "") echo "<option value=''> No seleccionado </option>"; ?>
            <option <?php if ($editable['vulnerable'] == "no" ) echo 'selected' ; ?> value="no" >No</option>
            <option <?php if ($editable['vulnerable'] == "si" ) echo 'selected' ; ?> value="si">Si</option>
            </select>
        </div>
        
        <div class="form-group col-md-1">
            <label for="nivel">Nivel</label>
            <select class="form-control" id="nivel" name="nivel">
            <?php if($editable['nivel'] == "") echo "<option value=''> No seleccionado </option>"; ?>
            <option <?php if ($editable['nivel'] == "0" ) echo 'selected' ; ?> value="">0</option>
            <option <?php if ($editable['nivel'] == "1" ) echo 'selected' ; ?> value="1">1</option>
            <option <?php if ($editable['nivel'] == "2" ) echo 'selected' ; ?> value="2">2</option>
            <option <?php if ($editable['nivel'] == "3" ) echo 'selected' ; ?> value="3">3</option>
            <option <?php if ($editable['nivel'] == "4" ) echo 'selected' ; ?> value="4">4</option>
            <option <?php if ($editable['nivel'] == "5" ) echo 'selected' ; ?> value="5">5</option>

            </select>
        </div>

        <div class="form-group col-md-1">
            <label for="genero">Genero</label>
            <select class="form-control" id="genero" name="genero">
            <?php 
                if($editable['genero'] == "") echo "<option value=''> No seleccionado </option>";?>
            <option <?php if ($editable['genero'] == "m" ) echo 'selected' ; ?> value="m">M</option>
            <option <?php if ($editable['genero'] == "f" ) echo 'selected' ; ?> value="f">F</option>
            </select>
        </div>
                
    </div> <!--Termina row-->
    <br>

    <div class="form-row">
        
        <div class="form-group col-md-2">
            <label for="curp">Curp</label>
            <input type="text" value="<?php echo $editable['curp']?>" class="form-control" id="curp" name="curp">
        </div>

        <div class="form-group col-md-2">
            <label for="numero_identificacion">Numero de Identificación</label>
            <input type="text" value="<?php echo $editable['numero_identificacion']?>" class="form-control" id="numero_identificacion" name="numero_identificacion">
        </div>

        <div class="form-group col-md-2">
            <label for="email">Email</label>
            <input type="text" value="<?php echo $editable['email']?>" class="form-control" id="email" name="email">
        </div>
        
        <div class="form-group col-md-2">
            <label for="telefono">Telefono
            </label>
            <input type="text" value="<?php echo $editable['telefono']?>" class="form-control" id="telefono" name="telefono">
        </div>

        <div class="form-group col-md-1">
            <label for="whats">Whatsapp</label>
            <select class="form-control" id="whats" name="whats">
            <?php if($editable['whats'] == "") echo "<option value=''> No seleccionado </option>"; ?>
            <option <?php if ($editable['whats'] == "no" ) echo 'selected' ;?> value="no">No</option>
            <option <?php if ($editable['whats'] == "si" ) echo 'selected' ;?> value="si">Si</option>
            </select>
        </div>

    </div> <!--Termina row-->




    <br>


    <div class="form-row">
            
            
        <div class="form-group col-md-2">
            <label for="dir_calle">Calle</label>
            <input type="text" value="<?php echo $editable['dir_calle']?>" class="form-control" id="dir_calle" name="dir_calle">
        </div>

        <div class="form-group col-md-1">
            <label for="dir_numero">Numero</label>
            <input type="text" value="<?php echo $editable['dir_numero']?>" class="form-control" id="dir_numero" name="dir_numero">
        </div>

        <div class="form-group col-md-1">
            <label for="dir_numero_int">Numero int.</label>
            <input type="text" value="<?php echo $editable['dir_numero_int']?>" class="form-control" id="dir_numero_int" name="dir_numero_int">
        </div>

        <div class="form-group col-md-2">
            <label for="id_colonia">Colonia</label>
            <select id="id_colonia" name="id_colonia" class="form-control">
                <?php
                $query = $mysqli->query("SELECT * FROM colonias");
                while ($colonias = mysqli_fetch_array($query)) {
                echo '<option ' . $selected = ($editable['id_colonia'] == $colonias['íd']) ? "selected" : "" .' value="'.$colonias['id'].'">'.$colonias['nombre_colonia'].'</option>'; }?>
            </select>
        </div>

        <div class="form-group col-md-2">
            <label for="otra_colonia">Otra Colonia</label>
            <input type="text" value="<?php echo $editable['otra_colonia']?>" class="form-control" id="otra_colonia" name="otra_colonia">
        </div>
        
        <div class="form-group col-md-3">
            <label for="dir_referencia">Referencia de domicilio</label>
            <input type="text" value="<?php echo $editable['dir_referencia']?>" class="form-control" id="dir_referencia" name="dir_referencia">
        </div>

        

    </div> <!--Termina row-->
<br>

<div class="form-row">


    <div class="form-group col-md-1">
        <label for="manzana">Manzana</label>
        <input type="text" value="<?php echo $editable['manzana']?>" class="form-control" id="manzana" name="manzana">
    </div>

    <div class="form-group col-md-1">
        <label for="lote">Lote</label>
        <input type="text" value="<?php echo $editable['lote']?>" class="form-control" id="lote" name="lote">
    </div>

    <div class="form-group col-md-1">
        <label for="cp">Codigo Postal</label>
        <input type="number" value="<?php echo $editable['cp']?>" class="form-control" id="cp" name="cp">
    </div>

    <div class="form-group col-md-2">
        <label for="estado_civil">Estado Civil</label>
        <select class="form-control" id="estado_civil" name="estado_civil">
        <?php if($editable['estado_civil'] == "") echo "<option value=''> No seleccionado </option>"; ?>
        <option <?php if ($editable['whats'] == "no respondio" ) echo 'selected' ;?> value="no respondio">No Respondio</option>
        <option <?php if ($editable['whats'] == "soltero" ) echo 'selected' ;?> value="soltero">Soltero</option>
        <option <?php if ($editable['whats'] == "casado" ) echo 'selected' ;?> value="casado">Casado</option>
        <option <?php if ($editable['whats'] == "divorciado" ) echo 'selected' ;?> value="divorciado">Divorciado</option>
        <option <?php if ($editable['whats'] == "viudo" ) echo 'selected' ;?> value="viudo">Viudo</option>

        </select>
    </div>

    <div class="form-group col-md-1">
        <label for="num_hijos">Numero Hijos</label>
        <input type="number" value="<?php echo $editable['num_hijos']?>" class="form-control" id="num_hijos" name="num_hijos">
    </div>

    <div class="form-group col-md-2">
        <label for="ocupacion">Ocupación</label>
        <input type="text" value="<?php echo $editable['ocupacion']?>" class="form-control" id="ocupacion" name="ocupacion">
    </div>

    <div class="form-group col-md-1">
        <label for="pensionado">Pensionado</label>
        <select class="form-control" id="pensionado" name="pensionado">
        <?php if($editable['pensionado'] == "") echo "<option value=''> No seleccionado </option>"; ?>
        <option <?php if ($editable['pensionado'] == "no" ) echo 'selected' ;?> value="no">No</option>
        <option <?php if ($editable['pensionado'] == "si" ) echo 'selected' ;?> value="si">Si</option>
        </select>
    </div>

    <div class="form-group col-md-2">
        <label for="enfermedades_cron">Enfermedades Cronicas</label>
        <input type="text" value="<?php echo $editable['enfermedades_cron']?>" class="form-control" id="enfermedades_cron" name="enfermedades_cron">
    </div>

</div>

<br>

<div class="form-row">

        <div class="form-group col-md-1">
            <label for="zona_electoral">Zona Electoral</label>
            <input type="text" value="<?php echo $editable['zona_electoral']?>" class="form-control" id="zona_electoral" name="zona_electoral">
        </div>

        <div class="form-group col-md-1">
            <label for="seccion_electoral">Sec. Electoral</label>
            <input type="text" value="<?php echo $editable['seccion_electoral']?>" class="form-control" id="seccion_electoral" name="seccion_electoral">
        </div>   

        <div class="form-group col-md-2">
            <label for="participo_eleccion">Participo Eleccion</label>
            <input type="text" value="<?php echo $editable['participo_eleccion']?>" class="form-control" id="participo_eleccion" name="participo_eleccion">
        </div> 

        <div class="form-group col-md-2">
            <label for="posicion">Posicion</label>
            <input type="text" value="<?php echo $editable['posicion']?>" class="form-control" id="posicion" name="posicion">
        </div>

        <div class="form-group col-md-1">
            <label for="asisitio">Asistio</label>
            <input type="text" value="<?php echo $editable['asisitio']?>" class="form-control" id="asisitio" name="asisitio">
        </div>   

        <div class="form-group col-md-2">
            <label for="afiliacion">Afiliacion</label>
            <input type="text" value="<?php echo $editable['afiliacion']?>" class="form-control" id="afiliacion" name="afiliacion">
        </div>   

        <div class="form-group col-md-2">
            <label for="observaciones">Observaciones</label>
            <textarea type="text" value="<?php echo $editable['observaciones']?>" class="form-control" id="observaciones" name="observaciones"> </textarea>
        </div>   


    </div>




<br>

    <div class="form-row">


        <div class="form-group col-md-2">
            <label for="origen">Origen</label>
            <select id="origen" name="origen" class="form-control">
                <?php
                $query = $mysqli -> query ("SELECT * FROM origenes");
                while ($origenes = mysqli_fetch_array($query)) {
                    echo '<option ' . $selected = ($editable['id_origenes'] == $origenes['íd']) ? "selected" : "" .' value="'.$origenes['id'].'">'.$origenes['nombre'].'</option>'; }?>
                </select>
        </div>

        <div class="form-group col-md-2">
            <label for="promueve">Promueve</label>
            <select id="promueve" name="promueve" class="form-control">
                <?php
                $query = $mysqli -> query ("SELECT * FROM promotores");
                while ($promotores = mysqli_fetch_array($query)) {
                    echo '<option ' . $selected = ($editable['id_promotores'] == $promotores['íd']) ? "selected" : "" .' value="'.$promotores['id'].'">'.$promotores['nombre'].'</option>'; }?>
            </select>
        </div>
        
        <div class="form-group col-md-2">
            <label for="medio">Medio</label>
            <select id="medio" name="medio" class="form-control">
                <?php
                $query = $mysqli -> query ("SELECT * FROM medio_contacto");
                while ($medios = mysqli_fetch_array($query)) {
                    echo '<option ' . $selected = ($editable['id_promotores'] == $medios['íd']) ? "selected" : "" .' value="'.$medios['id'].'">'.$medios['nombre'].'</option>'; }?>
            </select>
        </div>



    </div> <!--Termina row-->
<br>

<table class="table">
        <thead>
            <tr>
            <th scope="col">Identificación</th>
            <th scope="col">CURP</th>
            <th scope="col">Acta Nac.</th>
            <th scope="col">Domicilio</th>
            <th scope="col">Escrituras</th>
            <th scope="col">Comp. Medico</th>

            </tr>
        </thead>
    <tbody>
        <tr>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <td><button class="btn btn-primary" type="submit" name="guardar_salir" id="guardar_salir"> <i class="fas fa-file-upload"> </i> Subir </button></td>
            <td><button class="btn btn-primary" type="submit" name="guardar_salir" id="guardar_salir"> <i class="fas fa-file-upload"> </i> Subir </button></td>
            <td><button class="btn btn-primary" type="submit" name="guardar_salir" id="guardar_salir"> <i class="fas fa-file-upload"> </i> Subir </button></td>
            <td><button class="btn btn-primary" type="submit" name="guardar_salir" id="guardar_salir"> <i class="fas fa-file-upload"> </i> Subir </button></td>
            <td><button class="btn btn-primary" type="submit" name="guardar_salir" id="guardar_salir"> <i class="fas fa-file-upload"> </i> Subir </button></td>
            <td><button class="btn btn-primary" type="submit" name="guardar_salir" id="guardar_salir"> <i class="fas fa-file-upload"> </i> Subir </button></td>
        </tr>
    </tbody>
    </table>





<br>


    <div class="dropdown-divider"></div>

<br>

<!--Aqui viene en area del registro del auxiliar-->

<?php
$sql_query = $con->prepare("SELECT COUNT(*) total FROM auxiliares WHERE id_beneficiario = ?");
$sql_query->execute(array($id));
$no_auxiliares = $sql_query->fetch();




if($no_auxiliares['total'] >= 1): 

    $sql_query = $con->prepare("SELECT * FROM auxiliares WHERE id_beneficiario = ?");
    $sql_query->execute(array($id));
    $auxiliares = $sql_query->fetchAll();
    echo "<h4>Auxiliares Registrados:</h4>";

?>



    
    <?php foreach($auxiliares as $auxiliar): ?>
        <div class="form-row">

            <div class="form-group col-md-2">
                <label for="nombres_auxiliar">Nombre(s) de Auxiliar</label> <br>
                <?php echo $auxiliar['nombres_auxiliar']?>
            </div>

            <div class="form-group col-md-2">
                <label for="apellido_p_auxiliar">Apellido Paterno de Aux</label><br>
                <?php echo $auxiliar['apellido_p_auxiliar']?>
            </div>

            <div class="form-group col-md-2">
                <label for="apellido_m_auxiliar">Apellido Materno de Aux</label><br>
                <?php echo $auxiliar['apellido_m_auxiliar']?>
            </div>

            <div class="form-group col-md-2">
                <label for="telefono_auxiliar">Telefono de Aux</label><br>
                <?php echo $auxiliar['telefono_auxiliar']?>
            </div>

            <div class="form-group col-md-2">
                <label for="parentesco">Parentesco</label><br>
                
                    <?php if($auxiliar['parentesco'] == "") echo "<option value=''> No seleccionado </option>"; ?>
                    <?php echo $auxiliar['parentesco']?>
            </div>

            <div class="form-group col-md-2">
                <label for="parentesco">Editar</label><br>
                
                <a href="auxiliar.php?id=<?php echo $auxiliar['id_auxiliar']?>&tipo=edita"> <i class="far fa-edit"></i></a>
            </div>

        </div>
    <?php endforeach;?>
<?php endif;
if($no_auxiliares['total'] == 0){
    echo "<h4> No cuenta con Auxiliares</h4>";
}
?>


<a href="auxiliar.php?id=<?php echo $id."&tipo=nuevo" ?>" class="btn btn-success"> <i class="fas fa-user-friends"></i> Registrar nuevo Auxiliar </a>
    

<div class="espaciadormio" style="height: 50px;"></div>


<br>
<br>

    <button class="btn btn-primary" type="submit" name="actualizar" id="actualizar"> <i class="fas fa-user-edit"></i>  Guardar Todos los Cambios</button>
    <button class="btn btn-danger" type="submit" name="actualizar" id="actualizar"> <i class="far fa-times-circle"></i>  Salir sin guardar</button>
    
    
  
</form>


<?php $con=null?>
<?php mysqli_close($mysqli)?>
