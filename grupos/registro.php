<?php
include("../config/conexion.php");

/* CARRERAS ACTIVAS */
$carreras = $conn->query("SELECT * FROM cat_carrera WHERE activo=1");

/* GUARDAR GRUPO */
if(isset($_POST['guardar'])){

    $carrera = $_POST['carrera'];
    $grado   = $_POST['grado'];
    $turno   = $_POST['turno'];

    $grupo = $carrera."-".$grado."-".$turno;

    $conn->query("
        INSERT INTO grupo(carrera,grado,turno,nombre_grupo)
        VALUES('$carrera','$grado','$turno','$grupo')
    ");
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

<h3>Registro de Grupos</h3>

<form method="POST" class="card p-4 shadow">

<label>Carrera</label>
<select name="carrera" id="carrera" class="form-control">
<option value="">Seleccione</option>

<?php while($c = $carreras->fetch_assoc()){ ?>

<option 
value="<?= $c['clave'] ?>"
data-id="<?= $c['id_carrera'] ?>">
<?= $c['clave'] ?>
</option>

<?php } ?>

</select>

<br>

<label>Turno</label>
<select name="turno" id="turno" class="form-control">
<option value="">Seleccione</option>
</select>

<br>

<label>Grado</label>
<select name="grado" id="grado" class="form-control">
<option value="">Seleccione</option>
</select>

<br>

<label>Grupo Generado</label>
<input type="text" id="grupo" class="form-control" readonly>

<br>

<button name="guardar" class="btn btn-primary">Registrar</button>

<div class="container mt-5">
    
<a href="../dashboard.php" class="btn btn-secondary mb-3">
    ← Regresar al Dashboard
</a>

<form method="POST" class="card p-4 shadow">

</form>

</div>

<script>

let carrera = document.getElementById("carrera");
let turno   = document.getElementById("turno");
let grado   = document.getElementById("grado");
let grupo   = document.getElementById("grupo");

/* CUANDO CAMBIA CARRERA */
carrera.addEventListener("change", function(){

    if(this.selectedIndex <= 0){
        turno.innerHTML = '<option value="">Seleccione</option>';
        grado.innerHTML = '<option value="">Seleccione</option>';
        grupo.value = "";
        return;
    }

    let id = this.options[this.selectedIndex].dataset.id;

    /* TURNOS */
    fetch("ajax_turnos.php?id_carrera="+id)
    .then(res => res.text())
    .then(data => {
        turno.innerHTML = data;
        generarGrupo();
    });

    /* GRADOS */
    fetch("ajax_grados.php?id_carrera="+id)
    .then(res => res.text())
    .then(data => {
        grado.innerHTML = data;
        generarGrupo();
    });

});

/* GENERAR GRUPO AUTOMÁTICO */
function generarGrupo(){

    if(carrera.value && turno.value && grado.value){

        grupo.value =
            carrera.value + "-" + grado.value + "-" + turno.value;

    }else{
        grupo.value = "";
    }
}

/* EVENTOS */
turno.addEventListener("change", generarGrupo);
grado.addEventListener("change", generarGrupo);

</script>
