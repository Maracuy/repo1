<div class="containerFichasSolicitudRIS">
    <!-- Titulo de la solicitud -->
    <div class="fichaTituloSolicitudRIS">
        <p>
            Solicitud Folio.&#32;&#35;<span>getID</span>
        </p>
    </div>

    <!-- Contenido de la solicitud -->
    <div class="contenidoFichaSolicitudRIS">

        <!-- Seccion de solicitud [Documentos] -->
        <div class="bloqueContenidoSectionFichaRIS">
            <!-- Titulo de seccion -->
           <div class="contenidoFichaTituloContenedorRIS claseEditableFormularioRIS" onclick="expandirInformacionDeSolicitud(this);generarDocumentos();">
                <div class="separadorContenidoFichaTituloRIS">
                    <p>Archivos</p>
                </div>
                <span class="lineaVisionContenedorFichaTituloRIS"></span>
            </div>
            <!-- Contenedor expandible al dar click -->
            <div class="contenedorExpandibleElementosFRIS">
                <!-- contenedor de las fichas -->
                <div id="contenedorFichaDocumentosSg">
                </div>
                <!-- Llamada a los documentos -->
                <script>
                    <?php
                    $idUsuario = strip_tags(htmlspecialchars($_GET['ids']));
                    ?>

                    function tiempoReal(){
                        var tabla = $.ajax({
                            url: 'NuevoProgramas/Externo/consultarDocumentos.php?ids=' + <?=$idUsuario?>,
                            dataType: 'text'
                        }).done(function(res){
                            let contenedor = document.getElementById("contenedorFichaDocumentosSg");
                            if(res == ""){
                                contenedor.innerHTML = '<div class=\"fichaSinElementosMsgRIS\"><p>Sin Archivos</p></div>';
                            }else{
                                contenedor.innerHTML = res;
                            }
                        });
                    }
                    // actualizacion de documentos cada 3s (pausar el ciclo si se encuentra cerrada la pestaña)
                   // tiempoReal();
                  //  generarDocumentos();

                    var mostrarDocumentosAutomaticos = false;
                    function generarDocumentos(){
                        mostrarDocumentosAutomaticos ^= true;
                        var llamadaABase = setInterval(function(){
                            (mostrarDocumentosAutomaticos) ? clearInterval(llamadaABase) : tiempoReal();
                        }, 3000); 
                    }
                </script>
                <!-- Contenedor de formulario para subir archivos -->
                <div class="contenedorFichasSubirArchivoNuevoRIS">
                    <form enctype="multipart/form-data" id="formularioSubirArchivoFichaRIS2" method="post" action="NuevoProgramas/Externo/subirArchivo.php">
                        <!-- Contenedor con id -->
                        <input type="text" value="<?=$_GET['ids'];?>" name="campoNameSubirRIS0" hidden>
                        <!-- Contenedor asignar nombre -->
                        <div class="contenedorAsignarNombreParaFormularioRIS OcultarSeccionSubirArchivos">
                            <div class="contenedorContenidoFichaSubirArchivosRIS">
                                <div class="fichaTituloAsirgnarParaFormularioRIS">
                                    <p>
                                        Asignar título (obligatorio, de 2 a 30 caracteres)
                                    </p>
                                </div>
                                <div class="fichaTituloAsirgnarParaFormularioRIS">
                                    <input type="text" id="campoTituloSubirArchivoFichaRIS2" class="inputTextAsirgnarParaFormularioRIS" placeholder="Título" name="campoNameSubirRIS1">
                                </div>
                            </div>
                        </div>
                        <!-- Contenedor Archivo -->
                        <div class="contenedorArchivosParaFormularioRIS OcultarSeccionSubirArchivos">
                            <!-- Boton Subir Archivo - Mostrar nombre -->
                            <div class="contenedorContenidoFichaSubirArchivosRIS">   
                                <input type="file"  class="OcultarSeccionSubirArchivos" id="SubirArchivoClick" name="campoNameSubirRIS2">
                                <label class="labelCambiaEstadoSubirArchivosRIS" for="SubirArchivoClick">
                                    <span>
                                        Sin Archivo
                                    </span>
                                </label>
                            </div>

                            <!-- Mensajes de error -->
                            <div class="contenedorContenidoFichaSubirArchivosRIS OcultarSeccionSubirArchivos" id="contenedorMensajeError">   
                                <div class="contenedorMensajeErrorSubirArchivos">
                                    <p>
                                        Mensaje de error
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Botones que interactuan con el formulario -->
                        <div class="contenedorContenidoFichaSubirArchivosRIS">
                            <!-- Boton que activa formulario -->
                            <div class="contenedorBotonesSubirArchivoRIS">
                                <input type="button" class="botonSubirArchivoRIS" value="Subir Imagen ó PDF" onclick="expandirInputFile(this);">
                            </div>
                            <!-- Botones que interactuan con el formulario -->
                            <div class="contenedorBotonesSubirArchivoRIS OcultarSeccionSubirArchivos">
                                <input type="button" class="botonSubirArchivoRIS" value="Cancelar" onclick="reducirInputFile(this);">
                                <input type="submit" class="botonSubirArchivoRIS" value="Subir">
                            </div>
                        </div>
                        <!-- Mensaje de error en respuesta del servidor -->
                        <div class="contenedorMensajeDeErrorRespuestaRIS OcultarSeccionMensajeError" id="contenedorMensajeDeErrorRespuestaRIS">
                            <p>
                                Mensaje de error
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>


















        <!-- Seccion de solicitud [Propiedades] -->
        <div class="bloqueContenidoSectionFichaRIS">
            <!-- Titulo de seccion -->
            <div class="contenidoFichaTituloContenedorRIS" onclick="expandirInformacionDeSolicitud(this);">
                <div class="separadorContenidoFichaTituloRIS">
                    <p>Propiedades</p>
                </div>
                <span class="lineaVisionContenedorFichaTituloRIS"></span>
            </div>
            <!-- Contenedor expandible al dar click -->
            <div class="contenedorExpandibleElementosFRIS">


                
                <div class="contenedorFichasFlexGridRIS">
                    <div class="contenedorPanelPropiedadesDocumentoRIS">
                        <div class="contenedorElementosFichasPropiedadesRIS">
                            <div class="fichasElementosPropiedadesRIS">
                                <p>
                                    Titulo de propiedad 1
                                </p>
                            </div>
                            <div class="fichasElementosPropiedadesRIS">
                                <input type="checkbox" id="checkboxPropiedades1" class="inputCheckboxPropiedades" hidden>
                                <label for="checkboxPropiedades1" class="switchCambiarEstadoPropiedadesRIS"></label>
                            </div>
                        </div>
                        <div class="contenedorElementosFichasPropiedadesRIS">
                            <div class="fichasElementosPropiedadesRIS">
                                <p>
                                    Titulo de propiedad 2
                                </p>
                            </div>
                            <div class="fichasElementosPropiedadesRIS">
                                <input type="checkbox" id="checkboxPropiedades2" class="inputCheckboxPropiedades" hidden>
                                <label for="checkboxPropiedades2" class="switchCambiarEstadoPropiedadesRIS"></label>
                            </div>
                        </div>
                    </div>

                    <div class="contenedorPanelPropiedadesDocumentoRIS">
                        <div class="contenedorElementosFichasPropiedadesRIS">
                            <div class="fichasElementosPropiedadesRIS">
                                <p>
                                    Titulo de propiedad 3
                                </p>
                            </div>
                            <div class="fichasElementosPropiedadesRIS">
                                <input type="checkbox" id="checkboxPropiedades3" class="inputCheckboxPropiedades" hidden>
                                <label for="checkboxPropiedades3" class="switchCambiarEstadoPropiedadesRIS"></label>
                            </div>
                        </div>
                        <div class="contenedorElementosFichasPropiedadesRIS">
                            <div class="fichasElementosPropiedadesRIS">
                                <p>
                                    Titulo de propiedad 4
                                </p>
                            </div>
                            <div class="fichasElementosPropiedadesRIS">
                                <input type="checkbox" id="checkboxPropiedades4" class="inputCheckboxPropiedades" hidden>
                                <label for="checkboxPropiedades4" class="switchCambiarEstadoPropiedadesRIS"></label>
                            </div>
                        </div>
                    </div>
                </div>



            <!-- Etiquetas de cierre para seccion de la solicitud -->
            </div>
        </div>




















        

        <!-- Seccion de solicitud [Anotaciones] -->
        <div class="bloqueContenidoSectionFichaRIS">
            <!-- Titulo de seccion -->
            <div class="contenidoFichaTituloContenedorRIS" id="seccionNotasDinamicas">
                <div class="separadorContenidoFichaTituloRIS">
                    <p>Anotaciones</p>
                </div>
                <span class="lineaVisionContenedorFichaTituloRIS"></span>
            </div>

            <!-- Contenedor expandible al dar click -->
            <div class="contenedorExpandibleElementosFRIS contenedorExpandibleElementosFRISNTV">
                
                <!-- Contenedor de notas -->
                <div class="contenedorNotasDinamicasGeneradasRIS" id="contenedorNotasDinamicasGeneradasRIS">             
                </div>

                <!-- Obtener notas con AJAX -->
                <?php
                    $solicitudNota = strip_tags(htmlspecialchars($_GET['ids']));
                ?>
               
                <script>
                    // Obtener notas dinamicamente
                    function actualizarDatos(){
                        let idSolicitud = <?=$solicitudNota;?>;
                        var link = 'NuevoProgramas/Externo/consultarNotas.php?idSolicitud=' + idSolicitud;
                        var tabla = $.ajax({
                            url: link,
                            dataType: 'text'
                        }).done(function(res){
                                document.getElementById("contenedorNotasDinamicasGeneradasRIS").innerHTML = res;
                        });
                    }

                    // Ocultar/Mostrar seccion y consultar datos
                    function lanzarFuncionesNotas(){
                        // Obtener datos
                        actualizarDatos();
                        // Expandir/Reducir
                        expandirInformacionDeSolicitud(this);
                        
                    }

                    // Asignar evento click a la seccion
                    document.getElementById("seccionNotasDinamicas").addEventListener("click", lanzarFuncionesNotas);
                </script>
              
                <!-- Crear nueva nota -->
                <div class="contenedorPropiedadesNotasEditablesRIS">
                    <form class="formularioNotasRIS" id="formularioEnviarNotaNueva">
                        <div class="contenedorAgregarAnotacionFichaRIS">
                            <textarea class="inputTextGenericoNotasFichasEnRIS" name="textareaNotas" placeholder="Escribir nueva nota (15 a 500 caracteres)" id="textareaNotas">
                            </textarea>
                           
                            <input type="text" value="<?=$solicitudNota;?>" id="solicitudPropietarioId" hidden>
                        </div>
                        <div class="contenedorBotonesAgregarNuevaNotaRIS">
                            <input type="button" class="botonGenericoAgregarNotaRIS" value="Limpiar" onclick="limpiarTextArea();">
                            <input type="submit" class="botonGenericoAgregarNotaRIS" value="Guardar">
                        </div>
                    </form>
                </div>

            <!-- Etiquetas de cierre para seccion de la solicitud -->
            </div>
        </div>


        






        <!-- Seccion de solicitud [Plantilla] -->
        <div class="bloqueContenidoSectionFichaRIS">
            <!-- Titulo de seccion -->
            <div class="contenidoFichaTituloContenedorRIS" onclick="expandirInformacionDeSolicitud(this);">
                <div class="separadorContenidoFichaTituloRIS">
                    <p>Plantilla</p>
                </div>
                <span class="lineaVisionContenedorFichaTituloRIS"></span>
            </div>

            <!-- Contenedor expandible al dar click -->
            <div class="contenedorExpandibleElementosFRIS">
                
                <p>
                    Plantilla generica para crear nuevas secciones de la solicitud
                </p>
            <!-- Etiquetas de cierre para seccion de la solicitud -->
            </div>
        </div>

    <!-- Etiquetas de cierre para el contenido de la solicitud -->
    </div>
</div>

<!-- Ventana modal generica -->
<div class="bannerVentanaModalGenericaRIS ocultarVentanaModalGenerica" id="bannerVentanaModalGenericaRIS">
    <span class="botonCerrarModalGenericaRIS" onclick="ocultarVentanaModal(this);">
    </span>
    <div class="contenedorMensajeBannerGenericoRIS">
        <p>
            Mensaje
        </p>
    </div>
</div>

<script src="NuevoProgramas/Js/FuncionesSolicitud.js">
</script>