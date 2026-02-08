<?php
include("conexion.php/conexion.php");

/* Obtener ID */
if(!isset($_GET['id'])){
    header("Location: alumnos_gestion.php");
    exit();
}

$id = intval($_GET['id']);

/* Obtener alumno */
$stmt = $conn->prepare("
    SELECT * FROM alumno 
    WHERE id_alumno = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$alumno = $stmt->get_result()->fetch_assoc();

/* Obtener grupos */
$grupos = $conn->query("
    SELECT id_grupo, nombre_grupo 
    FROM grupo 
    ORDER BY nombre_grupo
");

/* Guardar cambios */
if(isset($_POST['guardar'])){

    $nombre = trim($_POST['nombre']);
    $apellido_pat = trim($_POST['apellido_pat']);
    $apellido_mat = trim($_POST['apellido_mat']);
    $id_grupo = intval($_POST['id_grupo']);

    $stmt = $conn->prepare("
        UPDATE alumno
        SET nombre=?, apellido_pat=?, apellido_mat=?, id_grupo=?
        WHERE id_alumno=?
    ");

    $stmt->bind_param("sssii",
        $nombre,
        $apellido_pat,
        $apellido_mat,
        $id_grupo,
        $id
    );

    $stmt->execute();

    header("Location: alumnos_gestion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Alumno</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#eef2f7;">

<div class="container mt-5">

<div class="card shadow" style="max-width:500px;margin:auto;">
<div class="card-body">

<h4 class="mb-3 text-center">Editar Alumno</h4>

<form method="POST">

<div class="mb-3">
<label>Nombre</label>
<input 
name="nombre" 
class="form-control" 
value="<?= $alumno['nombre'] ?>" 
required>
</div>

<div class="mb-3">
<label>Apellido Paterno</label>
<input 
name="apellido_pat" 
class="form-control" 
value="<?= $alumno['apellido_pat'] ?>" 
required>
</div>

<div class="mb-3">
<label>Apellido Materno</label>
<input 
name="apellido_mat" 
class="form-control" 
value="<?= $alumno['apellido_mat'] ?>" 
required>
</div>

<div class="mb-3">
<label>Grupo</label>

<select name="id_grupo" class="form-control" required>

<?php while($g = $grupos->fetch_assoc()){ ?>

<option value="<?= $g['id_grupo'] ?>"
<?= $g['id_grupo'] == $alumno['id_grupo'] ? 'selected' : '' ?>>

<?= $g['nombre_grupo'] ?>

</option>

<?php } ?>

</select>

</div>

<button name="guardar" class="btn btn-primary w-100">
Guardar Cambios
</button>

<a href="alumnos_gestion.php" class="btn btn-secondary w-100 mt-2">
Cancelar
</a>

</form>

</div>
</div>

</div>

</body>
</html>
