<div class="containerFichasSolicitudRIS">
    <!-- Titulo de la solicitud -->
    <div class="fichaTituloSolicitudRIS">
        <p>
            Solicitud Folio.&#32;&#35;<span>getID</span>
        </p>
    </div>

    <!-- Contenido de la solicitud -->
    <div class="contenidoFichaSolicitudRIS">

        <!-- Seccion de solicitud -->
        <div class="bloqueContenidoSectionFichaRIS">
            <!-- Titulo de seccion -->
            <div class="contenidoFichaTituloContenedorRIS" onclick="expandirInformacionDeSolicitud(this);">
                <div class="separadorContenidoFichaTituloRIS">
                    <p>Archivos</p>
                </div>
                <span class="lineaVisionContenedorFichaTituloRIS"></span>
            </div>

            <!-- Contenedor expandible al dar click -->
            <div class="contenedorExpandibleElementosFRIS">
                <!-- Contenedor vacio cuando NO existen archivos -->
                <div class="fichaSinElementosMsgRIS">
                    <p>
                        Sin Archivos
                    </p>
                </div>
                <!-- Contenedor de fichas cuando existen archivos -->
                <div class="contenedorFichasArchivosElementosRIS">
                    <!-- Tipo de contenedor para IMG -->
                    <a class="etiquetaArchivoSEenRIS" download="#">
                        <div class="fichaArchivoOnGridRIS">
                            <div class="contenedorEtiquetasFichasArchivosRIS">
                                <span class="etiquetaFichaArchivoTipoRIS etiquetaFichaArchivoTipoRISIMG">
                                    img
                                </span>
                            </div>
                            <div class="contenedorEtiquetasFichasArchivosRIS">
                                <p>
                                    TipoArchivo
                                </p>
                            </div>
                        </div>
                    </a>

                    <!-- Tipo de contenedor para PDF -->
                    <a class="etiquetaArchivoSEenRIS" download="#">
                        <div class="fichaArchivoOnGridRIS">
                            <div class="contenedorEtiquetasFichasArchivosRIS">
                                <span class="etiquetaFichaArchivoTipoRIS etiquetaFichaArchivoTipoRISPDF">
                                    pdf
                                </span>
                            </div>
                            <div class="contenedorEtiquetasFichasArchivosRIS">
                                <p>
                                    TipoArchivo
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Contenedor de formulario para subir archivos -->
                <div class="contenedorFichasSubirArchivoNuevoRIS">
                    <form enctype="multipart/form-data">
                        <!-- Contenedor asignar nombre -->
                        <div class="contenedorAsignarNombreParaFormularioRIS OcultarSeccionSubirArchivos">
                            <div class="contenedorContenidoFichaSubirArchivosRIS">
                                <div class="fichaTituloAsirgnarParaFormularioRIS">
                                    <p>
                                        Asignar título (obligatorio)
                                    </p>
                                </div>
                                <div class="fichaTituloAsirgnarParaFormularioRIS">
                                    <input type="text" class="inputTextAsirgnarParaFormularioRIS" placeholder="Título">
                                </div>
                            </div>
                        </div>

                        <!-- Contenedor Archivo -->
                        <div class="contenedorArchivosParaFormularioRIS OcultarSeccionSubirArchivos">
                            <!-- Boton Subir Archivo - Mostrar nombre -->
                            <div class="contenedorContenidoFichaSubirArchivosRIS">   
                                <input type="file"  class="OcultarSeccionSubirArchivos" id="SubirArchivoClick">
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
                                <input type="button" class="botonSubirArchivoRIS" value="Subir">
                            </div>
                        </div>  
                    </form>
                </div>

            <!-- Etiquetas de cierre para seccion de la solicitud -->
            </div>
        </div>















        <!-- Seccion de solicitud -->
        <div class="bloqueContenidoSectionFichaRIS">
            <!-- Titulo de seccion -->
            <div class="contenidoFichaTituloContenedorRIS" onclick="expandirInformacionDeSolicitud(this);">
                <div class="separadorContenidoFichaTituloRIS">
                    <p>relleno</p>
                </div>
                <span class="lineaVisionContenedorFichaTituloRIS"></span>
            </div>

            <!-- Contenedor expandible al dar click -->
            <div class="contenedorExpandibleElementosFRIS">
                
                texto de relleno para verificar
            <!-- Etiquetas de cierre para seccion de la solicitud -->
            </div>
        </div>
















    <!-- Etiquetas de cierre para el contenido de la solicitud -->
    </div>
</div>

<script src="NuevoProgramas/Js/FuncionesSolicitud.js">
</script>