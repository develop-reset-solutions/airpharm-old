<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$usr_id=$_SESSION['usr_id'];
$query="SELECT * FROM vusuarios WHERE usr_id=".$usr_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
$query_dep="SELECT * FROM departamentos ORDER BY dep_nombre ASC";
$result_dep=mysql_query($query_dep) or die ("No se puede ejecutar la sentencia: ".$query_dep);
$query_cen="SELECT * FROM centros ORDER BY cen_nombre ASC";
$result_cen=mysql_query($query_cen) or die ("No se puede ejecutar la sentencia: ".$query_cen);
$query_sup="SELECT * FROM usuarios ORDER BY usr_apellidos ASC";
$result_sup=mysql_query($query_sup) or die ("No se puede ejecutar la sentencia: ".$query_sup);
?>
<script language="javascript">
<!--
function vacio(q) {  
	for ( i = 0; i < q.length; i++ ) {  
		if ( q.charAt(i) != " " ) {  
			return true  
		}  
	}  
	return false  
}  

//comprueba direccion email
function email(txt){  
	//expresion regular  
	var b=/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/; 
	return b.test(txt);
}  


//-->
</script>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="modify-pass.php" method="post" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="4" class="titulo negrita">EDITAR CONTRASEÑA</td>
      <tr>
      <td class="titulos_campos">Contraseña:</td>
      <td><input type="password" name="usr_password" id="usr_password" required="required" class="campo-largo" value="*****"/>        <input name="usr_id" type="hidden" value="<?php echo $row['usr_id'];?>" />
</td>
      <td class="titulos_campos">Repetir contraseña:</td>
      <td><input type="password" name="usr_password1" id="usr_password1" required="required" class="campo-largo" value="*****"/></td>
       <tr>
        <td colspan="4" align="center"><input type="submit" value="Guardar" class="boton-crear">&nbsp;<input type="button" value="Volver" class="boton-crear" onClick="document.location.href = '../../show.php'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>