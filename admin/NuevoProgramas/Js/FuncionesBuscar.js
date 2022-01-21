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

// Continuación