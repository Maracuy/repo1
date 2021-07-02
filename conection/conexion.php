<?php
date_default_timezone_set('America/Mexico_City');

$conect = 'mysql:host=localhost;dbname=thetest;charset=utf8';
$username = 'root';
$dbpass = '';

try {
    $con = new PDO($conect, $username , $dbpass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  } catch(PDOException $e) {
    echo 'Error conectando con la base de datos: ' . $e->getMessage();
  }
