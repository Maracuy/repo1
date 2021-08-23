#Ejecutar consultas antes de correr programa
#DATABASE - TABLE (consultas necesarias en la base, esto deberia ser dinamico en un futuro)

CREATE TABLE IF NOT EXISTS LISTA_CIUDADANOS_PROCESO_PROGRAMA(
	ID_REGISTRO INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    ID_CIUDADANO INT(50) NOT NULL,
    ID_PROCESO INT(50) NOT NULL,
    INDICE_PROCESO TEXT NOT NULL,
    INDICE_FECHAS TEXT NOT NULL,
    INDICE_ANOTACIONES TEXT NOT NULL,
    ULTIMA_ACTUALIZACION VARCHAR(10) NOT NULL
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS LISTA_PROCESOS(
    ID_PROCESO INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    ID_PROGRAMA INT(50) NOT NULL,
    PASOS TEXT NOT NULL,
    FECHAS TEXT NOT NULL
)ENGINE=INNODB;

INSERT INTO lista_procesos(ID_PROGRAMA, PASOS, FECHAS) VALUES (13, '1|Prender luces intermitentes|2|Bajarse del auto|3|Localizar llanta en mal estado|4|Ir por refaccion y herramienta|5|Quitar llanta (paso acelerado para evitar tantos datos)|6|cambiar LLanta y guardar|7|Subirse y continuar el camino', '1|01/09/2021|2|02/09/2021|3|03/09/2021|4|04/09/2021|5|05/09/2021|6|06/09/2021|7|07/09/2021');