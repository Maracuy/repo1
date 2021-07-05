<?php

$de_ciudadanos = "c.id_ciudadano, c.nombres, c.apellido_p, c.apellido_m, c.telefono, c.seccion_electoral, c.manzana, c.vulnerable, c.genero, c.fecha_nacimiento, c.simpatia";


if ($nivel_admin <= 4) {
    $sentencia2 = "SELECT $de_ciudadanos ,
    d.casilla, d.puesto, d.zona, d.seccion, d.rg, z.capacitacion1 AS cap1, z.capacitacion2 AS cap2
    FROM ciudadanos c
    LEFT JOIN puestos_defensa d ON c.id_ciudadano = d.id_ciudadano
    LEFT JOIN capacitaciones_defensa z ON z.id_ciudadano = c.id_ciudadano
    WHERE c.id_ciudadano > 3
    ORDER BY c.id_ciudadano";
    $sql_query = $con->prepare($sentencia2);
    $sql_query->execute();
    $ciudadanos = $sql_query->fetchALL();
}


if($nivel_admin > 4){
    $stm = $con->query("SELECT * FROM puestos_defensa WHERE id_ciudadano = $id_admin");
    $data_usuario = $stm->fetch(PDO::FETCH_ASSOC);
    
    $zona = $data_usuario['zona'];
    if($data_usuario['rg']){
        $rg = $data_usuario['rg'];
    }
}


if ($nivel_admin == 5) {
    $sentencia = "SELECT $de_ciudadanos ,
    z.capacitacion1 AS cap1, z.capacitacion2 AS cap2,
    d.casilla, d.puesto, d.rg, d.zona, d.seccion
    FROM puestos_defensa d
    INNER JOIN ciudadanos c ON c.id_ciudadano = d.id_ciudadano 
    LEFT JOIN capacitaciones_defensa z ON z.id_ciudadano = c.id_ciudadano
    WHERE d.zona = $zona";

    $sql_query = $con->prepare($sentencia);
    $sql_query->execute();
    $ciudadanos = $sql_query->fetchALL();


    $sentencia2 = "SELECT $de_ciudadanos ,
    z.capacitacion1, z.capacitacion2
    FROM ciudadanos c 
    LEFT JOIN capacitaciones_defensa z ON z.id_ciudadano = c.id_ciudadano 
    WHERE c.id_ciudadano NOT IN (SELECT id_ciudadano FROM puestos_defensa WHERE zona = $zona AND id_ciudadano != '') AND c.id_registrante = $id_admin";
    $sql_query = $con->prepare($sentencia2);
    $sql_query->execute();
    $ciudadanos2 = $sql_query->fetchALL();


    foreach($ciudadanos2 as $n){
        array_push($ciudadanos, $n);
    } 
}


if ($nivel_admin == 6) {
    $sentencia = "SELECT $de_ciudadanos ,
    z.capacitacion1, z.capacitacion2,
    d.casilla, d.puesto, d.rg, d.zona, d.seccion
    FROM puestos_defensa d
    INNER JOIN ciudadanos c ON c.id_ciudadano = d.id_ciudadano 
    LEFT JOIN capacitaciones_defensa z ON z.id_ciudadano = c.id_ciudadano
    WHERE d.rg = $rg";

    $sql_query = $con->prepare($sentencia);
    $sql_query->execute();
    $ciudadanos = $sql_query->fetchALL();


    $sentencia2 = "SELECT $de_ciudadanos ,
    z.capacitacion1, z.capacitacion2
    FROM ciudadanos c 
    LEFT JOIN capacitaciones_defensa z ON z.id_ciudadano = c.id_ciudadano
    WHERE c.id_ciudadano NOT IN (SELECT id_ciudadano FROM puestos_defensa WHERE rg = $rg AND id_ciudadano != '') AND c.id_registrante = $id_admin";
    $sql_query = $con->prepare($sentencia2);
    $sql_query->execute();
    $ciudadanos2 = $sql_query->fetchALL();


    foreach($ciudadanos2 as $n){
        array_push($ciudadanos, $n);
    } 
}

function Estadistica($con){
    $stm = $con->query("SELECT COUNT(id_defensa) FROM puestos_defensa");
    $totales = $stm->fetch();

    $stm = $con->query("SELECT COUNT(id_defensa) FROM puestos_defensa WHERE id_ciudadano != ''");
    $usados = $stm->fetch();

    $stm = $con->query("SELECT COUNT(id_ciudadano) FROM ciudadanos WHERE id_ciudadano >3");
    $total_ciudadanos = $stm->fetch();


    return 'Se han capturado ' . $total_ciudadanos[0] . ' ciudadanos. <br> Se han asignado ' . $usados[0] . ' de los ' . $totales[0] . ' puestos disponibles';
}

?>