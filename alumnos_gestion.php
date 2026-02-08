<?php include("config/conexion.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Alumnos Registrados</title>
<style>
body{font-family:Arial;background:#eef2f7}
.wrap{
width:95%;margin:30px auto;background:white;
padding:20px;border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,.1)
}
table{width:100%;border-collapse:collapse}
th,td{border:1px solid #ddd;padding:10px;text-align:center}
.activo{color:green;font-weight:bold}
.inactivo{color:red;font-weight:bold}
.btn{
padding:6px 10px;border-radius:6px;
color:white;text-decoration:none
}
.edit{background:#16a34a}
.on{background:#2563eb}
.off{background:#f59e0b}
</style>
</head>
<body>

<div class="wrap">
<h2>Gestión de Alumnos</h2>

<table>
<tr>
<th>ID</th>
<th>Alumno</th>
<th>Grupo</th>
<th>Estado</th>
<th>Acciones</th>
</tr>

<?php
$sql="SELECT a.*, g.nombre_grupo
FROM alumnos a
LEFT JOIN grupos g ON g.id=a.grupo_id";

$r=$conn->query($sql);

while($row=$r->fetch_assoc()){

$estado = $row['estado']
? "<span class='activo'>Activo</span>"
: "<span class='inactivo'>Inactivo</span>";

echo "<tr>
<td>{$row['id']}</td>
<td>{$row['nombre']} {$row['apellido_paterno']} {$row['apellido_materno']}</td>
<td>{$row['nombre_grupo']}</td>
<td>$estado</td>
<td>

<a class='btn edit' href='alumno_editar.php?id={$row['id']}'>Modificar</a>

<a class='btn on' href='alumno_activar.php?id={$row['id']}'>Activar</a>

<a class='btn off' href='alumno_inactivar.php?id={$row['id']}'>Inactivar</a>

</td>
</tr>";
}
?>

</table>
</div>

</body>
</html>
