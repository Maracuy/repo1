// Titulo dinamico del buscador
const cuadroBusquedaGeneral = document.getElementById("inputBuscarElementoNP");
cuadroBusquedaGeneral.addEventListener("focus", alternarTitulo, true);
cuadroBusquedaGeneral.addEventListener("blur", alternarTitulo, true);

// resetear seleccion cada vez que se intenta buscar algo nuevo
cuadroBusquedaGeneral.addEventListener("keyup", (elemento)=>{
    let tecla = elemento.key.toLowerCase();
    const valores = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'delete', 'backspace', ' '];
    if(valores.includes(tecla)){
        limpiarSeleccion();
    }
    activarBusquedaDatos();
});

// Cambiar posicion del titulo "Buscar" en el input segun contenga informacion o no
function alternarTitulo(){
    let cuadroBusqueda = document.getElementById("inputBuscarElementoNP").value;
    const labelCuadroBusqueda = document.getElementById("labelBuscarElementoNP");
    if(cuadroBusqueda === ""){
        labelCuadroBusqueda.classList.toggle('labelBuscarElementoActivoNP');
    }
}

/* Selector de programa */
const contenedorResultados = document.getElementById('contenedorResultadosDelegacionNP');
contenedorResultados.addEventListener('click', (elemento)=>{
        // revisar si el padre no directo (con profundidad maxima de 6) del elemento se encuentra seleccionado
        for(i = 0; i < 6; i++){
            // comprobar existencia solo si es que el contenedor tiene una clase
            if(elemento.path[i].classList != ""){
                // solo aplicar estilo si la ficha no es la de "sin resultados"
                if(!elemento.path[i].matches('.contenedorGeneralResultadoVacioNP')){
                    if(elemento.path[i].matches('.contenedorGeneralResultadoNP')){
                        // Llamar funciones segun la existencia de algun elemento seleccionado
                        if(comprobarSeleccion(elemento.path[i])){
                            limpiarSeleccion();
                        }else{
                            limpiarSeleccion();
                            seleccionarElemento(elemento.path[i]);
                        }
                        break;
                    }
                }
            }
        }
});

// Verificar si se selecciono el mismo elemento o es diferente
function comprobarSeleccion(elementoSeleccionado){
    let comprobarExistencia = document.body.querySelector(".contenedorGeneralResultadoActivoNP[data-idprograma]");
    // Comprobar si existe algun elemento seleccionado
    if(comprobarExistencia){
        // Comparar elementos
        let seleccionarElementoAnterior = document.getElementById('inputContenedorSeleccionRealizada');
        let seleccionElementoActual = elementoSeleccionado.getAttribute('data-idprograma');
        return seleccionarElementoAnterior.value == seleccionElementoActual;
    }else{ 
        return false;
    }
}

// Seleccionar un elemento
function seleccionarElemento(elemento){
    let contenedorTexto = document.getElementById('inputContenedorSeleccionRealizada');
    let valorParaAgregar = elemento.getAttribute('data-idprograma');
    contenedorTexto.value = valorParaAgregar;
    elemento.classList.toggle('contenedorGeneralResultadoActivoNP');
}

// Eliminar la seleccion de algun elemento en caso de que sea verdadera
function limpiarSeleccion(){
    let comprobarExistencia = document.body.querySelector(".contenedorGeneralResultadoActivoNP[data-idprograma]");
    // Comprobar si existe algun elemento seleccionado
    if(comprobarExistencia){
        let contenedorTexto = document.getElementById('inputContenedorSeleccionRealizada');
        // recuperar elemento 
        let elementoAnteriormenteSeleccionado = document.body.querySelector(".contenedorGeneralResultadoActivoNP[data-idprograma='"+contenedorTexto.value + "']");
        // existe algun campo seleccionado anteriormente, eliminar
        elementoAnteriormenteSeleccionado.classList.remove("contenedorGeneralResultadoActivoNP");
        // Limpiar input
        contenedorTexto.value = "";
    }    
}

$(buscar_datos());

function buscar_datos(consulta){
    $.ajax({
        url: 'NuevoProgramas/Externo/buscarProgramas.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta}
    }).done(function(respuesta){
       let contenedorResultado = document.getElementById("contenedorResultadosDelegacionNP");
        contenedorResultado.innerHTML = respuesta;
    }).fail(function(){
        console.log("error ejecutando");
    });
}

function activarBusquedaDatos(){
    let input = document.getElementById('inputBuscarElementoNP');
    var valor = input.value;
    if(valor != ""){
        buscar_datos(valor);
    }else{
        buscar_datos();
    }
}

// Titulo CURP
const inputBusquedaCURP = document.getElementById("inputCuadroBusquedaCURPNP");
inputBusquedaCURP.addEventListener("focus", alternarEtiqueta, true);
inputBusquedaCURP.addEventListener("blur", alternarEtiqueta, true);
inputBusquedaCURP.addEventListener("keyup", function(){
    let bannerMensaje = document.getElementById("bannerRespuestaValidacionCURPNP");
    let textoMensaje = document.getElementById("textoBannerRespuestaValidacionCURPNP");
    textoMensaje.innerHTML = "";
    bannerMensaje.classList.add("bannerRespuestaValidacionCURPOCULTONP");
    let campoCURPValidada = document.getElementById("inputContenedorCURPIngresada");
    campoCURPValidada.value = "";
});

function alternarEtiqueta(){
    let busquedaCURP = document.getElementById("inputCuadroBusquedaCURPNP").value;
    const labelBusquedaCURP = document.getElementById("LabelCuadroBusquedaCURPNP");

    if(busquedaCURP === ""){
        labelBusquedaCURP.classList.toggle('LabelCuadroBusquedaActivoCURPNP');
    }
}

// AAAA000000AAAAAA00
const botonValidarCURP = document.getElementById("botonBusquedaValidarCURPNP");

botonValidarCURP.addEventListener('click', function(){
    let contenedorInformacionCURP = document.getElementById("inputCuadroBusquedaCURPNP").value;
    console.log("valor a analizar: " + contenedorInformacionCURP);
    const expresion = "^([a-zA-Z]{4})+([0-9]{6})+([a-zA-Z]{6})+([0-9a-zA-Z]{2}|[a-zA-Z]{2}|[0-9]{2})+$";
    let errores = 0;

    if(contenedorInformacionCURP.length != 18){errores++;}
    if(!contenedorInformacionCURP.match(expresion)){errores++;}

    let bannerMensaje = document.getElementById("bannerRespuestaValidacionCURPNP");
    let textoMensaje = document.getElementById("textoBannerRespuestaValidacionCURPNP");
    let botonMensaje = document.getElementById("botonBannerRespuestaValidacionCURPNP");

    if(errores != 0){
        textoMensaje.innerHTML = "Curp inválida";
        bannerMensaje.classList.remove("bannerRespuestaValidacionCURPEXITONP");
        bannerMensaje.classList.remove("bannerRespuestaValidacionCURPOCULTONP");
        botonMensaje.classList.add("bannerRespuestaValidacionCURPOCULTONP");
    }else{


        comprobarCURP();
    }


});

function comprobarCURP(){

    const contenidoInputCURP = document.getElementById("inputCuadroBusquedaCURPNP").value;

    let bannerMensaje = document.getElementById("bannerRespuestaValidacionCURPNP");
    let textoMensaje = document.getElementById("textoBannerRespuestaValidacionCURPNP");
    let botonMensaje = document.getElementById("botonBannerRespuestaValidacionCURPNP");

    var link = 'NuevoProgramas/Externo/verificarCurp.php?valorCurp=' + contenidoInputCURP;
    $.ajax({
        url: link,
        dataType: 'text'
    }).done(function(res){
        if(res != ""){
            console.log("el resultado es: " + res);
            let campoCURPValidada = document.getElementById("inputContenedorCURPIngresada");
            campoCURPValidada.value = res;
            textoMensaje.innerHTML = "Validación correcta";
            bannerMensaje.classList.add("bannerRespuestaValidacionCURPEXITONP");
            bannerMensaje.classList.remove("bannerRespuestaValidacionCURPOCULTONP");
            botonMensaje.classList.add("bannerRespuestaValidacionCURPOCULTONP");
        }else{
            let curpConsultada = document.getElementById("inputCuadroBusquedaCURPNP").value;
            textoMensaje.innerHTML = "La CURP ("+curpConsultada+") no corresponde a ningún ciudadano registrado. Sí desea registrar uno nuevo, pulse el siguiente botón";
            bannerMensaje.classList.remove("bannerRespuestaValidacionCURPEXITONP");
            bannerMensaje.classList.remove("bannerRespuestaValidacionCURPOCULTONP");
            botonMensaje.classList.remove("bannerRespuestaValidacionCURPOCULTONP");
        }
    });
}