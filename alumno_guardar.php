<?php
include("config/conexion.php");

$n=$_POST['nombre'];
$ap=$_POST['ap_pat'];
$am=$_POST['ap_mat'];
$g=$_POST['grupo_id'];

$conn->query("INSERT INTO alumnos
(nombre,apellido_paterno,apellido_materno,grupo_id,estado)
VALUES('$n','$ap','$am','$g',1)");

echo "Alumno registrado correctamente";
?>
