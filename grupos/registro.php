<?php
include("../config/conexion.php");

$mensaje = "";
$error = "";

/* =============================
   CARRERAS ACTIVAS
============================= */
$carreras = $conn->query("SELECT * FROM cat_carrera WHERE activo=1 ORDER BY clave");


/* =============================
   GUARDAR GRUPO
============================= */
if(isset($_POST['guardar'])){

    $id_carrera = intval($_POST['carrera']);
    $id_grado   = intval($_POST['grado']);
    $id_turno   = intval($_POST['turno']);

    $CUPO_MAX = 40; // 🔥 Puedes cambiarlo si quieres

    /* Obtener claves */
    $carrera = $conn->query("SELECT clave FROM cat_carrera WHERE id_carrera=$id_carrera")->fetch_assoc();
    $grado   = $conn->query("SELECT clave FROM cat_grado WHERE id_grado=$id_grado")->fetch_assoc();
    $turno   = $conn->query("SELECT clave FROM cat_turno WHERE id_turno=$id_turno")->fetch_assoc();

    if(!$carrera || !$grado || !$turno){
        $error = "Datos inválidos";
    }
    else{

        $baseGrupo = $carrera['clave']."-".$grado['clave']."-".$turno['clave'];

        /* =============================
           BUSCAR SUBGRUPO DISPONIBLE
        ============================== */

        $subgrupo = 1;
        $grupoFinal = "";

        while(true){

            $nombreGrupo = $baseGrupo."-".$subgrupo;

            /* Verificar si ya existe */
            $verificar = $conn->prepare("
                SELECT id_grupo FROM grupo
                WHERE nombre_grupo = ?
            ");
            $verificar->bind_param("s",$nombreGrupo);
            $verificar->execute();
            $res = $verificar->get_result();

            if($res->num_rows == 0){
                $grupoFinal = $nombreGrupo;
                break;
            }

            /* Revisar cupo */
            $grupoExistente = $res->fetch_assoc();
            $idGrupo = $grupoExistente['id_grupo'];

            $cupo = $conn->query("
                SELECT COUNT(*) total
                FROM alumno
                WHERE id_grupo = $idGrupo
            ")->fetch_assoc()['total'];

            if($cupo < $CUPO_MAX){
                $grupoFinal = $nombreGrupo;
                break;
            }

            $subgrupo++;
        }

        /* =============================
           VALIDAR DUPLICADO EXACTO
        ============================== */

        $dup = $conn->prepare("
            SELECT id_grupo FROM grupo
            WHERE id_carrera=? AND id_grado=? AND id_turno=? AND nombre_grupo=?
        ");
        $dup->bind_param("iiis",$id_carrera,$id_grado,$id_turno,$grupoFinal);
        $dup->execute();

        if($dup->get_result()->num_rows > 0){
            $error = "El grupo ya existe.";
        }
        else{

            /* INSERTAR GRUPO */
            $stmt = $conn->prepare("
                INSERT INTO grupo(id_carrera,id_grado,id_turno,nombre_grupo)
                VALUES(?,?,?,?)
            ");

            $stmt->bind_param("iiis",$id_carrera,$id_grado,$id_turno,$grupoFinal);

            if($stmt->execute()){
                $mensaje = "Grupo creado: ".$grupoFinal;
            }else{
                $error = "Error al crear grupo";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro de Grupos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f4f6f9;">

<div class="container mt-5">

<h3>Registro de Grupos</h3>

<?php if($mensaje){ ?>
<div class="alert alert-success"><?= $mensaje ?></div>
<?php } ?>

<?php if($error){ ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php } ?>


<form method="POST" class="card p-4 shadow">

<label>Carrera</label>
<select name="carrera" id="carrera" class="form-control" required>
<option value="">Seleccione</option>

<?php while($c = $carreras->fetch_assoc()){ ?>

<option 
value="<?= $c['id_carrera'] ?>"
data-clave="<?= $c['clave'] ?>">
<?= $c['clave'] ?>
</option>

<?php } ?>

</select>

<br>

<label>Turno</label>
<select name="turno" id="turno" class="form-control" required>
<option value="">Seleccione</option>
</select>

<br>

<label>Grado</label>
<select name="grado" id="grado" class="form-control" required>
<option value="">Seleccione</option>
</select>

<br>

<label>Grupo Generado</label>
<input type="text" id="grupo" class="form-control" readonly>

<br>

<button name="guardar" class="btn btn-primary">Registrar</button>

</form>

<br>

<a href="../dashboard.php" class="btn btn-secondary">
← Regresar al Dashboard
</a>

</div>


<script>

let carrera = document.getElementById("carrera");
let turno   = document.getElementById("turno");
let grado   = document.getElementById("grado");
let grupo   = document.getElementById("grupo");


/* CAMBIO CARRERA */
carrera.addEventListener("change", function(){

    grupo.value = "";

    if(this.selectedIndex <= 0){
        turno.innerHTML = '<option value="">Seleccione</option>';
        grado.innerHTML = '<option value="">Seleccione</option>';
        return;
    }

    let id = this.value;
    let clave = this.options[this.selectedIndex].dataset.clave;

    /* TURNOS */
    fetch("ajax_turnos.php?id_carrera="+id)
    .then(res => res.text())
    .then(data => turno.innerHTML = data);

    /* GRADOS */
    fetch("ajax_grados.php?id_carrera="+id)
    .then(res => res.text())
    .then(data => grado.innerHTML = data);
});


function generarGrupo(){

    let c = carrera.options[carrera.selectedIndex];
    if(!c) return;

    let claveCarrera = c.dataset.clave;

    if(claveCarrera && turno.value && grado.value){

        let textoTurno = turno.options[turno.selectedIndex].text;
        let textoGrado = grado.options[grado.selectedIndex].text;

        grupo.value = claveCarrera+"-"+textoGrado+"-"+textoTurno+"-?";
    }
}

turno.addEventListener("change", generarGrupo);
grado.addEventListener("change", generarGrupo);

</script>

</body>
</html>
