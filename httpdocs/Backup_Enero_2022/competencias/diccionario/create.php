<?php session_start();
include("../../login/sesion_start.php");
include("../../login/sesion_start_rrhh.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();
//$dic_id=$_REQUEST['dic_id'];
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
  

function Validar( formulario ) {
	var error;
	var estado;
	estado=true;
	error='';
  	if( vacio(formulario.dic_nombre.value) == false ){
    	error+="Debe introducir el nombre del diccionario.\n";
		estado=false;
  	}
	if(estado==false){
		alert (error);
	}
	return estado;
} 


//-->
</script>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="insert.php" method="post" onSubmit="return Validar(this);" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">ALTA DICCIONARIOS</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Diccionario: </td>
        <td><input name="dic_nombre" type="text" class="campo-largo"></td>
      </tr>
      
      <tr>
        <td class="titulos_campos"> Agrupado: </td>
        <td>
        <select name="dic_agrupado">
        	<option value="si">Si</option>
           	<option value="no">No</option>
        </select></td>
        <!--<input name="dic_id" type="text" value="<?php echo $dic_id ?>" hidden>-->
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" value="Crear" class="boton-crear">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>