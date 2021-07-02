<?php

class Pre{

    function Partido($posicion){
        if($posicion == 1) {
            $img =  'http://metepec.xpertika.com/admin/imgs/mlogo.png';
        }
        if($posicion == 2) {
            $img =  'http://metepec.xpertika.com/admin/imgs/ptlogo.png';
        }
        if($posicion == 3) {
            $img =  'http://metepec.xpertika.com/admin/imgs/nalogo.png';
        }
        return '<img src="'.$img.'" class="rounded mx-auto d-block" alt="">';
    }

    function Status($valor, $id, $step){
        if($valor){
            return '<button class="btn-sm"> <i class="fas fa-check"></i> </button>';
        }
        if(!$valor){
            return '
            <form action="repcap.php" method="post">
                <input type="hidden" name="id" value="'. $id .'">
                <input type="hidden" name="step" value="' . $step . '">
                <button class="btn" type="submit"> <i class="fas fa-edit"></i> </button>
            </form>'; 
        }
    }

}
?>