// Titulo dinamico del buscador
const cuadroBusquedaGeneral = document.getElementById("inputBuscarElementoNP");
cuadroBusquedaGeneral.addEventListener("focus", alternarTitulo, true);
cuadroBusquedaGeneral.addEventListener("blur", alternarTitulo, true);

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


                       
/*
                        let inputContenedorSeleccion = document.getElementById('inputContenedorSeleccionRealizada');
                       if(inputContenedorSeleccion.value == "" || inputContenedorSeleccion.value.length == 0){
                            elemento.path[i].classList.toggle('contenedorGeneralResultadoActivoNP');
                            let contenedorProgramaID = elemento.path[i].getAttribute('data-idprograma');
                       // console.log(inputContenedorSeleccion);
                            inputContenedorSeleccion.value = contenedorProgramaID;
                        }else{
                            // ya tenia un resultado, eliminar y despues asignar
                          //  limpiarContenedorResultados();
                          let claseAnterior = inputContenedorSeleccion.value;
                          let dato = ".contenedorGeneralResultadoActivoNP[data-idprograma='" + claseAnterior + "']";
                          console.log("informacion: " + dato);
                          var contenedorSeleccionado = document.body.querySelector(dato);
                          console.log("clases: " + contenedorSeleccionado);
                          contenedorSeleccionado.classList.remove("contenedorGeneralResultadoActivoNP");
                          console.log("se quedo: " + contenedorSeleccionado);
                        }*/


                        console.log("seleccionar elemento pero antes revisar si existe algun otro para deseleccionarlo");











                        break;
                    }
                }
            }
        }
});


/*
function limpiarContenedorResultados(){
    let contenedorResultados = document.getElementById('inputContenedorSeleccionRealizada');
    contenedorResultados.value = "";
}*/