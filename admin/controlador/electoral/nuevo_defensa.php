<?php

    $consultapues = $con->query("SELECT * FROM puestos_defensa_casillas WHERE id_puesto = $id_puesto");
    $puesto = $consultapues->fetch(PDO::FETCH_ASSOC);
    $id_casilla = $puesto['id_casilla'];
    
    $consultacas = $con->query("SELECT * FROM casillas WHERE id_casilla = $id_puesto");
    $casilla = $consultacas->fetch(PDO::FETCH_ASSOC);
    $id_seccion = $casilla['id_seccion'];
    
    $consultasecc = $con->query("SELECT * FROM secciones WHERE seccion = $id_seccion");
    $seccion = $consultasecc->fetch(PDO::FETCH_ASSOC);
    $id_representante_general = $seccion['id_representante_general'];
    
    $consultarg = $con->query("SELECT * FROM representantes_generales WHERE id_representante_general = $id_representante_general");
    $representante = $consultarg->fetch(PDO::FETCH_ASSOC);
    $id_zona = $representante['id_zona'];

?>