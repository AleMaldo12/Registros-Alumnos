/* =========================================
   CREAR BASE DE DATOS
========================================= */

CREATE DATABASE IF NOT EXISTS universidad;
USE universidad;


/* =========================================
   TABLA CATALOGO CARRERAS
========================================= */

CREATE TABLE cat_carrera(
    id_carrera INT AUTO_INCREMENT PRIMARY KEY,
    clave VARCHAR(20) NOT NULL UNIQUE,
    activo TINYINT(1) DEFAULT 1
);


/* =========================================
   TABLA CATALOGO TURNOS
========================================= */

CREATE TABLE cat_turno(
    id_turno INT AUTO_INCREMENT PRIMARY KEY,
    clave VARCHAR(10) NOT NULL UNIQUE,
    activo TINYINT(1) DEFAULT 1
);


/* =========================================
   TABLA CATALOGO GRADOS
========================================= */

CREATE TABLE cat_grado(
    id_grado INT AUTO_INCREMENT PRIMARY KEY,
    clave VARCHAR(10) NOT NULL UNIQUE,
    activo TINYINT(1) DEFAULT 1
);


/* =========================================
   TABLA RELACION CARRERA - TURNOS
========================================= */

CREATE TABLE carrera_turno(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_carrera INT,
    id_turno INT,

    FOREIGN KEY (id_carrera) REFERENCES cat_carrera(id_carrera),
    FOREIGN KEY (id_turno) REFERENCES cat_turno(id_turno)
);


/* =========================================
   TABLA RELACION CARRERA - GRADOS
========================================= */

CREATE TABLE carrera_grado(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_carrera INT,
    id_grado INT,

    FOREIGN KEY (id_carrera) REFERENCES cat_carrera(id_carrera),
    FOREIGN KEY (id_grado) REFERENCES cat_grado(id_grado)
);


/* =========================================
   TABLA GRUPOS
========================================= */

CREATE TABLE grupo(
    id_grupo INT AUTO_INCREMENT PRIMARY KEY,

    id_carrera INT NOT NULL,
    id_turno INT NOT NULL,
    id_grado INT NOT NULL,

    nombre_grupo VARCHAR(50) NOT NULL,

    FOREIGN KEY (id_carrera) REFERENCES cat_carrera(id_carrera),
    FOREIGN KEY (id_turno) REFERENCES cat_turno(id_turno),
    FOREIGN KEY (id_grado) REFERENCES cat_grado(id_grado)
);


/* =========================================
   TABLA ALUMNOS
========================================= */

CREATE TABLE alumno(
    id_alumno INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(255) NOT NULL,
    apellido_pat VARCHAR(255) NOT NULL,
    apellido_mat VARCHAR(255) NOT NULL,

    id_grupo INT NOT NULL,

    activo TINYINT(1) DEFAULT 1,

    FOREIGN KEY (id_grupo) REFERENCES grupo(id_grupo)
);


/* =========================================
   DATOS INICIALES RECOMENDADOS
========================================= */

/* ----- Carreras ----- */

INSERT INTO cat_carrera(clave) VALUES
('ISC'),
('LAE'),
('LCPYF'),
('LDI'),
('LRI'),
('LPSC'),
('LIDER'),
('ILT'),
('IAR'),
('IMA'),
('LCSC'),
('LI'),
('LIAF'),
('LAET'),
('LMP'),
('LG'),
('LDM'),
('LP'),
('LCFED'),
('LDG');


/* ----- Turnos ----- */

INSERT INTO cat_turno(clave) VALUES
('M'),
('V'),
('MXT');


/* ----- Grados ----- */

INSERT INTO cat_grado(clave) VALUES
('100'),
('200'),
('300'),
('400'),
('500'),
('600'),
('700'),
('800'),
('900'),
('1000'),
('1100');


/* =========================================
   RELACIONAR TODAS LAS CARRERAS
   CON TODOS LOS TURNOS
========================================= */

INSERT INTO carrera_turno(id_carrera, id_turno)
SELECT c.id_carrera, t.id_turno
FROM cat_carrera c
CROSS JOIN cat_turno t;


/* =========================================
   RELACIONAR TODAS LAS CARRERAS
   CON TODOS LOS GRADOS
========================================= */

INSERT INTO carrera_grado(id_carrera, id_grado)
SELECT c.id_carrera, g.id_grado
FROM cat_carrera c
CROSS JOIN cat_grado g;
