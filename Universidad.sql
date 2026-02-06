CREATE DATABASE Universidad;
USE Universidad;

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
