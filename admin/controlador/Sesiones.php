<?php
// Esta clase busca ahorrar espacio en las validaciones de sesion, mas las validaciones de permisos
session_start();
if (!$_SESSION['user']){
    header("Location: admin/index.php");
    die();
}
header("Content-Type: text/html;charset=utf-8");
require_once '../conection/conexion.php';
require_once '../conection/conexioni.php';