<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$gru_id=$_GET['gru_id'];
$query="SELECT gru_nombre FROM grupos WHERE gru_id=".$gru_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
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

function Valida( formulario ) {
	var error;
	var estado;
	estado=true;
	error='';
  	if( vacio(formulario.gru_nombre.value) == false ){
    	error+="Debe introducir el nombre del grupo.\n";
		estado=false;
  	}
	if(estado==false){
		alert (error);
	}
	return estado;
} 


//-->
</script>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="modify.php" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">EDITAR GRUPO</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><input name="gru_nombre" type="text" class="campo-largo" value="<?php echo utf8_encode($row['gru_nombre']);?>" />
        <input name="gru_id" type="hidden" value="<?php echo $gru_id;?>"></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" value="Guardar" class="boton-crear">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>