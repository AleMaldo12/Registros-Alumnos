CREATE DATABASE Universidad;
USE Universidad;

CREATE TABLE rel_carrera_turno(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_carrera INT,
    id_turno INT
);

CREATE TABLE rel_carrera_grado(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_carrera INT,
    id_grado INT
);
select * from grupo;

INSERT INTO rel_carrera_turno VALUES (NULL,1,2);
INSERT INTO rel_carrera_grado VALUES (NULL,1,1);
INSERT INTO rel_carrera_grado VALUES (NULL,1,2);
INSERT INTO rel_carrera_grado VALUES (NULL,1,3);



CREATE TABLE cat_carrera(
    id_carrera INT AUTO_INCREMENT PRIMARY KEY,
    clave VARCHAR(20) UNIQUE,
    activo TINYINT(1) DEFAULT 1
);

CREATE TABLE cat_turno(
    id_turno INT AUTO_INCREMENT PRIMARY KEY,
    clave VARCHAR(5) UNIQUE,
    activo TINYINT(1) DEFAULT 1
);

CREATE TABLE cat_grado(
    id_grado INT AUTO_INCREMENT PRIMARY KEY,
    clave VARCHAR(5) UNIQUE,
    activo TINYINT(1) DEFAULT 1
);

INSERT INTO cat_carrera (clave) VALUES
('ISC'),('IMA'),('IAR');

INSERT INTO cat_turno (clave) VALUES
('M'),('V'),('MXT');

INSERT INTO cat_grado (clave) VALUES
('1'),('2'),('3'),('4'),('5');

/*
CREATE TABLE alumno(
    id_alumno INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    apellido_pat VARCHAR(255),
    apellido_mat VARCHAR(255),
    carrera ENUM(
        'LAE','LCPYF','LDI','LRI','LPSC','LIDER','ISC','ILT',
        'IAR','IMA','LCSC','LI','LIAF','LAET','LMP','LG',
        'LDM','LP','LCFED','LDG'
    ) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE grupo(
    id_grupo INT AUTO_INCREMENT PRIMARY KEY,
    grado ENUM('100','200','300','400','500','600','700','800','900','1000','1100'),
    turno ENUM('M','V','MXT') NOT NULL
) ENGINE=InnoDB;
