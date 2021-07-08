<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}
require_once '../conection/conexion.php';
require_once '../conection/conexioni.php';

if($_SESSION['user']['nivel'] == 9){
    header("Location: rep.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Bootstrap CSS -->
    <script src="https://kit.fontawesome.com/d0baa1aa63.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylePanelPrograma.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style>
/*tr:hover { background: gray; }*/
td a { 
    display: block;
    text-decoration: none !important;
}
</style>
    
</head>
<body>

    <?php include 'estructura_inicio.php' ?>   <!--No menear -->

    
    <div class="lname-containerGrl">
    
    

    <?php
        include_once('panelPrograma.php');
    ?>
    </div>
    

    <script>
    function verificarCurp(){
        let expresion = "^([a-zA-Z]{4})+([0-9]{6})+([a-zA-Z]{6})+([0-9a-zA-Z]{2}|[a-zA-Z]{2}|[0-9]{2})+$";
        let contenidoCajaTxt = document.getElementById('inputSmForm'),
            mensajeVerificacion = document.getElementById('mensajeVerificacion');

        let curp = inputSmForm.value;

        if(curp.length <= 17 || curp.length >= 19){
            mensajeVerificacion.innerHTML = "Revise la longitud";
        }else{
            if(curp.match(expresion)){
                return true;
            }else{
                mensajeVerificacion.innerHTML = "Curp inválida";
            }
        }
        return false;
    }
    </script>


    <?php include 'estructura_fin.php'?>  <!--No menear -->

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>