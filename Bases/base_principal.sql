DROP DATABASE IF EXISTS thetest;
CREATE DATABASE IF NOT EXISTS thetest;
USE thetest;


DROP TABLE IF EXISTS permisos;
CREATE TABLE IF NOT EXISTS permisos(
    numero INT,
    nombre VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO permisos VALUES
(1, 'Super Admin'),
(2, 'Administrador'),
(3, 'Encargado'),
(4, 'Revisiones'),
(5, 'CZ'),
(6, 'RG'),
(7, 'RC'),
(9, 'Capturista'),
(10, 'SIN PERMISOS');



DROP TABLE IF EXISTS origenes;
CREATE TABLE IF NOT EXISTS origenes (
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(255) NOT NULL,
    abreviatura varchar(10) NOT NULL,
    descripcion text NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO origenes (id, nombre, abreviatura, descripcion) VALUES (NULL, 'Origen Pendiente', 'pend', 'Se usa cuando se desconoce el origen');



DROP TABLE IF EXISTS medio_contacto;
CREATE TABLE IF NOT EXISTS medio_contacto (
    id INT NOT NULL AUTO_INCREMENT,
    nombre varchar(30) NOT NULL,
    abreviatura varchar(10) NOT NULL,
    descripcion text NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO medio_contacto (id, nombre, abreviatura, descripcion) VALUES (NULL, 'Medio Pendiente', 'pend', 'Se usa cuando se desconoce el Medio de Contacto');


DROP TABLE IF EXISTS colonias;
CREATE TABLE IF NOT EXISTS colonias(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_colonia VARCHAR(100) NOT NULL,
    abreviatura VARCHAR(5),
    municipio VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO colonias (id, nombre_colonia, municipio) VALUES (NULL, 'Sin colonia', 'Sin municipio');


DROP TABLE IF EXISTS ciudadanos;
CREATE TABLE IF NOT EXISTS ciudadanos(
  id_ciudadano INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nivel INT NOT NULL DEFAULT 10,
  usuario_sistema VARCHAR(20),
  contrasenia VARCHAR(255),
  fecha_captura DATETIME DEFAULT CURRENT_TIMESTAMP,
  nombres VARCHAR(45) NOT NULL,
  apellido_p VARCHAR(45) NOT NULL,
  apellido_m VARCHAR(45) NOT NULL,
  vulnerable INT,
  genero INT NULL DEFAULT NULL,
  curp VARCHAR(20) NULL DEFAULT NULL,
  numero_identificacion VARCHAR(50) NULL DEFAULT NULL,
  telefono VARCHAR(10) NULL DEFAULT NULL,
  otro_telefono VARCHAR(10) NULL,
  email VARCHAR(50) NULL DEFAULT NULL,
  whats INT,
  fecha_nacimiento DATE NULL DEFAULT NULL,
  estado_civil VARCHAR(50) NULL DEFAULT NULL,
  ocupacion VARCHAR(100) NULL DEFAULT NULL,
  pensionado INT NULL DEFAULT NULL,
  enfermedades_cron INT NULL DEFAULT NULL,
  cp VARCHAR(10) NULL DEFAULT NULL,
  dir_calle VARCHAR(255) NULL DEFAULT NULL,
  dir_numero VARCHAR(50) NULL DEFAULT NULL,
  dir_numero_int VARCHAR(50) NULL DEFAULT NULL,
  id_colonia INT NULL DEFAULT NULL,
  otra_colonia VARCHAR(50) NULL DEFAULT NULL,
  municipio VARCHAR(45) NULL DEFAULT NULL,
  zona INT,
  manzana VARCHAR(255) NULL DEFAULT NULL,
  lote VARCHAR(255) NULL DEFAULT NULL,
  dir_referencia VARCHAR(255) NULL DEFAULT NULL,
  seccion_electoral VARCHAR(5) NULL DEFAULT NULL,
  participo_eleccion INT NULL DEFAULT NULL,
  posicion VARCHAR(45) NULL DEFAULT NULL,
  asistio VARCHAR(45) NULL DEFAULT NULL,
  afiliacion VARCHAR(45) NULL DEFAULT NULL,
  simpatia INT,
  origen VARCHAR(255),
  id_registrante INT NOT NULL,
  observaciones TEXT NULL DEFAULT NULL
)ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


DROP TABLE IF EXISTS galaxias;
CREATE TABLE IF NOT EXISTS galaxias(
    id_galaxia INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_ciudadano INT,
    padre INT,
    madre INT,
    conyuge INT,
    hermano INT,
    hijo INT,
    conocido INT,
    referido INT
)ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


DROP TABLE IF EXISTS hermanos;
CREATE TABLE IF NOT EXISTS hermanos(
    id_hermano INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_galaxia INT,
    hermano VARCHAR(255)
)ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


DROP TABLE IF EXISTS hijos;
CREATE TABLE IF NOT EXISTS hijos(
    id_hijo INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_galaxia INT,
    hijo INT
)ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


DROP TABLE IF EXISTS peticiones;
CREATE TABLE IF NOT EXISTS peticiones(
    id_peticion INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_ciudadano INT,
    fecha DATE,
    peticion TEXT,
    estatus INT,
    exito INT
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS documentos;
CREATE TABLE IF NOT EXISTS documentos(
    id_documento INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_ciudadano_subida INT,
    fecha_subida DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_borrada DATETIME,
    id_ciudadano_documento INT,
    tipo_documento VARCHAR(10)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS tareas;
CREATE TABLE IF NOT EXISTS tareas(
    id_tarea INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_ciudadano_crea_tarea INT NOT NULL,
    id_ciudadano_recibe_tarea INT NOT NULL,
    creada_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_limite DATE,
    tarea_titulo VARCHAR(255),
    tarea_descripcion TEXT,
    vista INT,
    prioridad INT,
    realizada INT
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS comentarios;
CREATE TABLE IF NOT EXISTS comentarios(
    id_comentario INT PRIMARY KEY AUTO_INCREMENT,
    texto TEXT,
    fecha_comment TIMESTAMP,
    id_empleado INT,
    id_tarea INT
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS procesos;
CREATE TABLE IF NOT EXISTS procesos(
    id_proceso INT AUTO_INCREMENT PRIMARY KEY,
    id_alta INT,
    id_empleado INT,
    fecha DATE,
    estado INT,
    descripcion TEXT
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS zonas;
CREATE TABLE IF NOT EXISTS zonas(
    id_zona INT AUTO_INCREMENT PRIMARY KEY,
    zona INT,
    color VARCHAR(10)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS representantes_generales;
CREATE TABLE IF NOT EXISTS representantes_generales(
    id_representante_general INT AUTO_INCREMENT PRIMARY KEY,
    representante_general INT,
    id_zona INT,
    id_ciudadano_representante_general INT,
    color VARCHAR(5)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS secciones;
CREATE TABLE IF NOT EXISTS secciones(
    id_seccion INT AUTO_INCREMENT PRIMARY KEY,
    seccion INT,
    id_representante_general INT
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS casillas;
CREATE TABLE IF NOT EXISTS casillas(
    id_casilla INT AUTO_INCREMENT PRIMARY KEY,
    casilla INT,
    tipo_casilla VARCHAR(5),
    id_seccion INT 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS messag;
CREATE TABLE IF NOT EXISTS messag(
 id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
 mensaje TEXT,
 id_ciudadano INT,
 fecha_captura TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS puestos_defensa;
CREATE TABLE IF NOT EXISTS puestos_defensa(
    id_defensa INT AUTO_INCREMENT PRIMARY KEY,
    id_ciudadano INT,
    zona VARCHAR(5),
    rg VARCHAR(5),
    seccion VARCHAR(5),
    casilla VARCHAR(5),
    puesto INT,
    previo INT,
    posicion_prev VARCHAR(10),
    asistio INT,
    compromiso INT,
    afiliacion VARCHAR(255),
    origen VARCHAR(255),
    cubre INT,
    up INT,
    confirmacion INT NOT NULL DEFAULT 0,
    morena INT NOT NULL DEFAULT 0,
    ine INT NOT NULL DEFAULT 0,
    pago INT NOT NULL DEFAULT 0,
    inamovible INT NOT NULL DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS capacitaciones_defensa;
CREATE TABLE IF NOT EXISTS capacitaciones_defensa(
    id_capacitacion INT AUTO_INCREMENT PRIMARY KEY,
    capacitacion1 INT,
    capacitacion2 INT,
    id_ciudadano INT    
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS logins;
CREATE TABLE IF NOT EXISTS logins(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ciudadano INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS ciudadanos_borrados;
CREATE TABLE IF NOT EXISTS ciudadanos_borrados(
    id_ciudadano_borrado INT AUTO_INCREMENT PRIMARY KEY,
    nivel INT NOT NULL DEFAULT 10,
    usuario_sistema VARCHAR(20),
    contrasenia VARCHAR(255),
    fecha_captura DATETIME DEFAULT CURRENT_TIMESTAMP,
    nombres VARCHAR(45) NOT NULL,
    apellido_p VARCHAR(45) NOT NULL,
    apellido_m VARCHAR(45) NOT NULL,
    vulnerable INT,
    genero INT NULL DEFAULT NULL,
    curp VARCHAR(20) NULL DEFAULT NULL,
    numero_identificacion VARCHAR(50) NULL DEFAULT NULL,
    telefono VARCHAR(10) NULL DEFAULT NULL,
    otro_telefono VARCHAR(10) NULL,
    email VARCHAR(50) NULL DEFAULT NULL,
    whats INT,
    fecha_nacimiento DATE NULL DEFAULT NULL,
    cp VARCHAR(10) NULL DEFAULT NULL,
    dir_calle VARCHAR(255) NULL DEFAULT NULL,
    dir_numero VARCHAR(50) NULL DEFAULT NULL,
    dir_numero_int VARCHAR(50) NULL DEFAULT NULL,
    id_colonia INT NULL DEFAULT NULL,
    otra_colonia VARCHAR(50) NULL DEFAULT NULL,
    municipio VARCHAR(45) NULL DEFAULT NULL,
    zona INT,
    manzana VARCHAR(255) NULL DEFAULT NULL,
    lote VARCHAR(255) NULL DEFAULT NULL,
    dir_referencia VARCHAR(255) NULL DEFAULT NULL,
    seccion_electoral VARCHAR(5) NULL DEFAULT NULL,
    participo_eleccion INT NULL DEFAULT NULL,
    posicion VARCHAR(45) NULL DEFAULT NULL,
    asistio VARCHAR(45) NULL DEFAULT NULL,
    afiliacion VARCHAR(45) NULL DEFAULT NULL,
    simpatia INT,
    origen VARCHAR(255),
    id_registrante INT NOT NULL,
    observaciones TEXT NULL DEFAULT NULL,
    borrado INT DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS programas;
CREATE TABLE IF NOT EXISTS programas(
    id_programa INT AUTO_INCREMENT PRIMARY KEY,
    nombre_programa VARCHAR(255) NOT NULL,
    abreviatura_programa VARCHAR(10) NOT NULL,
    pasos
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE DATABASE IF NOT EXISTS thetest;
USE thetest;

#Cambiar codificacion de caracteres
CREATE TABLE IF NOT EXISTS PROGRAMAS_BASE(
    ID_PROGRAMA INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    NOMBRE_PROGRAMA VARCHAR(200) NOT NULL,
    NOMBRE_CORTO_PROGRAMA VARCHAR(200) NOT NULL,
    TIPO_PROGRAMA VARCHAR(25) NOT NULL
) ENGINE=INNODB;

#Consultas 1
#INSERT INTO PROGRAMAS_BASE(NOMBRE_PROGRAMA, NOMBRE_CORTO_PROGRAMA, TIPO_PROGRAMA) VALUES ('Programa 1', 'Ejemplo 1', 'General');
#INSERT INTO PROGRAMAS_BASE(NOMBRE_PROGRAMA, NOMBRE_CORTO_PROGRAMA, TIPO_PROGRAMA) VALUES ('Programa 2', 'Ejemplo 2', 'Local');
#INSERT INTO PROGRAMAS_BASE(NOMBRE_PROGRAMA, NOMBRE_CORTO_PROGRAMA, TIPO_PROGRAMA) VALUES ('Programa 3', 'Ejemplo 3', 'Otro');

#Consulta 2
#SELECT * FROM PROGRAMAS_BASE;

#Nueva tabla para los inscritos en algun programa
CREATE TABLE IF NOT EXISTS PROGRAMAS_REGISTRO(
	ID_REGISTRO INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    ID_PROGRAMA_REGISTRADO INT(50) NOT NULL,
    CURP_CIUDADANO_REGISTRADO INT(50) NOT NULL,
    FECHA_REGISTRO VARCHAR(10) NOT NULL
    # SE MODIFICARA LA TABLA CON NUEVOS CAMPOS SEGUN SE NECESITE, ESTOS SON UNICAMENTE PARA EVALUAR SU REGISTRO
)ENGINE=INNODB;
