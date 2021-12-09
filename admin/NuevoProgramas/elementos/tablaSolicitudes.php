<?php

// definir el tipo de ruta segun las variables de url
$link = 'NuevoProgramas/elementos/tablaSolicitudes2.php';
$extensionConsulta = '?';

if(isset($_GET['tc'])){

    $tc = filter_var($_GET['tc'], FILTER_SANITIZE_NUMBER_INT);
    $extensionConsulta .= 'tc=' . $tc;

    // REVISAR SI ESTA ASIGNADO UN FILTRO QUE MODIFIQUE URL
    if($tc == 2){
        // PRIMER FILTRO

        $dd = filter_var($_GET['dd'], FILTER_SANITIZE_NUMBER_INT);
        $mm = filter_var($_GET['mm'], FILTER_SANITIZE_NUMBER_INT);
        $aaaa = filter_var($_GET['aaaa'], FILTER_SANITIZE_NUMBER_INT);

        $adicion = '&dd=' . $dd . '&mm=' . $mm . '&aaaa=' . $aaaa;
        $extensionConsulta .= $adicion;

    }else if($tc == 1){
        // SEGUNDO FILTRO

        $di = filter_var($_GET['di'], FILTER_SANITIZE_NUMBER_INT);
        $mi = filter_var($_GET['mi'], FILTER_SANITIZE_NUMBER_INT);
        $ai = filter_var($_GET['ai'], FILTER_SANITIZE_NUMBER_INT);
        $df = filter_var($_GET['df'], FILTER_SANITIZE_NUMBER_INT);
        $mf = filter_var($_GET['mf'], FILTER_SANITIZE_NUMBER_INT);
        $af = filter_var($_GET['af'], FILTER_SANITIZE_NUMBER_INT);

        $adicion = '&di=' . $di . '&mi=' . $mi . '&ai=' . $ai . '&df=' . $df . '&mf=' . $mf . '&af=' . $af;
        $extensionConsulta .= $adicion;

    }

    // AGREGAR PAGINA AUTOMATICAMENTE INCLUSO SI NO ESTA DEFINIDA
    if(isset($_GET['page'])){
        $page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);
        $extensionConsulta .= '&page=' . $page;
    }else{
        $extensionConsulta .= '&page=1';
    }

}else{
    $extensionConsulta .= 'tc=6&page=1';
}

$link = $link . $extensionConsulta;


?>

<!-- Contenedor para agregar la tabla y sus botones -->
<div id="contenedorTabla-BotonesGRL">
</div>

<script>
    function tiempoReal(){
        var link = '<?=$link?>';
        var tabla = $.ajax({
            url: link,
            dataType: 'text'
        }).done(function(res){
            document.getElementById("contenedorTabla-BotonesGRL").innerHTML = res;
        });
    }

    // Primera llamada al cargar la pagina, Actualizar cada 10 s despues
    tiempoReal();
    setInterval(tiempoReal, 10000);
</script>