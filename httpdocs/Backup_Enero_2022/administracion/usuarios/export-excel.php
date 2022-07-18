<?php session_start();
require_once("../../librerias/librerias.php");
require_once("../../login/sesion_start.php");
$conn=db_connect();
require_once ("../../librerias/excel-export.php");
$query=$_POST['query'];
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
ob_end_clean();
$xls = new ExcelExport();
$xls->addRow(Array('Apellidos', 'Nombre', 'Email', 'DNI', 'Teléfono', 'Departamento', 'Centro', 'Categoría', 'Perfil'));
while ($row=mysql_fetch_array($result)){
	$xls->addRow(Array($row['usr_apellidos'], $row['usr_nombre'], $row['usr_email'], $row['usr_dni'], $row['usr_telefono'], $row['dep_nombre'], $row['cen_nombre'], $row['gru_nombre'], $row['usr_perfil']));
}
$xls->download("usuarios.xls");
break;
?>