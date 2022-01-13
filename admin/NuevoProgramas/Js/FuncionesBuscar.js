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

/*  */