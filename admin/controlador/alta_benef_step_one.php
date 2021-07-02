    <form method="POST" action="controlador/alta_benef_sql.php">
    <h4>Alta de beneficiarios</h4>
        <div class="form-row">
            <input type="hidden" name="id_beneficiario" value="">
            <div class="form-group col-md-2">
                <label for="nombres">Nombre(s)*</label>
                <input type="text" class="form-control" id="nombres" name="nombres" autofocus required>
            </div>

            <div class="form-group col-md-2">
                <label for="apellido_p">Apellido Paterno*</label>
                <input type="text" class="form-control" id="apellido_p" name="apellido_p" required>
            </div>

            <div class="form-group col-md-2">
                <label for="apellido_m">Apellido Materno*</label>
                <input type="text" class="form-control" id="apellido_m" name="apellido_m" required>
            </div>

            <div class="form-group col-md-2">
                <label for="fecha_nacimiento">Fecha Nacimiento</label>
                <input type="date" value="2020-01-01" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
            </div>

            <div class="form-group col-md-1">
                <label for="vulnerable">Vulnerable</label>
                <select class="form-control" id="vulnerable" name="vulnerable">
                <option value="no">No</option>
                <option value="si">Si</option>
                </select>
            </div>
            
            <div class="form-group col-md-1">
                <label for="nivel">Nivel</label>
                <select class="form-control" id="nivel" name="nivel">
                <option value="">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>

                </select>
            </div>

            <div class="form-group col-md-1">
                <label for="genero">Genero</label>
                <select class="form-control" id="genero" name="genero">
                <option value=""></option>
                <option value="m">M</option>
                <option value="f">F</option>
                </select>
            </div>
                    
        </div> <!--Termina row-->
        <br>

        <div class="form-row">
            
            <div class="form-group col-md-2">
                <label for="curp">Curp</label>
                <input type="text" class="form-control" id="curp" name="curp">
            </div>

            <div class="form-group col-md-2">
                <label for="numero_identificacion">Numero de Identificación</label>
                <input type="text" class="form-control" id="numero_identificacion" name="numero_identificacion">
            </div>

            <div class="form-group col-md-2">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            
            <div class="form-group col-md-2">
                <label for="telefono">Telefono
                </label>
                <input type="text" class="form-control" id="telefono" name="telefono">
            </div>
            <div class="form-group col-md-1">
                <label for="whats">Whatsapp</label>
                <select class="form-control" id="whats" name="whats">
                <option value=""></option>
                <option value="no">No</option>
                <option value="si">Si</option>
                </select>
            </div>

        </div> <!--Termina row-->




        <br>


        <div class="form-row">
                
                
            <div class="form-group col-md-2">
                <label for="dir_calle">Calle</label>
                <input type="text" class="form-control" id="dir_calle" name="dir_calle">
            </div>

            <div class="form-group col-md-1">
                <label for="dir_numero">Numero</label>
                <input type="text" class="form-control" id="dir_numero" name="dir_numero">
            </div>

            <div class="form-group col-md-1">
                <label for="dir_numero_int">Int.</label>
                <input type="text" class="form-control" id="dir_numero_int" name="dir_numero_int">
            </div>

            <div class="form-group col-md-2">
                <label for="id_colonia">Colonia</label>
                <select id="id_colonia" name="id_colonia" class="form-control">
                    <?php
                    $query = $mysqli -> query ("SELECT * FROM colonias");
                    while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="'.$valores['id'].'">'.$valores['nombre_colonia'].'</option>'; }?>
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="otra_colonia">Otra Colonia</label>
                <input type="text" class="form-control" id="otra_colonia" name="otra_colonia">
            </div>
            
            <div class="form-group col-md-3">
                <label for="dir_referencia">Referencia de domicilio</label>
                <input type="text" class="form-control" id="dir_referencia" name="dir_referencia">
            </div>

            

        </div> <!--Termina row-->

    <br>

<div class="form-row">

    <div class="form-group col-md-1">
        <label for="manzana">Manzana</label>
        <input type="text" class="form-control" id="manzana" name="manzana">
    </div>

    <div class="form-group col-md-1">
        <label for="lote">Lote</label>
        <input type="text" class="form-control" id="lote" name="lote">
    </div>

    <div class="form-group col-md-1">
        <label for="cp">Codigo Postal</label>
        <input type="number" class="form-control" id="cp" name="cp">
    </div>

    <div class="form-group col-md-2">
        <label for="estado_civil">Estado Civil</label>
        <select class="form-control" id="estado_civil" name="estado_civil">
        <option value="no respondio">No Respondio</option>
        <option value="soltero">Soltero</option>
        <option value="casado">Casado</option>
        <option value="divorciado">Divorciado</option>
        <option value="viudo">Viudo</option>

        </select>
    </div>

    <div class="form-group col-md-1">
        <label for="num_hijos">Numero Hijos</label>
        <input type="number" class="form-control" id="num_hijos" name="num_hijos">
    </div>

    <div class="form-group col-md-2">
        <label for="ocupacion">Ocupación</label>
        <input type="text" class="form-control" id="ocupacion" name="ocupacion">
    </div>

    <div class="form-group col-md-1">
        <label for="pensionado">Pensionado</label>
        <select class="form-control" id="pensionado" name="pensionado">
        <option value="no">No</option>
        <option value="si">Si</option>
        </select>
    </div>

    <div class="form-group col-md-2">
        <label for="enfermedades_cron">Enfermedades Cronicas</label>
        <input type="text" class="form-control" id="enfermedades_cron" name="enfermedades_cron">
    </div>   

</div>

<br>



    <div class="form-row">

        <div class="form-group col-md-1">
            <label for="zona_electoral">Zona Electoral</label>
            <input type="text" class="form-control" id="zona_electoral" name="zona_electoral">
        </div>

        <div class="form-group col-md-1">
            <label for="seccion_electoral">Sec. Electoral</label>
            <input type="text" class="form-control" id="seccion_electoral" name="seccion_electoral">
        </div>   

        <div class="form-group col-md-2">
            <label for="participo_eleccion">Participo Eleccion</label>
            <input type="text" class="form-control" id="participo_eleccion" name="participo_eleccion">
        </div> 

        <div class="form-group col-md-2">
            <label for="posicion">Posicion</label>
            <input type="text" class="form-control" id="posicion" name="posicion">
        </div>

        <div class="form-group col-md-1">
            <label for="asisitio">Asistio</label>
            <input type="text" class="form-control" id="asisitio" name="asisitio">
        </div>   

        <div class="form-group col-md-2">
            <label for="afiliacion">Afiliacion</label>
            <input type="text" class="form-control" id="afiliacion" name="afiliacion">
        </div>   

        <div class="form-group col-md-2">
            <label for="observaciones">Observaciones</label>
            <textarea type="text" class="form-control" id="observaciones" name="observaciones"> </textarea>
        </div>   


    </div>


<br>




    <div class="form-row">


        <div class="form-group col-md-2">
            <label for="origen">Origen</label>
            <select id="origen" name="origen" class="form-control">
                <?php
                $query = $mysqli -> query ("SELECT * FROM origenes");
                while ($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['id'].'">'.$valores['nombre'].'</option>'; }?>
            </select>
        </div>

        <div class="form-group col-md-2">
            <label for="promueve">Promueve</label>
            <select id="promueve" name="promueve" class="form-control">
                <?php
                $query = $mysqli -> query ("SELECT * FROM promotores");
                while ($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['id'].'">'.$valores['nombre'].'</option>'; }?>
            </select>
        </div>
        
        <div class="form-group col-md-2">
            <label for="medio">Medio</label>
            <select id="medio" name="medio" class="form-control">
                <?php
                $query = $mysqli -> query ("SELECT * FROM medio_contacto");
                while ($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['id'].'">'.$valores['nombre'].'</option>'; }?>
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

    <h5>Registrar un Auxiliar</h5>
        <div class="form-row">

            <div class="form-group col-md-2">
                <label for="nombres_auxiliar">Nombre(s) de Auxiliar</label>
                <input type="text" class="form-control" id="nombres_auxiliar" name="nombres_auxiliar">
            </div>

            <div class="form-group col-md-2">
                <label for="apellido_p_auxiliar">Apellido Paterno de Aux</label>
                <input type="text" class="form-control" id="apellido_p_auxiliar" name="apellido_p_auxiliar">
            </div>

            <div class="form-group col-md-2">
                <label for="apellido_m_auxiliar">Apellido Materno de Aux</label>
                <input type="text" class="form-control" id="apellido_m_auxiliar" name="apellido_m_auxiliar">
            </div>

            <div class="form-group col-md-2">
                <label for="telefono_auxiliar">Telefono de Aux</label>
                <input type="text" class="form-control" id="telefono_auxiliar" name="telefono_auxiliar">
            </div>

            <div class="form-group col-md-2">
                <label for="parentesco">Parentesco</label>
                <select class="form-control" id="parentesco" name="parentesco">
                <option value="">Ninguno</option>
                <option value="padre">Padre</option>
                <option value="hijo">Hijo</option>
                <option value="hermano">Hermano</option>
                <option value="nieto">Nieto</option>
                <option value="otro">Otro</option>
                </select>
            </div>

        </div>

    <br>
    <br>

        <button class="btn btn-primary" type="submit" name="guardar_salir" id="guardar_salir"> <i class="far fa-save mr-2"></i>  Guardar y Salir</button>
        <button class="btn btn-primary" type="submit" name="inscribir" id="inscribir" > <i class="fas fa-forward mr-2"></i> Inscribir a un Programa</button>
        
    
    </form>


    <?php $conn=null?>
    <?php mysqli_close($mysqli)?>
