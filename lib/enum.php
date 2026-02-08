<?php
function obtenerEnum($conn,$tabla,$columna){

$sql = "SELECT COLUMN_TYPE 
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = '$tabla'
AND COLUMN_NAME = '$columna'
AND TABLE_SCHEMA = 'Universidad'";

$res = $conn->query($sql);
$row = $res->fetch_assoc();

preg_match("/^enum\(\'(.*)\'\)$/",$row['COLUMN_TYPE'],$matches);

return explode("','",$matches[1]);
}
?>
