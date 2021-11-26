// Funciones de la solicitud
function expandirInformacionDeSolicitud(tituloBloque){
    let bloque = tituloBloque.nextSibling;
    bloque.classList.toggle('contenedorExpandibleElementosFRISNTV');

    // Reset a funcion "Subir Archivo" [revisar bug al tener 2 o mas secciones]
    // bug: Uncaught TypeError: Cannot read properties of null (reading 'nextSibling')

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

    }

    // Continuacion de codigo





}

// Boton Subir Archivo
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

            // Inicio de codigo
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

 }
