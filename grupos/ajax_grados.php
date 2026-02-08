<?php
include("../config/conexion.php");

$id = $_GET['id_carrera'];

$sql = "
SELECT g.*
FROM carrera_grado cg
JOIN cat_grado g ON g.id_grado = cg.id_grado
WHERE cg.id_carrera = $id
AND g.activo = 1
";

$r = $conn->query($sql);

echo '<option value="">Seleccione</option>';

while($row = $r->fetch_assoc()){
    echo "<option value='{$row['id_grado']}' data-clave='{$row['clave']}'>
            {$row['clave']}
          </option>";
}
