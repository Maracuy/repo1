<?php
date_default_timezone_set('America/Mexico_City');

$server = "localhost"; 
$usuario = "u235387680_054";
$password = "U1?@FGJqOHx";
$database = "u235387680_054";

try {
    $mysqli = new mysqli($server, $usuario, $password, $database);
    $mysqli->set_charset("utf8");
  } catch(PDOException $e) {
    echo 'Error conectando con la base de datos: ' . $e->getMessage();
  }