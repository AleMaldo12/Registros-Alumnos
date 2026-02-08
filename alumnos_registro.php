<?php
include("conexion.php/conexion.php");

/* Obtener grupos activos */
$grupos = $conn->query("
    SELECT id_grupo, nombre_grupo 
    FROM grupo 
    ORDER BY nombre_grupo
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro de Alumnos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#eef2f7;
}
.card-form{
    max-width:420px;
    margin:auto;
}
</style>

</head>

<body>

<div class="container mt-5">

<div class="card shadow card-form">
<div class="card-body">

<h4 class="mb-3 text-center">Registro de Alumno</h4>

<form action="alumno_guardar.php" method="POST">

<div class="mb-3">
<label>Nombre</label>
<input name="nombre" class="form-control" required>
</div>

<div class="mb-3">
<label>Apellido Paterno</label>
<input name="apellido_pat" class="form-control" required>
</div>

<div class="mb-3">
<label>Apellido Materno</label>
<input name="apellido_mat" class="form-control" required>
</div>

<div class="mb-3">
<label>Grupo</label>

<select name="id_grupo" class="form-control" required>
<option value="">Seleccionar Grupo</option>

<?php while($g = $grupos->fetch_assoc()){ ?>

<option value="<?= $g['id_grupo'] ?>">
<?= $g['nombre_grupo'] ?>
</option>

<?php } ?>

</select>

</div>

<button class="btn btn-primary w-100">
Registrar Alumno
</button>

<a href="dashboard.php" class="btn btn-secondary w-100 mt-2">
Volver al Dashboard
</a>

</form>

</div>
</div>

</div>

</body>
</html>
