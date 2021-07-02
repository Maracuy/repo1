<?php


function Incidentes($dato){

    $incidentes1 = array();
    if(isset($dato['ii1']) && $dato['ii1'] != ''){
        array_push($incidentes1, "i11");
    }
    if(isset($dato['ii2']) && $dato['ii2'] != ''){
        array_push($incidentes1, "i12");
    }
    if(isset($dato['ii3']) && $dato['ii3'] != ''){
        array_push($incidentes1, "i13");
    }
    if(isset($dato['ii4']) && $dato['ii4'] != ''){
        array_push($incidentes1, "i14");
    }
    if(isset($dato['ii5']) && $dato['ii5'] != ''){
        array_push($incidentes1, "i15");
    }
    if(isset($dato['ii6']) && $dato['ii6'] != ''){
        array_push($incidentes1, "i16");
    }

    if(isset($dato['i21']) && $dato['i21'] != ''){
        array_push($incidentes1, "i21");
    }
    if(isset($dato['i22']) && $dato['i22'] != ''){
        array_push($incidentes1, "i22");
    }
    if(isset($dato['i23']) && $dato['i23'] != ''){
        array_push($incidentes1, "i23");
    }
    if(isset($dato['i24']) && $dato['i24'] != ''){
        array_push($incidentes1, "i24");
    }
    if(isset($dato['i25']) && $dato['i25'] != ''){
        array_push($incidentes1, "i25");
    }
    if(isset($dato['i26']) && $dato['i26'] != ''){
        array_push($incidentes1, "i26");
    }
    if(isset($dato['i27']) && $dato['i27'] != ''){
        array_push($incidentes1, "i26");
    }

    if(isset($dato['i31']) && $dato['i31'] != ''){
        array_push($incidentes1, "i31");
    }
    if(isset($dato['i32']) && $dato['i32'] != ''){
        array_push($incidentes1, "i32");
    }
    if(isset($dato['i33']) && $dato['i33'] != ''){
        array_push($incidentes1, "i33");
    }
    if(isset($dato['i34']) && $dato['i34'] != ''){
        array_push($incidentes1, "i34");
    }
    if(isset($dato['i35']) && $dato['i35'] != ''){
        array_push($incidentes1, "i35");
    }
    if(count($incidentes1) != 0){
        return $incidentes1;
    }else{
        return 0;
    }
}

function Suma($a){
    $morena = (isset($a['morena']) && $a['morena'] != '' ) ? intval($a['morena']) : 0;
    $pt = (isset($a['pt']) && $a['pt'] != '' ) ? intval($a['pt']) : 0;
    $nalianza = (isset($a['nalianza']) && $a['nalianza'] != '' ) ? intval($a['nalianza']) : 0;
    $mor_pt_na = (isset($a['morena_pt_nueva']) && $a['morena_pt_nueva'] != '' ) ? intval($a['morena_pt_nueva']) : 0;
    $mor_pt = (isset($a['morena_pt']) && $a['morena_pt'] != '' ) ? intval($a['morena_pt']) : 0;
    $mor_na = (isset($a['morena_nueva']) && $a['morena_nueva'] != '' ) ? intval($a['morena_nueva']) : 0;
    $pt_na = (isset($a['pt_nueva']) && $a['pt_nueva'] != '' ) ? intval($a['pt_nueva']) : 0;
    $suma =  $morena + $pt + $nalianza + $mor_pt_na + $mor_pt + $mor_na + $pt_na;
    return $suma;
}

function SumaO($a){
    $pan = intval($a['pan']);
    $pri = intval($a['pri']);
    $prd = intval($a['prd']);
    $pri_pan_prd = intval($a['pri_pan_prd']);
    $pri_pan = intval($a['pri_pan']);
    $pri_prd = intval($a['pri_prd']);
    $pan_prd = intval($a['pan_prd']);
    $suma = $pan + $pri + $prd + $pri_pan_prd + $pri_pan + $pri_prd + $pan_prd;
    return $suma;
}

function Base($con){
    $sen_zona = "SELECT * FROM rep WHERE morena != ''";
    $stm = $con->query($sen_zona);
    $listaFull = $stm->fetchAll(PDO::FETCH_ASSOC);

    $arreglo = array(); 
    $m1 = '';
    $m2 = '';

    

    foreach($listaFull as $a){
        $aliados = Suma($a);
        $oposicion = SumaO($a);

        $otros_incidentes = '';
        $otros_incidentes.=  ($a['incidentes1'] != '') ? "1" : NULL ;
        $otros_incidentes.=  ($a['incidentes2'] != '') ? "2" : NULL ;
        $otros_incidentes.=  ($a['incidentes3'] != '') ? "3" : NULL ;

        $registro = array($a['zona'], $a['seccion'], $a['casilla'], $a['partido'], $aliados, $oposicion, Incidentes($a), $otros_incidentes, 'ok');
        array_push($arreglo, $registro);
    }

    return $arreglo;
}

function SuperContador($con){


    $sen_zona = "SELECT id_rep, seccion, casilla, partido FROM rep WHERE morena !=''";
    $stm = $con->query($sen_zona);
    $lista = $stm->fetchAll(PDO::FETCH_ASSOC);

    $listaConteo = array();

    $tempSeccion = 0;
    $tempCasilla = "";
    $tempPartido = 0;

    for($i = 0; $i < count($lista); $i++){
        if($lista[$i]['seccion'] != $tempSeccion){
            array_push($listaConteo, $lista[$i]);
            $tempSeccion = $lista[$i]['seccion'];
            $tempCasilla = $lista[$i]['casilla'];
        }else{
            if($lista[$i]['casilla'] != $tempCasilla){
                array_push($listaConteo, $lista[$i]);
                $tempSeccion = $lista[$i]['seccion'];
                $tempCasilla = $lista[$i]['casilla'];
            }
        }
        $tempSeccion = $lista[$i]['seccion'];
        $tempCasilla = $lista[$i]['casilla'];
    }

    $superA = 0;
    $superB = 0;
    $Tmorena = 0;
    $Tpt = 0;
    $Tnalianza = 0;

    foreach($listaConteo as $lista){
        $id = $lista['id_rep'];


        $sen_zona = "SELECT pri, pan, prd, morena, pt, nalianza, pri_pan_prd, pri_pan, pri_prd, pan_prd, morena_pt_nueva, morena_pt, morena_nueva, pt_nueva FROM rep WHERE id_rep = $id";
        $stm = $con->query($sen_zona);
        $casilla = $stm->fetch(PDO::FETCH_ASSOC);

        $superA = $superA + Suma($casilla);
        $superB = $superB + SumaO($casilla);
        $Tmorena = $Tmorena + $casilla['morena'];
        $Tpt = $Tpt + $casilla['pt'];
        $Tnalianza = $Tnalianza + $casilla['nalianza'];
    }
    return $total = array($superA, $superB, $Tmorena, $Tpt, $Tnalianza);
}




?>





<!-- 
function SuperContador($con){


$sen_zona = "SELECT id_rep, seccion, casilla, partido FROM rep WHERE morena !=''";
$stm = $con->query($sen_zona);
$listaConteo = $stm->fetchAll(PDO::FETCH_ASSOC);

$superA = 0;
$superB = 0;
$Tmorena = 0;

foreach($listaConteo as $lista){
    unset($nalianza);
    $nalianza = 0;
    unset($pt);
    $pt = 0;
    unset($morena);
    $morena = 0;

    $seccion = $lista['seccion'];
    $casilla = $lista['casilla'];


    echo $superA . "<br>";


    $sen_zona = "SELECT pri, pan, prd, morena, pt, nalianza, pri_pan_prd, pri_pan, pri_prd, pan_prd, morena_pt_nueva, morena_pt, morena_nueva, pt_nueva FROM rep WHERE morena != '' AND seccion = $seccion AND casilla = '$casilla' AND partido = 3";
    $stm = $con->query($sen_zona);
    $nalianza = $stm->fetch(PDO::FETCH_ASSOC);
    if($nalianza){
        $superA = $superA + Suma($nalianza);
        $superB = $superB + SumaO($nalianza);
        $Tmorena = $Tmorena + $nalianza['morena'];
    }

    
    $sen_zona = "SELECT pri, pan, prd, morena, pt, nalianza, pri_pan_prd, pri_pan, pri_prd, pan_prd, morena_pt_nueva, morena_pt, morena_nueva, pt_nueva FROM rep WHERE morena != '' AND seccion = $seccion AND casilla = '$casilla' AND partido = 2";
    $stm = $con->query($sen_zona);
    $pt = $stm->fetch(PDO::FETCH_ASSOC);
    if($pt){
        $superA = $superA + Suma($pt);
        $superB = $superB + SumaO($pt);
        $Tmorena = $Tmorena + $pt['morena'];
    }
    

    $sen_zona = "SELECT pri, pan, prd, morena, pt, nalianza, pri_pan_prd, pri_pan, pri_prd, pan_prd, morena_pt_nueva, morena_pt, morena_nueva, pt_nueva FROM rep WHERE morena != '' AND seccion = $seccion AND casilla = '$casilla' AND partido = 1";
    $stm = $con->query($sen_zona);
    $morena = $stm->fetch(PDO::FETCH_ASSOC);

    if($morena){
        $superA = $superA + Suma($morena);
        $superB = $superB + SumaO($morena);
        $Tmorena = $Tmorena + $morena['morena'];
    }
}
return $total = array($superA, $superB, $Tmorena);
} -->