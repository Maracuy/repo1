/*
autollamada (test)

function tiempoReal(){
    var tabla = $.ajax({url: 'programas/objetos.php', dataType: 'text', async: false}).responseText;

    document.getElementById("contenidoResultado").innerHTML = tabla;
} // setInterval(tiempoReal, 1000);
tiempoReal();*/


function crearCamposEditables(indice, item){
    // Mostrar ventana
    crearModalAgregar(item);

    // Ventana
    let ventana = document.getElementById('modalFormUp');
    let botonCerrar = document.getElementById('btnCerrarModal');

    botonCerrar.onclick = function (){
        ventana.parentNode.removeChild(ventana);
    };

    // Texto
    let indiceSelector = (indice - 1);
    const filas = document.querySelectorAll('#contenidoResultado > tr');
    let filaDescripcion = filas[indiceSelector].querySelectorAll('td')[0].textContent;
    let fecha = new Date();
    let filaFecha = fecha.getDate() + "/" + (
        fecha.getMonth() + 1
    ) + "/" + fecha.getFullYear();

    // Input
    let inputDescripcion = document.getElementById('inputDescripcion');
    let inputFecha = document.getElementById('inputFecha');
    let inputNotas = document.getElementById('inputNota');

    // Escritura
    inputDescripcion.value = filaDescripcion;
    inputFecha.value = filaFecha;
    inputDescripcion.setAttribute("readonly", "");
    inputFecha.setAttribute("readonly", "");
    inputDescripcion.classList.add("inputOnlyRead");
    inputFecha.classList.add("inputOnlyRead");

    // Input Notas
    inputNotas.value = "Sin anotaciones";

    inputNotas.onfocus = function (){
        if(inputNotas.value == "Sin anotaciones"){
            inputNotas.value = "";
        }
    };

    inputNotas.onblur = function (){
        if(inputNotas.value == null || inputNotas.value == ""){
            inputNotas.value = "Sin anotaciones";
        }
    };
}

function crearModalAgregar(item){
    let modal = "<div class=\"modalContainer\" id=\"modalFormUp\"><div class=\"displayWindow\"><form action=\"registro_programas.php?agregar=1&procesor=" + item +"\" id=\"formularioAgregar\" method=\"post\"><div class=\"containerInputs\"><div class=\"subContentInputs\"><label class=\"lblDescription\">Descripción</label></div><div class=\"subContentInputs\"><input type=\"text\" class=\"inputDescription\" id=\"inputDescripcion\" name=\"inputDescripcion\"></div></div><div class=\"containerInputs\"><div class=\"subContentInputs\"><label class=\"lblDescription\">Fecha</label></div><div class=\"subContentInputs\"><input type=\"text\" class=\"inputDescription\" id=\"inputFecha\" name=\"inputFecha\"></div></div><div class=\"containerInputs\"><div class=\"subContentInputs\"><label class=\"lblDescription\">Nota</label></div><div class=\"subContentInputs\"><input type=\"text\" class=\"inputDescription\" id=\"inputNota\" name=\"inputNota\"></div></div><div class=\"containerBtns\"><a class=\"btn btn-danger\" id=\"btnCerrarModal\">Cancelar</a><input type=\"submit\" id=\"btnCompletarRegistro\" name=\"btnCompletarRegistro\" value=\"Completar\" class=\"btn btn-success\"></div></form></div></div>";

    document.body.insertAdjacentHTML('beforeend', modal);
}

function crearCamposEditables2(indice, item){
    // Mostrar ventana
    crearModalEliminar(item);

    // Ventana
    let ventana = document.getElementById('modalFormUp2');
    let botonCerrar = document.getElementById('btnCerrarModal2');

    botonCerrar.onclick = function (){
        ventana.parentNode.removeChild(ventana);
    };

    let indiceSelector = (indice - 1);
    const filas = document.querySelectorAll('#contenidoResultado > tr');
    let filaDescripcion = filas[indiceSelector].querySelectorAll('td')[0].textContent;

    // Input
    let inputElemento = document.getElementById('inputElemento');
    inputElemento.setAttribute("readonly", "");
    inputElemento.classList.add("inputOnlyRead");
    inputElemento.value = filaDescripcion;

}

function crearModalEliminar(item){
    let modal = "<div class=\"modalContainer\" id=\"modalFormUp2\"><div class=\"displayWindow\"><form action=\"registro_programas.php?agregar=2&procesor=" + item +"\" method=\"post\"><div class=\"containerInputs\"><div class=\"subContentInputs\"><label class=\"lblDescription\">Se eliminará:</label></div><div class=\"subContentInputs\"><input type=\"text\" class=\"inputDescription\" id=\"inputElemento\" name=\"inputFecha2\"></div></div><div class=\"containerBtns\"><a class=\"btn btn-success\" id=\"btnCerrarModal2\">Cancelar</a><input type=\"submit\" id=\"btnCompletarRegistro\" name=\"btnCompletarRegistro\" value=\"Si, eliminar\" class=\"btn btn-danger\"></div></form></div></div>";

    document.body.insertAdjacentHTML('beforeend', modal);
}

function cerrarVentanaEditable(){
    // Ventana
    let ventana = document.getElementById('modalFormUp3');
    ventana.parentNode.removeChild(ventana);
}

function crearCamposEditables3(indice, item){
    // Mostrar ventana
    crearModalEditar(item);

    // Texto
    let indiceSelector = (indice - 1);
    const filas = document.querySelectorAll('#contenidoResultado > tr');
    var filaDescripcion = filas[indiceSelector].querySelectorAll('td')[0].textContent;
    let filaNota = filas[indiceSelector].querySelectorAll('td')[4].textContent;
    let fecha = new Date();
    let filaFecha = fecha.getDate() + "/" + (
        fecha.getMonth() + 1
    ) + "/" + fecha.getFullYear();

    let inputDescripcion = document.getElementById('inputDescripcion3');
    let inputFecha = document.getElementById('inputFecha3');
    let inputNota = document.getElementById('inputNota3');

    // Escritura
    inputDescripcion.value = filaDescripcion;
    inputFecha.value = filaFecha;
    inputNota.value = filaNota;
    inputDescripcion.setAttribute("readonly", "");
    inputFecha.setAttribute("readonly", "");
    inputDescripcion.classList.add("inputOnlyRead");
    inputFecha.classList.add("inputOnlyRead");

    // Input Notas
    inputNota.onfocus = function (){
        if(inputNota.value == "Sin anotaciones"){
            inputNota.value = "";
        }
    };

    inputNota.onblur = function (){
        if(inputNota.value == null || inputNota.value == ""){
            inputNota.value = "Sin anotaciones";
        }
    };
}

function crearModalEditar(item){
    let modal = "<div class=\"modalContainer\" id=\"modalFormUp3\"><div class=\"displayWindow\"><form action=\"registro_programas.php?agregar=3&procesor=" + item +"\" method=\"post\"><div class=\"containerInputs\"><div class=\"subContentInputs\"><label class=\"lblDescription\">Descripción</label></div><div class=\"subContentInputs\"><input type=\"text\" class=\"inputDescription\" id=\"inputDescripcion3\" name=\"inputDescripcion3\"></div></div><div class=\"containerInputs\"><div class=\"subContentInputs\"><label class=\"lblDescription\">Fecha</label></div><div class=\"subContentInputs\"><input type=\"text\" class=\"inputDescription\" id=\"inputFecha3\" name=\"inputFecha3\"></div></div><div class=\"containerInputs\"><div class=\"subContentInputs\"><label class=\"lblDescription\">Editar Nota</label></div><div class=\"subContentInputs\"><input type=\"text\" class=\"inputDescription\" id=\"inputNota3\" name=\"inputNota3\"></div></div><div class=\"containerBtns\"><a class=\"btn btn-danger\" onclick=\"cerrarVentanaEditable();\" id=\"btnCerrarModal3\">Cancelar</a><input type=\"submit\" name=\"btnCompletarRegistro\" value=\"Completar\" class=\"btn btn-success\"></div></form></div></div>";

    document.body.insertAdjacentHTML('beforeend', modal);
}