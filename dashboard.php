<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Dashboard Universidad</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f6f9;
}

.sidebar{
    height:100vh;
    background:#343a40;
    color:white;
    padding:20px;
}

.sidebar a{
    color:white;
    text-decoration:none;
    display:block;
    padding:10px;
    margin-bottom:5px;
    border-radius:5px;
}

.sidebar a:hover{
    background:#495057;
}

.content{
    padding:20px;
}
</style>

</head>
<body>

<div class="container-fluid">
<div class="row">

<!-- SIDEBAR -->
<div class="col-2 sidebar">

<h4>Universidad</h4>
<hr>

<a href="dashboard.php">Inicio</a>
<a href="grupos/registro.php">Registro de Grupos</a>
<a href="catalogos/catalogos.php">Configurar Catálogos</a>

</div>

<!-- CONTENIDO -->
<div class="col-10 content">

<h2>Panel Administrativo</h2>
<p>Bienvenido al sistema escolar.</p>

<div class="row">

<div class="col-md-4">
<div class="card shadow">
<div class="card-body">
<h5>Registro de Grupos</h5>
<a href="grupos/registro.php" class="btn btn-primary">Entrar</a>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow">
<div class="card-body">
<h5>Catálogos</h5>
<a href="catalogos/catalogos.php" class="btn btn-success">Entrar</a>
</div>
</div>
</div>

</div>

</div>
</div>
</div>

</body>
</html>
