<?php

if(isset($_GET['periodo'])){
    $periodo = strip_tags(htmlspecialchars($_GET['periodo']));

    if(is_numeric($periodo)){
        setlocale(LC_ALL, "es_ES");
        $fechaDia = date("d");
        $fechaMes = date("m");
        $fechaYear = date("Y");
        $fechaCompleta = "{$fechaDia}/{$fechaMes}/{$fechaYear}";

        switch($periodo){
            case 1:
                // calcular periodo comprendido entre hoy y hoy
                $ConsultaSQLRequerida = "SELECT * FROM REGISTRADOS_PROGRAMA WHERE YEAR(FECHA) = YEAR(CURRENT_DATE()) AND WEEK(FECHA) = WEEK(CURRENT_DATE()) AND DAY(FECHA) = DAY(CURRENT_DATE());";
                break;
            case 2:
                // calcular periodo comprendido entre semana pasada y hoy
                $ConsultaSQLRequerida = "SELECT * FROM REGISTRADOS_PROGRAMA WHERE YEAR(FECHA) = YEAR(CURRENT_DATE()) AND WEEK(FECHA) = WEEK(CURRENT_DATE());";
                break;
            case 3:
                // calcular periodo comprendido entre mes pasado y hoy
                $ConsultaSQLRequerida = "SELECT * FROM REGISTRADOS_PROGRAMA WHERE YEAR(FECHA) = YEAR(CURRENT_DATE()) AND MONTH(FECHA) = MONTH(CURRENT_DATE());";
                break;
            case 4:
                // calcular periodo comprendido entre inicio y hoy
                $ConsultaSQLRequerida = "SELECT * FROM REGISTRADOS_PROGRAMA;";
                break;
            default:
                // En caso de no encontrar nada, mostrar todos los registros
                $ConsultaSQLRequerida = "SELECT * FROM REGISTRADOS_PROGRAMA;";
                break;
        }
        consultaLlenarTabla($ConsultaSQLRequerida);
    }else{
        echo "Error al recuperar el elemento";
    }
}else{
    $ConsultaSQLRequerida = "SELECT * FROM REGISTRADOS_PROGRAMA;";
    consultaLlenarTabla($ConsultaSQLRequerida);
}



function consultaLlenarTabla($consultaSQL){

    $consulta = $consultaSQL;
    $consulta = conectarDBO::conexion()->query($consulta);

    while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)){

        echo "Folio: {$resultado['FOLIO']}";

        
        if($resultado['PELIGRO'] == "si"){
            echo ", se encuentra en peligo";
        }else{
            echo ", todo en orden";
        }

        if($resultado['NUEVO'] == "si"){
            echo ", la solicitud es nueva";
        }else{
            echo ", solicitud pasada";
        }

        if($resultado['VULNERABLE'] == "si"){
            echo ", se encuentra vulnerable";
        }else{
            echo ", normal";
        }

        if($resultado['ESTADO'] == "si"){
            echo ", ha sido completado";
        }else{
            echo ", pendiente";
        }



        echo "<br>";
        





    }

}





?>