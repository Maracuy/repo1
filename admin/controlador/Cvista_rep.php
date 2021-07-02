<?php

class Vista{

    function Partido($con, $seccion, $casilla, $partido){

        $sen_zona = "SELECT zona, seccion, casilla, partido, pan, pri, prd, pt, verde, mciudadano, morena, nalianza, pes, rsp, fuerza, independiente, no_reg, pri_pan_prd, pri_pan, pri_prd, pan_prd, morena_pt_nueva, morena_pt, morena_nueva, pt_nueva
        FROM rep
        WHERE seccion = $seccion AND casilla = '$casilla' AND partido = $partido AND morena != ''";
        $stm = $con->query($sen_zona);
        $partido = $stm->fetch(PDO::FETCH_ASSOC);
        if($partido){
            return $partido;
        }else{
            return 0;
        }
    }



}




?>