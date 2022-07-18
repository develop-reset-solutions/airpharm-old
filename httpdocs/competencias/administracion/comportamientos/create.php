<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
$act_id=$_REQUEST['act_id'];
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
  	if( vacio(formulario.comp_nombre.value) == false ){
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
<center>   <form action="insert.php" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">ALTA COMPORTAMIENTOS</td>
      </tr>
      <tr>
      	<center>
            <td class="titulos_descripcion"> Comportamiento: </td>
        </center>
        <td><textarea rows="4" cols="100" name="comp_nombre" type="text"/></textarea></td>
        <input name="act_id" type="text" value="<?php echo $act_id ?>" hidden>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" value="Crear" class="boton-crear">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php?act_id=<?php echo $act_id;?>'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>