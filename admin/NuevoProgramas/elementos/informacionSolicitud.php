<!-- Titulo de la pagina -->
<div class="contenedorTituloIS">
    <p>
        información de la solicitud
    </p>
</div>

<!-- Ficha de informacion, crear una por seccion (ejemplo; contacto, ubicacion, etc) -->
<div class="contenedorFichaTIS">
    <!-- ficha de titulo que al darle click muestra/oculta resultados -->
    <div class="contenedorTituloIS contenedorFichaTISTitulo" onclick="abrirContenedor(this);">
        <p>
            Información solicitante
        </p>
    </div>

    <!-- contenedor para ocultar registros en caso de ser necesario -->
    <form action="#" class="formulariopruebas">
        <container>
            <!-- tabla con la informacion requerida -->
            <div class="contenedorFilasTablaInformacionIS">
                <!-- Esta fila debera ser dinamica y completada con la informacion de la base de datos -->
                <div class="filasISInformacionColumnas">
                    <div class="contenedorFilaColumnaInformacionIS">
                        <p>
                            Nombre
                        </p>
                    </div>
                    <div class="contenedorFilaColumnaInformacionIS">
                        <input type="text" placeholder="Dato" class="InputFilaColumnaInformacionIS inputTypeIS" value="Nombre" disabled>
                    </div>
                </div>
                 <!-- Esta fila debera ser dinamica y completada con la informacion de la base de datos -->
                 <div class="filasISInformacionColumnas">
                    <div class="contenedorFilaColumnaInformacionIS">
                        <p>
                            Edad
                        </p>
                    </div>
                    <div class="contenedorFilaColumnaInformacionIS">
                        <input type="text" placeholder="Dato" class="InputFilaColumnaInformacionIS inputTypeIS" value="99" disabled>
                    </div>
                </div>
                <!-- Esta fila debera ser dinamica y completada con la informacion de la base de datos -->
                <div class="filasISInformacionColumnas">
                    <div class="contenedorFilaColumnaInformacionIS">
                        <p>
                            Genero
                        </p>
                    </div>
                    <div class="contenedorFilaColumnaInformacionIS">
                        <input type="text" placeholder="Dato" class="InputFilaColumnaInformacionIS inputTypeIS" value="A" disabled>
                    </div>
                </div>
            </div>


            <!--
                Al presionar el boton de editar se debe recorrer el formulario y pasar los input a un estado activo
                el boton de guardar envia el formulario mientras que el boton de cancelar oculta los botones y muestra el de edicion
                desacxtivando los input        
            -->

            <!-- Boton que al clickear activa el formulario -->
            <div class="contenedorBotonesIS">
                <input type="button" class="botonEditarISForm" value="Editar" onclick="editarFormulario(this);">
            </div>
            
            <!-- Botones de formulario -->
            <div class="contenedorBotonesIS contenedorBotonesISAccionesGC">
                <input type="button" class="botonEditarISForm botonEditarISFormC" value="Cancelar" onclick="botonCancelarFormulario(this);">
                <input type="button" class="botonEditarISForm botonEditarISFormG" value="Guardar">
            </div>

            

        </container>
    </form>
</div>





<script src="NuevoProgramas/Js/Funciones.js">
</script>