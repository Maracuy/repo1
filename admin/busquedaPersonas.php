<?php


echo "Datos";
echo "<br>Programa: {$programaParaRegistrar}";
echo "<br>CURP: {$curpParaRegistrar}";



include_once "../conection/conexion.php";
$buscarregistrocurp = "SELECT id_ciudadano FROM ciudadanos WHERE curp= :curp";
$resultado = $con->prepare($buscarregistrocurp);
$resultado->bindValue(":curp", $curpParaRegistrar);
$resultado->execute();
$registrosNo = $resultado->rowCount();

if ($registrosNo != 0) {
    // Ya se encuentra registrado, no se puede hacer algo mas   
    
    echo "<br><br>el ciudadano existe, revisar datos faltantes";
    $idCiudadanoFromBase = $resultado->fetch(PDO::FETCH_ASSOC);
    $idCiudadanoFromBase = $idCiudadanoFromBase['id_ciudadano'];
    

    $buscarprogramaregistrado = "SELECT * FROM programas_registro WHERE ID_CIUDADANO_REGISTRADO = :id_ciudadano_registrado AND ID_PROGRAMA_REGISTRADO = :id_programa_registrado;";
    $resultado2 = $con->prepare($buscarprogramaregistrado);
    $resultado2->bindValue(":id_ciudadano_registrado", $idCiudadanoFromBase);
    $resultado2->bindValue(":id_programa_registrado", $programaParaRegistrar);
    $resultado2->execute();
    $registrosNo2 = $resultado2->rowCount();


    if ($registrosNo2 != 0) {
        
        echo "<br>el ciudadano ya se encuentra registrado en este programa<br><br>";


        $revisarcamposciudadano = "SELECT * FROM ciudadanos WHERE id_ciudadano = :id_ciudadano;";
        $resultado3 = $con->prepare($revisarcamposciudadano);
        $resultado3->bindValue(":id_ciudadano", $idCiudadanoFromBase);
        $resultado3->execute();
        $camposTablaCiudadanos = $resultado3->fetch(PDO::FETCH_ASSOC);

        
        echo "<br><br>Revisar elementos vacios antes de agrupar";
        

        
        $contadorElementos = 0;

        foreach($camposTablaCiudadanos as $tablaResultado){
            echo "<br>Elemento numero " . ++$contadorElementos . ": ";
            


            if($tablaResultado == null || empty($tablaResultado)){
                echo "Vacio";
            }else{
                echo $tablaResultado;
            }

        }

        echo "<br>La informacion anterior es unicamente guia, no deberia mostrarse al finalizar la creacion de esta pestaña";


        include_once("formCiudadanos.php");




    }else{
        echo "<br>el ciudadano no esta inscrito";



        



    }





}else{


        



    echo "<br><br>el ciudadano ingresado no existe, registrar por completo";
}




?>