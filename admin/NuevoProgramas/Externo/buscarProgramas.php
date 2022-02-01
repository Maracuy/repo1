<?php



$query = "SELECT * FROM INFORMACION_BASICA_PROGRAMAS ORDER BY ID;";

include_once('conexiones.php');


$resultado = conectarDBO::conexion()->prepare($query);


if(isset($_POST['consulta'])){

    
    $consultaDatos = strip_tags(htmlspecialchars($_POST['consulta']));

    
    echo "la consulta tiene datos ({$consultaDatos}) y se esta ejecutando la consulta:<br>";

    $query = "SELECT ID_PROGRAMA, NOMBRE_PROGRAMA FROM INFORMACION_BASICA_PROGRAMAS WHERE NOMBRE_PROGRAMA LIKE '%".$consultaDatos."%' OR ID_PROGRAMA LIKE '%".$consultaDatos."%';";

    
    $resultado = conectarDBO::conexion()->prepare($query);

    
    echo $query;

}

$resultado->execute();

$registrosTotales = $resultado->rowCount();

$salida = "";

if($registrosTotales > 0){

    while($registrosBusqueda = $resultado->fetch(PDO::FETCH_ASSOC)){
        $salida .= "<div class=\"contenedorGeneralResultadoNP\" data-idprograma=\"".$registrosBusqueda['ID_PROGRAMA']."\"><div class=\"contenedorFichaGeneralResultadoNP\"><div class=\"contenedorElementosFichaResultadosNP\"><img src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTaq68iCodsj-2dY9eEA-SiWBV6W6cDH2WrHKgGyQG145m991AmaiZ9_Lu_yxGdtXGqmzQ&usqp=CAU\" class=\"imagenProgramaFichaGenerealResultadoNP\"></div><div class=\"contenedorElementosFichaResultadosNP\"><div class=\"contenedorFilasFichaResultadosNP\"><span>".$registrosBusqueda['NOMBRE_PROGRAMA']."</span></div><div class=\"contenedorFilasFichaResultadosNP\"><p>Dirección de desarrollo social</p></div><div class=\"contenedorFilasFichaResultadosNP\"><p>Subdireccion de vinculación institucional</p></div><div class=\"contenedorFilasFichaResultadosNP\"><p>Departamento de programas federales</p></div></div></div></div>";
    }

}else{
    $salida .= "<!-- Ficha para resultados no encontrados --><div class=\"contenedorGeneralResultadoNP contenedorGeneralResultadoVacioNP\"><div class=\"resultadoVacioContenedorGNP\"><p>Sin resultados</p></div></div>";
}

echo $salida;


?>

