<?php
include("conexion.php/conexion.php");

/* Obtener alumnos con grupo */
$sql = "
SELECT 
    a.id_alumno,
    a.nombre,
    a.apellido_pat,
    a.apellido_mat,
    a.activo,
    g.nombre_grupo
FROM alumno a
LEFT JOIN grupo g ON g.id_grupo = a.id_grupo
ORDER BY a.id_alumno DESC
";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Alumnos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#eef2f7;
}
.estado-activo{
    color:green;
    font-weight:bold;
}
.estado-inactivo{
    color:red;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="container mt-5">

<div class="card shadow">
<div class="card-body">

<h3 class="mb-4">Gestión de Alumnos</h3>

<table class="table table-bordered table-hover">

<thead class="table-dark">
<tr>
<th>ID</th>
<th>Alumno</th>
<th>Grupo</th>
<th>Estado</th>
<th>Acciones</th>
</tr>
</thead>

<tbody>

<?php while($row = $resultado->fetch_assoc()){ ?>

<tr>

<td><?= $row['id_alumno'] ?></td>

<td>
<?= $row['nombre']." ".$row['apellido_pat']." ".$row['apellido_mat'] ?>
</td>

<td><?= $row['nombre_grupo'] ?? 'Sin grupo' ?></td>

<td>
<?php if($row['activo']){ ?>
<span class="estado-activo">Activo</span>
<?php }else{ ?>
<span class="estado-inactivo">Inactivo</span>
<?php } ?>
</td>

<td>

<a class="btn btn-success btn-sm"
href="alumno_editar.php?id=<?= $row['id_alumno'] ?>">
Modificar
</a>

<a class="btn btn-primary btn-sm"
href="alumno_activar.php?id=<?= $row['id_alumno'] ?>">
Activar
</a>

<a class="btn btn-warning btn-sm"
href="alumno_inactivar.php?id=<?= $row['id_alumno'] ?>">
Inactivar
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<a href="dashboard.php" class="btn btn-secondary">
Volver al Dashboard
</a>

</div>
</div>

</div>

</body>
</html>
