<?php
include("../config/conexion.php");

$query = $conn->query("SELECT * FROM cat_turno WHERE activo = 1");

echo '<option value="">Seleccione</option>';

while($row = $query->fetch_assoc()){
    echo '<option value="'.$row['clave'].'">'.$row['clave'].'</option>';
}
?>
