<?php
require_once '../../conection/conexion.php';
echo '<pre>';
$sentencia = "SELECT * FROM puestos_defensa";

$stm = $con->query($sentencia);
$puestos = $stm->fetchAll(PDO::FETCH_ASSOC);


$stm = $con->query("SELECT * FROM puestos_defensa");
$defensa2 = $stm->fetchAll(PDO::FETCH_ASSOC);


function Completas($puestos){

    foreach($puestos as $p){
        $puesto = intval($p['puesto']);
        echo $uno = $p['zona'] . "\t" . @$p['rg'] . "\t" . @$p['seccion'] . "\t" . @strtoupper($p['casilla'][1]).@strtoupper($p['casilla'][2]) . "\t";
        echo $puesto;
        if($puesto > 2){
            $puesto = $puesto+1;
            echo "<br>";
            echo $uno . @$puesto;
            echo "<br>";
            $puesto = $puesto+1;
            echo $uno . @$puesto;
            $puesto = $puesto+1;
            echo "<br>";
            echo $uno . @$puesto;
            echo "<br>";
            $puesto = $puesto+1;
            echo $uno . @$puesto;
            echo "<br>";
        }else{
            echo "<br>";
        }
    }
}
    
function Ale($puestos){
    $casilla = "";
    foreach($puestos as $p){
        if($p['casilla'] != $casilla){
            echo $p['seccion'].$p['casilla'] . "<br>";
            $casilla = $p['casilla'];
        }
    }
}




function Copiar($con, $defensa, $defensa2){
    foreach($defensa as $d){
        $id_ciudadano = $d['id_ciudadano'];
        if($d['id_ciudadano'] != '' && $d['id_ciudadano'] != 0){
            if(!$d['rg']){
                $afiliacion = ($d['afiliacion'] != '' ? $d['afiliacion'] : NULL);
                $origen = ($d['origen'] != '' ? $d['origen'] : NULL);
                $up = ($d['up'] != '' ? $d['up'] : NULL);
                $confirmacion = ($d['confirmacion'] != '' ? $d['confirmacion'] : NULL);
                $morena = ($d['morena'] != '' ? $d['morena'] : NULL);
                $ine = ($d['ine'] != '' ? $d['ine'] : NULL);
                $pago = ($d['pago'] != '' ? $d['pago'] : NULL);
                $inamovible = ($d['inamovible'] != '' ? $d['inamovible'] : NULL);

                echo 'Registro un CZ<br>';
                $zona = $d['zona'];
                $con->exec("UPDATE puestos_defensa2 SET id_ciudadano = $id_ciudadano, afiliacion = '$afiliacion', origen = '$origen', up=$up, confirmacion =$confirmacion, morena = $morena, ine=$ine, pago=$pago, inamovible =$inamovible WHERE zona = $zona AND rg = ''");
            }
            if($d['rg'] && $d['seccion'] == ''){
                $afiliacion = ($d['afiliacion'] != '' ? $d['afiliacion'] : NULL);
                $origen = ($d['origen'] != '' ? $d['origen'] : NULL);
                $up = ($d['up'] != '' ? $d['up'] : NULL);
                $confirmacion = ($d['confirmacion'] != '' ? $d['confirmacion'] : NULL);
                $morena = ($d['morena'] != '' ? $d['morena'] : NULL);
                $ine = ($d['ine'] != '' ? $d['ine'] : NULL);
                $pago = ($d['pago'] != '' ? $d['pago'] : NULL);
                $inamovible = ($d['inamovible'] != '' ? $d['inamovible'] : NULL);

                echo 'Registro un RG <br>';
                $rg = $d['rg'];
                $con->exec("UPDATE puestos_defensa2 SET id_ciudadano = $id_ciudadano, afiliacion = '$afiliacion', origen = '$origen', up=$up, confirmacion =$confirmacion, morena = $morena, ine=$ine, pago=$pago, inamovible =$inamovible  WHERE rg = $rg AND seccion = ''");
            }
            if($d['seccion']){
                $seccion = $d['seccion'];
                $casilla = $d['casilla'];
                $casilla = strtoupper($casilla[1]. $casilla[2] . @$casilla['3']);
                $puestob = intval($d['puesto']);
                $afiliacion = ($d['afiliacion'] != '') ? $d['afiliacion'] : NULL;
                $origen = ($d['origen'] != '') ? $d['origen'] : NULL;
                $up = (isset($d['up']) && $d['up'] != '') ? intval($d['up']) : NULL;
                $confirmacion = ($d['confirmacion'] != '') ? intval($d['confirmacion']) : NULL;
                $morena = ($d['morena'] != '') ? intval($d['morena']) : NULL;
                $ine = ($d['ine'] != '') ? intval($d['ine']) : NULL;
                $pago = ($d['pago'] != '') ? intval($d['pago']) : NULL;
                $inamovible = ($d['inamovible'] != '') ? intval($d['inamovible']) : NULL;

                $stm = $con->query("SELECT id_defensa FROM puestos_defensa2 WHERE seccion = '$seccion' AND casilla = '$casilla' AND puesto =$puestob");
                $disp2 = $stm->fetch(PDO::FETCH_ASSOC);

                if($disp2){
                    $puestoN = $disp2['id_defensa'];

                    if($puestob == 0){
                        $puestoN = $puestoN + 1;
                        $con->exec("UPDATE puestos_defensa2 SET id_ciudadano = $id_ciudadano, afiliacion = '$afiliacion', origen = '$origen', up = '$up', confirmacion = '$confirmacion', morena = $morena, ine=$ine, pago=$pago, inamovible =$inamovible WHERE id_defensa = $puestoN");
                        echo "0: " . $id_ciudadano . ' en ' . $puestoN . '<br>';
                    }
                    if($puestob == 1){
                        $puestoN = $puestoN + 2;
                        $con->exec("UPDATE puestos_defensa2 SET id_ciudadano = $id_ciudadano, afiliacion = '$afiliacion', origen = '$origen', up = '$up', confirmacion = '$confirmacion', morena = $morena, ine=$ine, pago=$pago, inamovible =$inamovible WHERE id_defensa = $puestoN");
                        echo "1: " . $id_ciudadano . ' en ' . $puestoN . '<br>';
                    }
                    if($puestob == 2){
                        $puestoN = $puestoN + 2;
                        $con->exec("UPDATE puestos_defensa2 SET id_ciudadano = $id_ciudadano, afiliacion = '$afiliacion', origen = '$origen', up = '$up', confirmacion = '$confirmacion', morena = $morena, ine=$ine, pago=$pago, inamovible =$inamovible WHERE id_defensa = $puestoN");
                        echo "2: " . $id_ciudadano . ' en ' . $puestoN . '<br>';
                    }
                    if($puestob == 3){
                        $puestoN = $puestoN + 2;
                        $con->exec("UPDATE puestos_defensa2 SET id_ciudadano = $id_ciudadano, afiliacion = '$afiliacion', origen = '$origen', up = '$up', confirmacion = '$confirmacion', morena = $morena, ine=$ine, pago=$pago, inamovible =$inamovible WHERE id_defensa = $puestoN");
                        echo "3: " . $id_ciudadano . ' en ' . $puestoN . '<br>';
                    }
                }else{
                    echo 'El ciudadano: ' . $id_ciudadano . 'No tiene lugar. <br>';
                }
            }
        }
    }
}


function mostrar2($defensa2){
    var_dump($defensa2);
}

function la2480($con){
    $stm = $con->query("SELECT * FROM old WHERE seccion = 2480");
    $old = $stm->fetchAll(PDO::FETCH_ASSOC);
    foreach($old as $o){
        if($o['id_ciudadano']){

            echo $o['seccion']. ' ' . $o['casilla'] . " " . $o['puesto'] . ' idC:' . $o['id_ciudadano'] . ' up:'. $o['up']. ' onfirmacion:' . $o['confirmacion'] . ' morena:' . $o['morena'];
            echo "<br>";
            echo "<br>";
        }
    }
}


Copiar($con, $puestos, $defensa2);
//mostrar2($defensa2);
//la2480($con);
?>