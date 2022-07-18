<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$dep_id=$_GET['dep_id'];
$query="SELECT * FROM departamentos WHERE dep_id=".$dep_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
$query_usr="SELECT * FROM usuarios ORDER BY usr_apellidos ASC";
$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
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
  	if( vacio(formulario.dep_nombre.value) == false ){
    	error+="Debe introducir el nombre del DEPARTAMENTO.\n";
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
        <td colspan="2" class="titulo negrita">EDITAR DEPARTAMENTO</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><input name="dep_nombre" type="text" class="campo-largo"  required="required" value="<?php echo utf8_encode($row['dep_nombre']);?>">
        <input name="dep_id" type="hidden" value="<?php echo $row['dep_id'];?>" />
        </td>
      </tr>
      <tr>
        <td class="titulos_campos"> Director/a: </td>
        <td><select name="dep_director_id" class="campo-largo">
        <option value=""></option>
        <?php while($row_usr=mysql_fetch_array($result_usr)){?>
        <option value="<?php echo $row_usr['usr_id'];?>" <?php if($row_usr['usr_id']==$row['dep_director_id']){?>selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
        <?php }?>
        </select>
        </td>
      <tr>
        <td colspan="2" align="center"><input type="submit" value="Guardar" class="boton-crear">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>