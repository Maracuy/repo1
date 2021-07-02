<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}

require_once '../conection/conexion.php';
require_once '../admin/controlador/Crep.php';

$id = $_POST['id'];
$step = $_POST['step'];


function Campo($titulo, $nombre, $size){
    return '
    <div class= "col-md-'.$size.'">
        <label for="'. $nombre .'">' . $titulo . '</label>
            <input class="form-control" type="text" name="' . $nombre . '" id="' . $nombre . '">
        </div>
';
}

function Seleccionable($titulo, $nombre, $size){
    return '
        <div class= "col-md-'.$size.'">
            <input class="form-check-input" type="checkbox" name="' . $nombre . '" id="' . $nombre . '">
            <label class="form-check-label" for="'. $nombre .'">' . $titulo . '</label>
        </div>
        ';
}


function Hora($titulo, $nombre, $size){
    return '
    <div class= "col-md-'.$size.'">
    <label for="'. $nombre .'">' . $titulo . '</label>
        <input type="time" name="" id="">
    </div>
    ';
}

function CualRep(){
    return '
    <div class= "col-md-2">
    <label for="cual_representante">Cual RC?</label>
        <select name="cual_representante" id="cual_representante">
            <option value="0">Ninguno</option>
            <option value="1">Propietario</option>
            <option value="2">Suplente</option>
        </select>
    </div>
    ';
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d0baa1aa63.js" crossorigin="anonymous"></script>
    <style>
        body {
        font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body>


    <div class="container">

        <?php if($step == 1):?>

            <form action="controlador/recapsql.php" method="post">
            <input type="hidden" name="id" value="<?= $id?>">

            <h4>1er Reporte</h4>


                <div class="row">
                    <?= Seleccionable("RC Presente","rc_presente",2)?>
                    <?= CualRep()?>
                    <?= Hora("Hora de Instalación","hora_instalacion", 2) ?>
                    <?= Hora("Hora inicio Votación","inicio_votacion", 2) ?>
                </div>
                
                <br>
                <div class="row">
                    <?= Seleccionable("Se Reemplazo algun Funcionario?","sustitucion_funcionarios",2)?>
                    <?= Campo("Cual sustitucion hubo?","cual_sustitucion", 3)?>
                </div>
                <br>
            
                <div class="row">
                    <?= Seleccionable("Se Contaron las Boletas?","conteo_boletas",2)?>
                    <?= Campo("Cuantas Boletas","boletas_totales", 2)?>
                    <?= Seleccionable("Se firmaron las Boletas?","boletas_firmadas",2)?>
                </div>
                <br>

                <div class="row">
                    <?= Seleccionable("La tinta indeleble funciona?","tinta_funciona",2)?>
                </div>
                <br>
                <br>
                <h5>incidentes al inicio:</h5>
                <div>
                    <input type="checkbox" class="form-check-input" name="ii1" id="ii1" value="1"> <label for="ii1"> El lugar donde va a instalarse la casilla: está cerrado o clausurado.</label> <br>
                    <input type="checkbox" class="form-check-input" name="ii2" id="ii2" value="1"> <label for="ii2"> El lugar donde va a instalarse la casilla: no garantiza el fácil acceso de las personas que acuden a votar </label> <br>
                    <input type="checkbox" class="form-check-input" name="ii2" id="ii2" value="1"> <label for="ii3"> El lugar donde va a instalarse la casilla: no garantiza el secreto del voto. </label><br>
                    <input type="checkbox" class="form-check-input" name="ii4" id="ii4" value="1"> <label for="ii4"> El lugar donde va a instalarse la casilla: se pone en riesgo a quienes acuden a la casilla. </label><br>
                    <input type="checkbox" class="form-check-input" name="ii5" id="ii5" value="1"> <label for="ii5"> La casilla se instala en un lugar difrente al aprobado por el INE </label><br>
                    <input type="checkbox" class="form-check-input" name="ii6" id="ii6" value="1"> <label for="ii6"> Son las 8:15 a.m. y falta una o un funcionario de casilla para completar las seis personas que se necesitan.</label><br>
                </div>
                <br>

                <div class="row">
                    <?= Campo("Otros Incidentes","incidentes1", 4)?>
                </div>
                <br>

                <button class="btn btn-primary" name="1er" id="1er" type="submit">Enviar</button>

            
            </form>
            <?php endif?>
            
            
            
            
            <?php if($step == 2):?>
                <form action="controlador/recapsql.php" method="post">
                <input type="hidden" name="id" value="<?= $id?>">

            
                <h4>2do Reporte</h4>
                <br>

                <div class="row">
                    <?= Seleccionable("Sigue presente el RC?","sigue_presente",3)?>
                    <?= Campo("Cual?","cual_apoyo", 3)?>
                    <?= Seleccionable("Hay Equipo de apoyo?","rg_presente",3)?> 
                    <?= Campo("Afluencia hasta el momento","afluencia_intermedia", 3)?>
                    <?= Hora("Hora del Reporte","hora_reporte", 2) ?>
                </div>       


<br>
                <h5>incidentes al momento:</h5>

                <input type="checkbox" class="form-check-input" name="i21" id="i21" value="1"> <label for="i21"> Un ciudadano vota en la casilla SIN MOSTRAR su credencial para votar. </label> <br>
                <input type="checkbox" class="form-check-input" name="i22" id="i22" value="1"> <label for="i22"> Un ciudadano vota presentando su Credencial para Votar, pero su nombre no aparece en la Lista Nominal. </label><br>
                <input type="checkbox" class="form-check-input" name="i23" id="i23" value="1"> <label for="i23"> Un ciudadano vota Presentando una Credencial para Votar con alteraciones. </label> <br>
                <input type="checkbox" class="form-check-input" name="i24" id="i24" value="1"> <label for="i24"> Un ciudadano vota presentando una Credencial para Votar que no les corresponde </label> <br>
                <input type="checkbox" class="form-check-input" name="i25" id="i25" value="1"> <label for="i25"> Se presentan personas en la fila para votar o dentro de la casilla que portan propaganda a favor o en contra de algún candidato/a o partido político.</label> <br>
                <input type="checkbox" class="form-check-input" name="i26" id="i26" value="1"> <label for="i26"> En la casilla o alrededor de la misma (hasta 50 metros) se advierte la presencia de personas o grupos que realizan actos de proselitismo o llevan propaganda a favor o en contra de algún partido político o candidatura en su vestimenta, accesorios o vehículos, o reparten artículos promocionales.</label> <br>
                <input type="checkbox" class="form-check-input" name="i27" id="i27" value="1"> <label for="i27"> Se presentan grupos que portan en forma deliberada u organizada alguna indumentaria, como camisetas, gorras, pulseras u otros distintivos con los colores que representan a algún partido político. </label> <br>
<br>
                <?= Campo("Otros Incidentes","incidentes2", 4)?>

<button class="btn btn-primary" type="submit" id="2do" name="2do">Enviar</button>

            </form>
       
            <?php endif?>
       
       
            <?php if($step == 3):?>

                <form action="controlador/recapsql.php" method="post">
                <input type="hidden" name="id" value="<?= $id?>">


                <h4>3er Reporte</h4>
                <br>
                <h5>Resultados de la votación por partido:</h5>

                <div class="row">
                    <?= Campo("PAN","pan", 1)?>
                    <?= Campo("PT","pt", 1)?>
                    <?= Campo("MORENA","morena", 1)?>
                    <?= Campo("Fuerza M","fuerza", 1)?>
                    <?= Campo("Nueva A","nalianza", 1)?>
                </div>
                <br>
                <div class="row">
                    <?= Campo("PRI","pri", 1)?>
                    <?= Campo("VERDE","verde", 1)?>
                    <?= Campo("PES","pes", 1)?>
                    <?= Campo("INDEP.","independiente", 1)?>
                </div>
                <br>
                <div class="row">
                    <?= Campo("PRD","prd", 1)?>
                    <?= Campo("MOV.C","mciudadano", 1)?>
                    <?= Campo("RSP","rsp", 1)?>
                    <?= Campo("NO REG.","no_reg", 1)?>
                </div>
                <br>
                <br>
                <h5>Resultados de la votación por coaliciones:</h5>

                <div class="row">
                    <?= Campo("PRI,PAN,PRD","pri_pan_prd", 2)?>
                    <?= Campo("MOR,PT,NA","morena_pt_nueva", 2)?>
                </div>

                <div class="row">
                    <?= Campo("PRI,PAN","pri_pan", 2)?>
                    <?= Campo("MOR,PT","morena_pt", 2)?>
                </div>

                <div class="row">
                    <?= Campo("PRI,PRD","pri_prd", 2)?>
                    <?= Campo("MORENA,NUEVA","morena_nueva", 2)?>
                </div>

                <div class="row">
                    <?= Campo("PAN,PRD","pan_prd", 2)?>
                    <?= Campo("PT,NUEVA","morena_nueva", 2)?>
                </div>
                <br>

                <div class="row">
                    <?= Campo("VOTOS NULOS","votos_nulos", 2)?>
                </div>
                <br>

                <div class="row">
                    <?= Campo("BOLETAS SOBR.","boletas_sobrantes", 2)?>
                </div>
                <br>

                <div class="row">
                    <?= Campo("CIUDADANOS QUE VOTARON","ciudadano_votantes", 2)?>
                </div>
<br>




                <h4>Incidentes</h4>

                <input type="checkbox" class="form-check-input" name="i31" id="i31" value="1"> <label for="i31"> Se clausuró la casilla antes de las 6 p.m. y aún había ciudadanos en la fila para votar </label> <br>
                <input type="checkbox" class="form-check-input" name="i32" id="i32" value="1"> <label for="i32"> El conteo de la votación se lleva a cabo en lugar distinto en donde se recibió la votación</label> <br>
                <input type="checkbox" class="form-check-input" name="i33" id="i33" value="1"> <label for="i33"> Se impide el acceso al representante de partido al escrutinio y computo de la votación </label> <br>
                <input type="checkbox" class="form-check-input" name="i34" id="i34" value="1"> <label for="i34">  Se permite el acceso al escrutinio y computo de la casilla a personas NO aotorizadas (FMDC y REPRESENTATES DE PP) </label> <br>
                <input type="checkbox" class="form-check-input" name="i35" id="i35" value="1"> <label for="i35"> No se le entregan copias de las actas de la jornada electoral al representante de partido polÍtico. </label> <br>
                <br>
                <?= Campo("Otros Incidentes","incidentes3", 4)?>

                <br>
                <button class="btn btn-primary" type="submit" id="3er" name="3er">Enviar</button>
            
            
            </form>
            <?php endif?>

       
        
        </div>
    
    


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>