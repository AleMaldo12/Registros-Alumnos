<?php include("config/conexion.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Registro de Alumnos</title>
<style>
body{font-family:Arial;background:#eef2f7}
.card{
width:380px;margin:40px auto;background:white;
padding:25px;border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,.1)
}
input,select{
width:100%;padding:10px;margin:8px 0;
border:1px solid #ccc;border-radius:6px
}
button{
width:100%;padding:12px;
background:#2563eb;color:white;
border:none;border-radius:8px
}
</style>
</head>
<body>

<div class="card">
<h2>Registro de Alumno</h2>

<form action="alumno_guardar.php" method="POST">

<input name="nombre" placeholder="Nombre" required>
<input name="ap_pat" placeholder="Apellido Paterno" required>
<input name="ap_mat" placeholder="Apellido Materno" required>

<select name="grupo_id" required>
<option value="">Seleccionar Grupo</option>

<?php
$q=$conn->query("SELECT id,nombre_grupo FROM grupos");
while($g=$q->fetch_assoc()){
echo "<option value='{$g['id']}'>{$g['nombre_grupo']}</option>";
}
?>
</select>

<button>Registrar Alumno</button>

</form>
</div>

</body>
</html>
