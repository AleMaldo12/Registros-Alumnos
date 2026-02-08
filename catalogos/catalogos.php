<?php
include("../config/conexion.php");

/* VARIABLES EDICIÓN */
$editarCarrera = null;
$editarTurno = null;
$editarGrado = null;


/* =========================
   CRUD CARRERAS
=========================*/

if(isset($_POST['guardarCarrera'])){

    $clave = strtoupper(trim($_POST['nuevaCarrera']));
    $id = $_POST['idCarrera'];

    if($id == ""){

        $verificar = $conn->query("SELECT * FROM cat_carrera WHERE clave='$clave'");

        if($verificar->num_rows == 0){
            $conn->query("INSERT INTO cat_carrera(clave) VALUES('$clave')");
        }

    }else{

        $conn->query("UPDATE cat_carrera SET clave='$clave' WHERE id_carrera=$id");
    }

    header("Location: catalogos.php");
    exit();
}

if(isset($_GET['editarCarrera'])){
    $id = intval($_GET['editarCarrera']);
    $editarCarrera = $conn->query("SELECT * FROM cat_carrera WHERE id_carrera=$id")->fetch_assoc();
}

if(isset($_GET['toggleCarrera'])){
    $id = intval($_GET['toggleCarrera']);
    $conn->query("UPDATE cat_carrera SET activo = NOT activo WHERE id_carrera = $id");
    header("Location: catalogos.php");
    exit();
}


/* =========================
   CRUD TURNOS
=========================*/

if(isset($_POST['guardarTurno'])){

    $clave = strtoupper(trim($_POST['nuevoTurno']));
    $id = $_POST['idTurno'];

    if($id == ""){

        $verificar = $conn->query("SELECT * FROM cat_turno WHERE clave='$clave'");

        if($verificar->num_rows == 0){
            $conn->query("INSERT INTO cat_turno(clave) VALUES('$clave')");
        }

    }else{

        $conn->query("UPDATE cat_turno SET clave='$clave' WHERE id_turno=$id");
    }

    header("Location: catalogos.php");
    exit();
}

if(isset($_GET['editarTurno'])){
    $id = intval($_GET['editarTurno']);
    $editarTurno = $conn->query("SELECT * FROM cat_turno WHERE id_turno=$id")->fetch_assoc();
}

if(isset($_GET['toggleTurno'])){
    $id = intval($_GET['toggleTurno']);
    $conn->query("UPDATE cat_turno SET activo = NOT activo WHERE id_turno = $id");
    header("Location: catalogos.php");
    exit();
}


/* =========================
   CRUD GRADOS
=========================*/

if(isset($_POST['guardarGrado'])){

    $clave = strtoupper(trim($_POST['nuevoGrado']));
    $id = $_POST['idGrado'];

    if($id == ""){

        $verificar = $conn->query("SELECT * FROM cat_grado WHERE clave='$clave'");

        if($verificar->num_rows == 0){
            $conn->query("INSERT INTO cat_grado(clave) VALUES('$clave')");
        }

    }else{

        $conn->query("UPDATE cat_grado SET clave='$clave' WHERE id_grado=$id");
    }

    header("Location: catalogos.php");
    exit();
}

if(isset($_GET['editarGrado'])){
    $id = intval($_GET['editarGrado']);
    $editarGrado = $conn->query("SELECT * FROM cat_grado WHERE id_grado=$id")->fetch_assoc();
}

if(isset($_GET['toggleGrado'])){
    $id = intval($_GET['toggleGrado']);
    $conn->query("UPDATE cat_grado SET activo = NOT activo WHERE id_grado = $id");
    header("Location: catalogos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Configuración de Catálogos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f4f6f9;">

<div class="container mt-5">

<h2 class="mb-4">Configuración de Catálogos</h2>


<!-- ================= CARRERAS ================= -->

<div class="card shadow mb-4">
<div class="card-body">

<h4>Carreras</h4>

<form method="POST" class="mb-3">

<div class="input-group">

<input type="text"
name="nuevaCarrera"
class="form-control"
placeholder="Nueva carrera"
value="<?= $editarCarrera['clave'] ?? '' ?>"
required>

<input type="hidden" name="idCarrera" value="<?= $editarCarrera['id_carrera'] ?? '' ?>">

<button name="guardarCarrera" class="btn btn-primary">
<?= $editarCarrera ? 'Actualizar' : 'Agregar' ?>
</button>

<?php if($editarCarrera){ ?>
<a href="catalogos.php" class="btn btn-secondary">Cancelar</a>
<?php } ?>

</div>

</form>

<table class="table table-bordered">

<tr>
<th>Clave</th>
<th>Estado</th>
<th>Acción</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM cat_carrera ORDER BY clave");

while($row = $res->fetch_assoc()){
?>

<tr>

<td><?= $row['clave'] ?></td>

<td>
<?= $row['activo'] ?
'<span class="badge bg-success">Activo</span>' :
'<span class="badge bg-danger">Inactivo</span>' ?>
</td>

<td>

<a href="?editarCarrera=<?= $row['id_carrera'] ?>" class="btn btn-info btn-sm">Editar</a>

<a href="?toggleCarrera=<?= $row['id_carrera'] ?>" class="btn btn-warning btn-sm">Cambiar Estado</a>

</td>

</tr>

<?php } ?>

</table>

</div>
</div>


<!-- ================= TURNOS ================= -->

<div class="card shadow mb-4">
<div class="card-body">

<h4>Turnos</h4>

<form method="POST" class="mb-3">

<div class="input-group">

<input type="text"
name="nuevoTurno"
class="form-control"
placeholder="Nuevo turno"
value="<?= $editarTurno['clave'] ?? '' ?>"
required>

<input type="hidden" name="idTurno" value="<?= $editarTurno['id_turno'] ?? '' ?>">

<button name="guardarTurno" class="btn btn-primary">
<?= $editarTurno ? 'Actualizar' : 'Agregar' ?>
</button>

<?php if($editarTurno){ ?>
<a href="catalogos.php" class="btn btn-secondary">Cancelar</a>
<?php } ?>

</div>

</form>

<table class="table table-bordered">

<tr>
<th>Clave</th>
<th>Estado</th>
<th>Acción</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM cat_turno ORDER BY clave");

while($row = $res->fetch_assoc()){
?>

<tr>

<td><?= $row['clave'] ?></td>

<td>
<?= $row['activo'] ?
'<span class="badge bg-success">Activo</span>' :
'<span class="badge bg-danger">Inactivo</span>' ?>
</td>

<td>

<a href="?editarTurno=<?= $row['id_turno'] ?>" class="btn btn-info btn-sm">Editar</a>

<a href="?toggleTurno=<?= $row['id_turno'] ?>" class="btn btn-warning btn-sm">Cambiar Estado</a>

</td>

</tr>

<?php } ?>

</table>

</div>
</div>


<!-- ================= GRADOS ================= -->

<div class="card shadow mb-4">
<div class="card-body">

<h4>Grados</h4>

<form method="POST" class="mb-3">

<div class="input-group">

<input type="text"
name="nuevoGrado"
class="form-control"
placeholder="Nuevo grado"
value="<?= $editarGrado['clave'] ?? '' ?>"
required>

<input type="hidden" name="idGrado" value="<?= $editarGrado['id_grado'] ?? '' ?>">

<button name="guardarGrado" class="btn btn-primary">
<?= $editarGrado ? 'Actualizar' : 'Agregar' ?>
</button>

<?php if($editarGrado){ ?>
<a href="catalogos.php" class="btn btn-secondary">Cancelar</a>
<?php } ?>

</div>

</form>

<table class="table table-bordered">

<tr>
<th>Clave</th>
<th>Estado</th>
<th>Acción</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM cat_grado ORDER BY clave");

while($row = $res->fetch_assoc()){
?>

<tr>

<td><?= $row['clave'] ?></td>

<td>
<?= $row['activo'] ?
'<span class="badge bg-success">Activo</span>' :
'<span class="badge bg-danger">Inactivo</span>' ?>
</td>

<td>

<a href="?editarGrado=<?= $row['id_grado'] ?>" class="btn btn-info btn-sm">Editar</a>

<a href="?toggleGrado=<?= $row['id_grado'] ?>" class="btn btn-warning btn-sm">Cambiar Estado</a>

</td>

</tr>

<?php } ?>

</table>

</div>
</div>

<a href="../dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>

</div>

</body>
</html>
