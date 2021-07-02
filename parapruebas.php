<?php

require_once 'conection/conexion.php';
//$mensaje = "Andres AO!";

// Esto sirve para hacer deletes, no regresa nada.
//$nrows = $con->exec("DELETE FROM programas_federales WHERE id_programa_federal = 9");


//Para requerir informacion
/* $stm = $con->query("SELECT * FROM altas WHERE id_alta =");
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);

var_dump($rows);

// Para el last ID
$rowid = $con->lastInsertId();




$sql_editar = "UPDATE ciudadanos SET $keysString WHERE id_ciudadano=$id";
$sentencia_agregar = $con->prepare($sql_editar);
try{
    $sentencia_agregar->execute($values);


/* $id_ciudadano =1;


$stm = $con->query("SELECT a.*, p* FROM altas a, programas_federales p WHERE a.id_ciudadano = $id_ciudadano AND p.id_programa_federal = a.id_programa_f");
$federales = $stm->fetchAll(PDO::FETCH_ASSOC);
var_dump($federales); */


?>



<!-- <p>Click the button to display a confirm box.</p>

<button onclick="myFunction('1')">Try it</button>

nuevo
<input id="EditBanner" type="button" onclick="numero(5);"/>


<p id="demo"></p> -->

<script>
/* function numero(numero){
    alert (numero);
}


function myFunction(p1) {
    if(confirm("my text here")) document.location = 'http://stackoverflow.com?id=' + p1;
}
 */





 // Para listas <datalist>
  
</script>


<script>


let i = "global";
function foo() {
    i = "local"; // Otra variable local solo para esta función
    console.log(i); // local
}
foo();
console.log(i); // global
</script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td><a href="" style="text-decoration: none; color: black;" data-toggle="tooltip" data-placement="top" title="Organizar por ZONA"> este es un texto </a> </td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</body>
</html>
