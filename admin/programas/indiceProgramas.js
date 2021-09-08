if(typeof sessionStorage.getItem("primerAcceso") === 'string'){
    let valor = sessionStorage.getItem("hoja");
    valor = parseInt(valor);
    cambiarHoja(valor);
}else{
    sessionStorage.setItem("primerAcceso", "true");
    cambiarHoja(0);
}

function cambiarHoja(nuevoValor){
    nuevoValor.toString();
    sessionStorage.setItem("hoja", nuevoValor);
    redireccionUrl();
}

function redireccionUrl(){
    let hoja = sessionStorage.getItem("hoja");
    hoja = parseInt(hoja);
    switch(hoja){
        case 0:
            var resultado = $.ajax({
                url: 'programas/controlador/defecto.php',
                dataType: 'text',
               async: false
            }).responseText;
            break;
        case 1:
            var resultado = $.ajax({
                url: 'programas/controlador/programas.php',
                dataType: 'text',
              async: false
            }).responseText;
            break;
        case 2:
            var resultado = $.ajax({
                url: 'programas/controlador/procesos.php',
                dataType: 'text',
               async: false
            }).responseText;
            break;
    }
    
    
    document.getElementById("lname-containerGrl").innerHTML = resultado;
}