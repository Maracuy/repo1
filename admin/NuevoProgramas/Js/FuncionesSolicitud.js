// Funciones de la solicitud
function expandirInformacionDeSolicitud(tituloBloque){
    let bloque = tituloBloque.nextSibling;
    bloque.classList.toggle('contenedorExpandibleElementosFRISNTV');

    if(tituloBloque.classList.contains('claseEditableFormularioRIS')){

        let contenedorEdicion = bloque.firstChild.nextSibling.nextSibling.firstChild.firstChild;

        if(!contenedorEdicion.classList.contains('OcultarSeccionSubirArchivos')){

            let contenedorInputText = contenedorEdicion,
                contenedorInputFile = contenedorEdicion.nextSibling,
                contenedorBotones = contenedorInputFile.nextSibling,
                contenedorBotonSubir = contenedorBotones.firstChild,
                contenedorBotonGuardar = contenedorBotonSubir.nextSibling;

            let inputFile = document.getElementById("SubirArchivoClick");
            let spanText = contenedorInputFile.firstChild.firstChild.nextSibling.firstChild,
                inputText = contenedorInputFile.previousSibling.firstChild.firstChild.nextSibling.firstChild;

            contenedorInputText.classList.toggle('OcultarSeccionSubirArchivos');
            contenedorInputFile.classList.toggle('OcultarSeccionSubirArchivos');
            contenedorBotonSubir.classList.toggle('OcultarSeccionSubirArchivos');
            contenedorBotonGuardar.classList.toggle('OcultarSeccionSubirArchivos');

            inputFile.value = '';
            inputText.value = '';
            spanText.innerHTML = "Sin Archivo";

            let contenedorErrorBanner = document.getElementById("contenedorMensajeDeErrorRespuestaRIS");

            if(!contenedorErrorBanner.classList.contains('OcultarSeccionMensajeError')){
                contenedorErrorBanner.classList.toggle('OcultarSeccionMensajeError');
            }

        }
    }
}

// Boton (Input) subir archivo
const inputCambio = document.getElementById("SubirArchivoClick");

inputCambio.addEventListener('change', () => {
    let etiquetaSpan = inputCambio.nextSibling.firstChild;
    let file = inputCambio.files[0];
    let inputFile = document.getElementById("SubirArchivoClick");
    const extensionesAprobadas = ["jpg", "jpeg", "gif", "png", "pdf", "docx", "xlsx", "pptx"];

    if(file){

        let extensionArchivo = file.name.substring(file.name.lastIndexOf('.') + 1).toLowerCase();
        let aciertos = 0;

        for(i = 0; i < extensionesAprobadas.length; i++){
            extensionArchivo == extensionesAprobadas[i] ? aciertos++ : aciertos;
        }

        let campodeMensajeError = document.getElementById("contenedorMensajeError");

        if(aciertos != 1){

            if(campodeMensajeError.classList.contains('OcultarSeccionSubirArchivos')){
                campodeMensajeError.classList.toggle('OcultarSeccionSubirArchivos');
            }

            campodeMensajeError.firstChild.firstChild.innerHTML = "El archivo no cumple con el formato (Archivo " + extensionArchivo + ")";
            inputFile.value = '';
            etiquetaSpan.innerHTML = "Sin Archivo";

        }else{

            let pesoArchivo = (file.size / 1048576);
            const pesoMaximo = 5;

            if(pesoArchivo > pesoMaximo){

                // El archivo supera el peso maximo
                if(campodeMensajeError.classList.contains('OcultarSeccionSubirArchivos')){
                    campodeMensajeError.classList.toggle('OcultarSeccionSubirArchivos');
                }
    
                campodeMensajeError.firstChild.firstChild.innerHTML = "El archivo supera los " + pesoMaximo + "Mb permitidos (Peso: " + pesoArchivo + " Mb)";
                inputFile.value = '';
                etiquetaSpan.innerHTML = "Sin Archivo";
            }else{

                // El archivo cumple con los requisitos
                if(!campodeMensajeError.classList.contains('OcultarSeccionSubirArchivos')){
                    campodeMensajeError.classList.toggle('OcultarSeccionSubirArchivos');
                }
    
                campodeMensajeError.firstChild.firstChild.innerHTML = "Mensaje";
                etiquetaSpan.innerHTML = file.name;
            }
        }
    }else{
        etiquetaSpan.innerHTML = "Sin Archivo";
    }
 });

 function expandirInputFile(boton){
    let contenedorBotonesSubir = boton.parentNode,
        contenedorBotonesGuardar = contenedorBotonesSubir.nextSibling,
        contenedorInputFile = boton.parentNode.parentNode.previousSibling,
        contenedorInputTitulo = contenedorBotonesSubir.parentNode.previousSibling.previousSibling;

    contenedorBotonesSubir.classList.toggle('OcultarSeccionSubirArchivos');
    contenedorBotonesGuardar.classList.toggle('OcultarSeccionSubirArchivos');
    contenedorInputFile.classList.toggle('OcultarSeccionSubirArchivos');
    contenedorInputTitulo.classList.toggle('OcultarSeccionSubirArchivos');
 }

 function reducirInputFile(boton){

    let contenedorBotonesGuardar = boton.parentNode,
        contenedorBotonesSubir = contenedorBotonesGuardar.previousSibling,
        contenedorInputFile = contenedorBotonesSubir.parentNode.previousSibling;
    let inputFile = document.getElementById("SubirArchivoClick");
    let spanInputFile = inputFile.nextSibling.firstChild,
        contenedorinputText = inputFile.parentNode.parentNode.previousSibling,
        inputText = contenedorinputText.firstChild.firstChild.nextSibling.firstChild;

    contenedorBotonesSubir.classList.toggle('OcultarSeccionSubirArchivos');
    contenedorBotonesGuardar.classList.toggle('OcultarSeccionSubirArchivos');
    contenedorInputFile.classList.toggle('OcultarSeccionSubirArchivos');
    contenedorinputText.classList.toggle('OcultarSeccionSubirArchivos');

    inputFile.value = '';
    inputText.value = '';
    spanInputFile.innerHTML = "Sin Archivo";


    let contenedorErrorBanner = document.getElementById("contenedorMensajeDeErrorRespuestaRIS");

    if(!contenedorErrorBanner.classList.contains('OcultarSeccionMensajeError')){
        contenedorErrorBanner.classList.toggle('OcultarSeccionMensajeError');
    }

    



 }

 function ocultarVentanaModal(boton){
    boton.parentNode.classList.toggle('ocultarVentanaModalGenerica');
    boton.nextSibling.firstChild.innerHTML = "Mensaje";
 }

// Subida de archivos por medio de AJAX/JQuery
 $(function(){
    $("#formularioSubirArchivoFichaRIS2").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formularioSubirArchivoFichaRIS2"));
        let campoTitulo = document.getElementById("campoTituloSubirArchivoFichaRIS2").value,
            campoArchivo = document.getElementById("SubirArchivoClick").value;
        let contenedorError = document.getElementById("contenedorMensajeDeErrorRespuestaRIS");

        if(campoTitulo == "" || campoArchivo == ""){
            // Activar mensaje de error
            if(contenedorError.classList.contains('OcultarSeccionMensajeError')){
                contenedorError.classList.toggle('OcultarSeccionMensajeError');
                contenedorError.firstChild.innerHTML = "Complete todos los campos antes de guardar";
            }else{
                contenedorError.firstChild.innerHTML = "Complete todos los campos antes de guardar";
            }
        }else{
            // Enviar datos
            // Eliminar banner de error si existe
            if(!contenedorError.classList.contains('OcultarSeccionMensajeError')){
                contenedorError.classList.toggle('OcultarSeccionMensajeError');
            }

            $.ajax({
                url: "NuevoProgramas/Externo/subirArchivo.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(res){

                    // Reseteo de formulario
                    let idInicialIndice = document.getElementById("campoTituloSubirArchivoFichaRIS2"),
                        inputFileArchivo = document.getElementById("SubirArchivoClick");

                    let contenedorTitulo = idInicialIndice.parentNode.previousSibling.parentNode.parentNode,
                        contenedorArchivo = contenedorTitulo.nextSibling,
                        contenedorBotones = contenedorArchivo.nextSibling,
                        contenedorBotonesAccionSubir = contenedorBotones.firstChild,
                        contenedorBotonesAccionGuardar = contenedorBotonesAccionSubir.nextSibling;

                    contenedorTitulo.classList.toggle('OcultarSeccionSubirArchivos');
                    contenedorArchivo.classList.toggle('OcultarSeccionSubirArchivos');
                    contenedorBotonesAccionSubir.classList.toggle('OcultarSeccionSubirArchivos');
                    contenedorBotonesAccionGuardar.classList.toggle('OcultarSeccionSubirArchivos');

                    idInicialIndice.value = '';
                    inputFileArchivo.value = '';
                    inputFileArchivo.nextSibling.firstChild.innerHTML = "Sin Archivo";

                    // Control de la ventana modal
                    let ventanaModalGenerica = document.getElementById("bannerVentanaModalGenericaRIS");
                    ventanaModalGenerica.classList.toggle('ocultarVentanaModalGenerica');

                    if(res === ""){
                        ventanaModalGenerica.firstChild.nextSibling.firstChild.innerHTML = "El archivo se subió correctamente";
                    }else{
                        ventanaModalGenerica.firstChild.nextSibling.firstChild.innerHTML = res; 
                    }
            });
        }
    });
});

// Continuacion