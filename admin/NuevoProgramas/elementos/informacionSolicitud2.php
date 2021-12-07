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
            <div class="contenidoFichaTituloContenedorRIS claseEditableFormularioRIS" onclick="expandirInformacionDeSolicitud(this);">
                <div class="separadorContenidoFichaTituloRIS">
                    <p>Archivos</p>
                </div>
                <span class="lineaVisionContenedorFichaTituloRIS"></span>
            </div>

            <!-- Contenedor expandible al dar click -->
            <div class="contenedorExpandibleElementosFRIS">
                <!-- Contenedor vacio cuando NO existen archivos -->

                <!--
                <div class="fichaSinElementosMsgRIS">
                    <p>
                        Sin Archivos
                    </p>
                </div> -->
                <!-- Contenedor de fichas cuando existen archivos -->
           <!--     <div class="contenedorFichasArchivosElementosRIS">  -->
                    <!-- Tipo de contenedor para IMG -->
                  <!--    <a class="etiquetaArchivoSEenRIS" download="#">
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
                    </a>-->

                    <!-- Tipo de contenedor para PDF -->
                 <!--     <a class="etiquetaArchivoSEenRIS" download="#">
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
           -->



                <!-- contenedor de las fichas -->
                <div id="contenedorFichaDocumentosSg">

                


                </div>





            <script>


            // cargar las fichas de documentos
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

               // 

            }

           tiempoReal();

         //   setInterval(tiempoReal, 3000);


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
                                        Asignar título (obligatorio)
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