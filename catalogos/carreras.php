<?php
include("../config/conexion.php");
include("../lib/enum.php");

$carreras = obtenerEnum($conn,"grupo","carrera");
?>

<h2>Catálogo Carreras</h2>

<table border="1">
<tr>
<th>Carrera</th>
</tr>

<?php foreach($carreras as $c){ ?>
<tr>
<td><?=$c?></td>
</tr>
<?php } ?>

</table>
