<?php

date_default_timezone_set('America/Mexico_City');


class DBConexion{
  var $conect = 'mysql:host=localhost;dbname=thetest;charset=utf8';
  var $username = 'root';
  var $dbpass = '';

  function Conexion(){
    try {
      $con = new PDO($this->conect, $this->username , $this->dbpass);
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $con;      
    } catch(PDOException $e) {
      echo 'Error conectando con la base de datos: ' . $e->getMessage();
    }

  }

  function GET($sentencia){
    $con = $this->Conexion();
    $stm = $con->query($sentencia);
  	$result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}
