<?php
include("../config/conexion.php");

$id = $_GET['id_carrera'];

$sql = "
SELECT t.*
FROM carrera_turno ct
JOIN cat_turno t ON t.id_turno = ct.id_turno
WHERE ct.id_carrera = $id
AND t.activo = 1
";

$r = $conn->query($sql);

echo '<option value="">Seleccione</option>';

while($row = $r->fetch_assoc()){
    echo "<option value='{$row['id_turno']}' data-clave='{$row['clave']}'>
            {$row['clave']}
          </option>";
}
