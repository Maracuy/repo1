<?php
class Defensa{
    private $puesto;

    function posicion($puesto){
        if ($puesto['casilla']) { //
            if($puesto['puesto'] == 0) {
                return 'RC1';
            }
            if($puesto['puesto'] == 1) {
                return 'RC2';
            }
            if($puesto['puesto'] == 2) {
                return 'RC3';
            }
            if($puesto['puesto'] == 3) {
                return 'RC4';
            }
            if($puesto['puesto'] == 4) {
                return 'SP1';
            }
            if($puesto['puesto'] == 5) {
                return 'SP2';
            }
            if($puesto['puesto'] == 6) {
                return 'SP3';
            }
            if($puesto['puesto'] == 7) {
                return 'SP4';
            }
        }else {
            if ($puesto['rg']) {
                if($puesto['puesto'] == 0){
                    return 'RG M';
                }else{
                    return 'RG2';
                }
            }else {
                return 'CZ';
            }
        }
    }

    function Flechas($puesto){
        if ($puesto['id_ciudadano']) {
            $dato=0;
            $flecha_ = '';
            $flecha_up = '<a href="controlador/posicionessql.php?posicion=' . $puesto['id_defensa'] . '&dato=up">  <i class="fas fa-chevron-up"></i>  </a>';
            $flecha_down = '<a href="controlador/posicionessql.php?posicion=' . $puesto['id_defensa'] . '&dato=down">  <i class="fas fa-chevron-down"></i>  </a>';
            if ($puesto['casilla']) {
                if($puesto['puesto'] == 0){
                    return $flecha_down;
                }
                if ($puesto['puesto'] > 0 && $puesto['puesto'] < 7 ) {
                    return $flecha_up . $flecha_down;
                }
                if($puesto['puesto'] == 7){
                    return $flecha_up;
                }
            }
        }
    }

    function Colores($puesto){
        if ($puesto['casilla']) { //
            if ($puesto['puesto'] == 0) {
                return 'table-primary';
            }
            if ($puesto['puesto'] == 1) {
                return 'table-secondary';
            }
            if ($puesto['puesto'] == 2) {
                return 'table-secondary';
            }
            if ($puesto['puesto'] == 3) {
                return 'table-secondary';
            }
            if ($puesto['puesto'] == 4) {
                return 'table-secondary';
            }
            if ($puesto['puesto'] == 5) {
                return 'table-secondary';
            }
            if ($puesto['puesto'] == 6) {
                return 'table-secondary';
            }
            if ($puesto['puesto'] == 7) {
                return 'table-secondary';
            }
        }else {
            if ($puesto['rg']) {
                return 'table-warning';
            }else {
                return 'table-danger';
            }
        }
    }


    function ElementoBoton($puesto, $nombre, $colortrue, $colorfalse, $ico, $tooltipTrue, $tooltipFalse){
        if($puesto['id_ciudadano']){
            if($puesto[$nombre] != ''){
                $status = $puesto[$nombre];
                $color = ($puesto[$nombre]) ? $colortrue : $colorfalse;
                $tooltip = ($puesto[$nombre]) ? $tooltipTrue : $tooltipFalse;
                $fulllink = '<a class="btn btn-' . $color .' btn-sm" title="'. $tooltip . '" href="controlador/adddefensasql.php?' . $nombre .  '=' . $status .'&id=' . $puesto['id_defensa'] . '">';
                if($puesto[$nombre] == 1){
                    return $fulllink . $ico . '</a>';
                }else{
                    return $fulllink . $ico . '</a>';
                }
            }
        }
    }


    function Capacitacion($puesto, $nombre, $colortrue, $colorfalse, $ico, $tooltipTrue, $tooltipFalse){
        if($puesto['id_ciudadano']){
            $status = $puesto[$nombre];
            $color = ($puesto[$nombre]) ? $colortrue : $colorfalse;
            $tooltip = ($puesto[$nombre]) ? $tooltipTrue : $tooltipFalse;
            $fulllink = '<a class="btn btn-' . $color .' btn-sm" title="'. $tooltip . '" href="controlador/adddefensasql.php?' . $nombre .  '=' . $status .'&id=' . $puesto['id_ciudadano'] . '&def=' . $puesto['id_defensa'] . '&origen=defensa">';
            if($puesto[$nombre] != 0){
                if($puesto[$nombre] == 1){
                    return $fulllink . $ico . '</a>';
                }
            }else{
                return $fulllink . $ico . '</a>';
            }
        }
    }



    //Esta funcion regresa un Boton con Icono True o icono False, Ademas de un Tooltop True o False.
    function ConfBotonIco($puesto, $nombre, $icoTrue, $icoFalse, $tooltipTrue, $tooltipFalse){
        if($puesto['id_ciudadano']){
            if($puesto[$nombre] != ''){
                $status = $puesto[$nombre];
                $ico = ($puesto[$nombre]) ? $icoTrue : $icoFalse;
                $tooltip = ($puesto[$nombre]) ? $tooltipTrue : $tooltipFalse;
                $fulllink = '<a class="btn btn-secondary btn-sm" title="'. $tooltip . '" href="controlador/adddefensasql.php?' . $nombre .  '=' . $status .'&id=' . $puesto['id_defensa'] . '">';
                if($puesto[$nombre] == 1){
                    return $fulllink . $ico . '</a>';
                }else{
                    return $fulllink . $ico . '</a>';
                }
            }else{
                return '<a class="btn btn-secondary btn-sm" href="electoral.php?id=' . $puesto[$nombre] .'"><i class="fas fa-sliders-h"></i></a>';
            }
        }
    }


    function DatoConfigurable($ciudadano, $campo){
        if($ciudadano){
                return $campo;
        }
    }

    function Colonia($puesto){
        if($puesto['id_ciudadano']){
            $fulllink = '<a class="btn btn-secondary btn-sm" href="alta_ciudadano.php?id=' . $puesto['id_ciudadano'] . '">';
            if($puesto['abreviatura'] != ''){
                return $puesto['abreviatura'];
            }
            if($puesto['municipio'] != ''){
                return $puesto['municipio'];
            }
            return $fulllink;
        }
    }

    function Zona($color, $zona){
        return '<a class="btn btn-sm" style="background-color: #'.$color.'; color: white;">' .$zona. '</a>';
    }


}

?>