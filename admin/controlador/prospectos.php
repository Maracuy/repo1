<?php

$consulta = "SELECT * FROM ciudadanos WHERE borrado !=1";
$sql_query_ciudadanos = $con->prepare($consulta);
$sql_query_ciudadanos->execute();
$ciudadanos = $sql_query_ciudadanos->fetchALL();





?>