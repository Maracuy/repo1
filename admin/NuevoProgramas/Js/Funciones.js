// Funciones tabla principal
function addFechaAuto(){
    let fechaContenedor = document.getElementById('idSpanFechaActual');
    var f = new Date();
    let fecha = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
    fechaContenedor.innerHTML = fecha;
}

function addYear(elemento){

    let year = new Date();
    let yearNow = year.getFullYear();
    let fechaLimite = 2005;

    while(yearNow > fechaLimite){
        elemento.insertAdjacentHTML('beforeend','<option>' + yearNow-- +'</option>');
    }

    // resetear
    elemento.onclick = "";
}

function rellenarFechaDesdeHasta(){
    let anulador = false;
    let errores = 0, vacios = 0;
    let detalles = [],
        campos =  [document.getElementById("FechaDiaDesdeH").value, document.getElementById("FechaMesDesdeH").value, document.getElementById("FechaAnoDesdeH").value, document.getElementById("FechaDiaHastaH").value, document.getElementById("FechaMesHastaH").value, document.getElementById("FechaAnoHastaH").value];

   // Determinar si se encuentra un dato vacio
    for(i = 0; i < 6; i++){
        (campos[i] === "") ? vacios++ : vacios;
    }
    
    // Un campo se encuentra vacio
    (vacios != 0) ? (detalles[detalles.length] = "Complete todos los campos correctamente", errores++, anulador = false) : (errores, anulador = true);

    // El primer año seleccionado supera el rango del segundo
    (campos[2] > campos[5]) ? (detalles[detalles.length] = "Selecciono un año superior al rango indicado", errores++) : errores;

    // El primer mes seleccionado supera el rango del segundo
    (campos[2] == campos[5] && campos[1] > campos[4]) ? (detalles[detalles.length] = "Selecciono un mes superior al rango indicado", errores++) : errores;

    // El primer dia seleccionado supera el rango del segundo
    (campos[2] == campos[5] && campos[1] == campos[4] && campos[0] > campos[3]) ? (detalles[detalles.length] = "Selecciono un dia superior al rango indicado", errores++) : errores;

    // La fecha es la misma (el anulador sirve para evitar duplicado entre este dato y datos vacios)
    if(anulador){
        (campos[2] == campos[5] && campos[1] == campos[4] && campos[0] == campos[3]) ? (detalles[detalles.length] = "Selecciono la misma fecha como rango", errores++) : errores;
    }
    
    if(errores != 0){
        let mensaje = "";
        detalles.forEach(function(detalle) {
            mensaje += "\n- " + detalle;
        }); alert("Error al aplicar etiqueta [Detalles]" + mensaje);
    }else{
        let formulario = document.getElementById("FormularioFechaDesdeHasta");
        let ruta = formulario.getAttribute("action");
        let link = "?tc=1&di="+campos[0]+"&mi="+campos[1]+"&ai="+campos[2]+"&df="+campos[3]+"&mf="+campos[4]+"&af="+campos[5];
        let enlace = ruta + link;
        //formulario.setAttribute("action", enlace);
        document.location.href = enlace;
    }
    return false;
}

function rellenarFechaDesde(){
    let vacios = 0;
    let detalles = [document.getElementById("FechaDiaDesde").value, document.getElementById("FechaMesDesde").value, document.getElementById("FechaAnoDesde").value];

    for(i = 0; i < 3; i++){
        (detalles[i] === "") ? vacios++ : vacios;
    }

    if(vacios == 0){
        let formulario = document.getElementById("FormularioFechaDesde");
        let ruta = formulario.getAttribute("action");
        let link = "?tc=2&dd=" + detalles[0] + "&mm=" + detalles[1] + "&aaaa=" + detalles[2];
        let enlace = ruta + link;
        document.location.href = enlace;
    }else{
        alert("Ingrese todos los datos\nFaltan: " + vacios);
    }
    return false;
}

var estadoTextoFiltros = true;
function abrirCerrarFiltros(){
    let contenedorFiltros = document.getElementById("contenedorFiltrosBotonesDisplay");
    let textoEstadoFiltro = document.getElementById("textoTituloFiltrosAC");
    contenedorFiltros.classList.toggle('contenedorVisibilidadFiltros');
    (estadoTextoFiltros) ? (textoEstadoFiltro.innerHTML = "Cerrar filtros") : (textoEstadoFiltro.innerHTML = "Abrir filtros");
    estadoTextoFiltros ^= true;
}

// Funciones informacion de la solicitud
function abrirContenedor(bloque){

    let modoEdicion = bloque.getAttribute("data-btncancelar");

    if(modoEdicion == "true"){
        // Eliminar texto
        bloque.setAttribute("data-btncancelar", false);
        let item = bloque.querySelector('span[data-ediciongenerada="true"]');
        bloque.removeChild(item);

        let formulario = bloque.nextSibling;

        // Mostrar boton "Editar"
        let contenedorBotonEditar = formulario.firstChild.firstChild.nextSibling;
        contenedorBotonEditar.classList.toggle('contenedorBotonesISAccionesGC');

        // Ocultar botones "Cancelar/Guardar"
        contenedorBotonEditar.nextSibling.classList.toggle('contenedorBotonesISAccionesGC');

        // Obtener inputs en formulario
        let elementos = formulario.getElementsByClassName("inputTypeIS");
        let formInput;

        // Recorrer inputs y desactivarlos
        for(i = 0; i < elementos.length; i++){
            formInput = elementos[i];
            // resuelve el error que provoca que la edicion no sea cancelada correctamente
            formInput.value = formInput.getAttribute("value");
            formInput.disabled = true;
        }
    }

    // Ocultar contenido
    bloque.parentNode.querySelector("container").classList.toggle('contenedorVisibilidadFiltros');
}

function editarFormulario(boton){

    // Ocultar boton "Editar"
    boton.parentNode.classList.toggle('contenedorBotonesISAccionesGC');

    // Obtener formulario a recorrer
    let formulario = boton.parentNode.parentNode.parentNode;

    // Mostrar botones "Cancelar/Guardar"
    let contenedorBotones = boton.parentNode.parentNode.lastChild;
    contenedorBotones.classList.toggle('contenedorBotonesISAccionesGC');

    // Obtener inputs en formulario
    let elementos = formulario.getElementsByClassName("inputTypeIS");
    let formInput;

    // Recorrer inputs y habilitarlos
    for(i = 0; i < elementos.length; i++){
        formInput = elementos[i];
        formInput.disabled = false;
    }

    // Cambiar el texto a Modo edicion
    let contenedorTitulo = boton.parentNode.parentNode.parentNode.previousSibling;
    contenedorTitulo.setAttribute("data-btncancelar", true);
    contenedorTitulo.insertAdjacentHTML('beforeend', '<span data-ediciongenerada="true">.&#32;&#40;Editando contenido&#41;</span>');
}

function botonCancelarFormulario(boton){

    let contenedorBotonesGuardar = boton.parentNode;

    // Mostrar boton "Editar"
    let contenedorBotonEditar = contenedorBotonesGuardar.previousSibling;
    contenedorBotonEditar.classList.toggle('contenedorBotonesISAccionesGC');

    // Ocultar botones "Cancelar/Guardar"
    contenedorBotonesGuardar.classList.toggle('contenedorBotonesISAccionesGC');

    // Desactivar inputs
    let formulario = contenedorBotonesGuardar.parentNode.parentNode;

    // Obtener inputs en formulario
    let elementos = formulario.getElementsByClassName("inputTypeIS");
    let formInput;

    // Recorrer inputs y desactivarlos
    for(i = 0; i < elementos.length; i++){
        formInput = elementos[i];
        // resuelve el error que provoca que la edicion no sea cancelada correctamente
        formInput.value = formInput.getAttribute("value");
        formInput.disabled = true;
    }

    // cambiar estado del boton Modo Edicion
    let contenedorTitulo = formulario.previousSibling;
    contenedorTitulo.setAttribute("data-btncancelar", false);
    let item = contenedorTitulo.querySelector('span[data-ediciongenerada="true"]');
    contenedorTitulo.removeChild(item);
}