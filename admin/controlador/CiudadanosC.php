<?php
class Datos{
    
    function DatoConfigurable($puesto, $nombre){
        $fulllink = '<a class="btn btn-secondary btn-sm" href="alta_ciudadano.php?id=' . $puesto['id_ciudadano'] . '">';
        if($puesto[$nombre] != ''){
            return $puesto[$nombre];
        }else{
            return $fulllink . '<i class="fas fa-sliders-h"></i></a>';
        }
    }


    function DatosConfigurable($puesto, $nombre, $icotrue, $icofalse){
        $fulllink = '<a class="btn btn-secondary btn-sm" href="alta_ciudadano.php?id=' . $puesto['id_ciudadano'] . '">';
        $boton = '<a class="btn btn-secondary btn-sm">';
        if($puesto[$nombre] != ''){
            if($puesto[$nombre] == 1){
                return $boton . $icotrue . "</a>";
            }else{
                return $boton . $icofalse . "</a>";
            }
        }else{
            return $fulllink . '<i class="fas fa-sliders-h"></i></a>';
        }
    }

    function Edad($puesto, $nombre){
        $fulllink = '<a class="btn btn-secondary btn-sm" href="alta_ciudadano.php?id=' . $puesto['id_ciudadano'] . '">';
        if($puesto[$nombre] != '0000-00-00' && $puesto[$nombre] != ""){
            $edad = date('Y') - date("Y",strtotime($puesto[$nombre]));
            return $edad;
        }else{
            return $fulllink . '<i class="fas fa-sliders-h"></i></a>';
        }
    
    }

    function Capacitacion($ciudadano, $nombre, $colortrue, $colorfalse, $ico, $tooltipTrue, $tooltipFalse){
        if($ciudadano['id_ciudadano']){
            $status = (isset($ciudadano[$nombre])) ? $ciudadano[$nombre] : '';
            $color = (isset($ciudadano[$nombre])) ? $colortrue : $colorfalse;
            $tooltip = (isset($ciudadano[$nombre])) ? $tooltipTrue : $tooltipFalse;
            $fulllink = '<a class="btn btn-' . $color .' btn-sm" title="'. $tooltip . '" href="controlador/adddefensasql.php?' . $nombre .  '=' . $status .'&id=' . $ciudadano['id_ciudadano'].'&origen=ciudadanos">';
                if(isset($ciudadano[$nombre]) && $ciudadano[$nombre] != 0){
                    if($ciudadano[$nombre] == 1){
                        return $fulllink . $ico . '</a>';
                    }
                }else{
                    return $fulllink . $ico . '</a>';
                }
        }
    }


    function posicion($puesto){
        if(isset($puesto['zona'])){
            echo "Z" . $puesto['zona'] . " " . $puesto['seccion'] . ' ';
        }
        if (isset($puesto['casilla']) && $puesto['casilla'] != '') { //
            if($puesto['puesto'] == 0) {
                return $puesto['casilla'] . ' RC1';
            }
            if($puesto['puesto'] == 1) {
                return ''. $puesto['casilla'] . ' RC2';
            }
            if($puesto['puesto'] == 2) {
                return  ''. $puesto['casilla'] . ' RC3';
            }
            if($puesto['puesto'] == 3) {
                return ''. $puesto['casilla'] .  ' RC4';
            }
            if($puesto['puesto'] == 4) {
                return  ''. $puesto['casilla'] . ' SP1';
            }
            if($puesto['puesto'] == 5) {
                return  ''. $puesto['casilla'] . ' SP2';
            }
            if($puesto['puesto'] == 6) {
                return  ''. $puesto['casilla'] . ' SP3';
            }
            if($puesto['puesto'] == 7) {
                return  '' . $puesto['casilla'] . ' SP4';
            }
        }else {
            if(isset($puesto['rg']) && $puesto['rg'] != '') {
                return 'RG';
            }
            if((empty($puesto['rg']) || $puesto['rg'] == '') && (isset($puesto['casilla']) && $puesto['casilla'] == '')) {
                return 'CZ';
            }
        }
    }

}
?>