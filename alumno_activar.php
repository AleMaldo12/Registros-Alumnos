<?php
include("conexion.php/conexion.php");

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    $stmt = $conn->prepare("
        UPDATE alumno 
        SET activo = 1 
        WHERE id_alumno = ?
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: alumnos_gestion.php");
exit();
?>
