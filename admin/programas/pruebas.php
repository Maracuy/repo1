<?php


/*

CREATE TABLE IF NOT EXISTS LISTA_CIUDADANOS_PROCESO_PROGRAMA(
	ID_REGISTRO INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    ID_CIUDADANO INT(50) NOT NULL,
    INDICE_PROCESO TEXT NOT NULL,
    INDICE_FECHAS TEXT NOT NULL,
    INDICE_ANOTACIONES TEXT NOT NULL,
    ULTIMA_ACTUALIZACION VARCHAR(10) NOT NULL
)ENGINE=INNODB;

*/


// Objeto creado para pruebas
$varejemplo = new CiudadanosLista(1, [1 => "proceso1", 2 => "proceso2"], [1 => "fecha1", 2 => "fecha2"], [1 => "anotacion1", 2 => "anotacion2"]);

// ESTAS 2 FUNCIONES ACTUALIZAN LOS DATOS AUTOMATICAMENTE!
// Insertar nuevo proceso realizado
$varejemplo->setAgregarElementoAListaCiudadano(4, "nuevoProceso", "nuevaFecha", "nuevaAnotacion");

// Eliminar proceso realizado
//$varejemplo->setEliminarElementoAListaCiudadano(1);