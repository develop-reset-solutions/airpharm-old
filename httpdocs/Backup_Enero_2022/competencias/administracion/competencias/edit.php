<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
$com_id=$_GET['com_id'];
$query="SELECT com_nombre, com_descripcion FROM com_competencias WHERE com_id=".$com_id;
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
  	if( vacio(formulario.com_nombre.value) == false ){
    	error+="Debe introducir el nombre del centro.\n";
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
        <td colspan="2" class="titulo negrita">EDITAR COMPETENCIAS</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><input name="com_nombre" type="text" class="campo-largo" value="<?php echo utf8_encode($row['com_nombre']);?>" />
        <input name="com_id" type="hidden" value="<?php echo $com_id;?>"></td>
        <tr><center>
            <td class="titulos_descripcion"> Descripción: </td>
            </center>
         	<td><textarea rows="4" cols="100" name="com_descripcion" type="text" value="<?php echo utf8_encode($row['com_descripcion']);?>" /><?php echo utf8_encode($row['com_descripcion']);?></textarea>
        	<input name="com_id" type="hidden" value="<?php echo $com_id;?>"></td>
      	</tr>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" value="Guardar" class="boton-crear">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'">&nbsp;<input type="button" value="Volver a Ver" class="boton-crear" onClick="document.location.href = 'show.php?com_id=<?php echo $com_id;?>'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>