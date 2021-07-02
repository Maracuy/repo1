<?php
class Ciudadano{

    function CampoEditable($ciudadano, $nombre, $nombreCompleto, $size, $requerido, $tamaño){
        if($tamaño){
            $zize = 'minlength="'. $tamaño .'" maxlength="'. $tamaño .'"';
        }else{
            $zize = "";
        }
        if(isset($ciudadano) && $ciudadano != ''){
            return '
            <div class="form-group col-md-' . $size . '">
                <label for="' . $nombre . '">' . $nombreCompleto . '</label>
                <input type="text"' . $zize . 'value="' . $ciudadano[$nombre] .'" class="form-control" id="' . $nombre . '" name="' . $nombre . '"' . $requerido . '">
            </div>';
        }else{
            return '
            <div class="form-group col-md-' . $size . '">
                <label for="' . $nombre . '">' . $nombreCompleto . '</label>
                <input type="text"'. $zize .'class="form-control" id="' . $nombre . '" name="' . $nombre . '">
            </div>';
        }
    }

    function Fechas($ciudadano, $nombre, $nombreCompleto, $size){
        if(isset($ciudadano) && $ciudadano != ''){
            return '
            <div class="form-group col-md-' . $size . '">
                <label for="' . $nombre . '">' . $nombreCompleto . '</label>
                <input type="date" value="' . $ciudadano['fecha_nacimiento'] . '" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
            </div>';
        }else{
            return '
            <div class="form-group col-md-' . $size . '">
                <label for="' . $nombre . '">' . $nombreCompleto . '</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
            </div>';
        }
    }
}
?>