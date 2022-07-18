<?php session_start();
include("../../login/sesion_start.php");
include("../../login/sesion_start_rrhh.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();
$dic_id=$_GET['dic_id'];
//$dic_id=$_GET['dic_id'];
$query="SELECT * FROM com_diccionarios WHERE dic_id=".$dic_id;
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
<center>   <form action="modify.php?dic_id=<?php echo $dic_id;?>" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">EDITAR DICCIONARIOS</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Diccionario: </td>
        <td><input name="dic_nombre" type="text" class="campo-largo" value="<?php echo utf8_encode($row['dic_nombre']);?>"></td>
      </tr>
      
      <tr>
        <td class="titulos_campos"> Agrupado: </td>
        <td>
        <!-- Pongo el select en disabled por que si ya hay datos y se modifica el agrupado puede dar errores-->
        <select name="dic_agrupado" disabled>
        	<option value="si" <?php if ($row['dic_agrupado']=="si"){echo "selected";}?>>Si</option>
           	<option value="no" <?php if ($row['dic_agrupado']=="no"){echo "selected";}?>>No</option>
        </select></td>
       
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" value="Guardar" class="boton-crear">&nbsp;
        <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php?dic_id=<?php echo $dic_id;?>'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>