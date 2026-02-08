<?php
include("config/conexion.php");
$id=$_GET['id'];
$conn->query("UPDATE alumnos SET estado=0 WHERE id=$id");
header("Location: alumnos_gestion.php");
?>
