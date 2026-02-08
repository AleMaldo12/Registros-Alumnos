<?php
include("conexion.php/conexion.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nombre = trim($_POST['nombre']);
    $apellido_pat = trim($_POST['apellido_pat']);
    $apellido_mat = trim($_POST['apellido_mat']);
    $id_grupo = intval($_POST['id_grupo']);

    if($nombre == "" || $apellido_pat == "" || $apellido_mat == "" || $id_grupo == 0){
        die("Todos los campos son obligatorios");
    }

    $stmt = $conn->prepare("
        INSERT INTO alumno
        (nombre, apellido_pat, apellido_mat, id_grupo)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param("sssi",
        $nombre,
        $apellido_pat,
        $apellido_mat,
        $id_grupo
    );

    if($stmt->execute()){
        header("Location: alumnos_registro.php?ok=1");
    }else{
        echo "Error al guardar alumno";
    }
}
?>
