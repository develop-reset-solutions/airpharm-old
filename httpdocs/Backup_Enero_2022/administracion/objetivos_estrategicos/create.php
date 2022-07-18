<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
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
  	if( vacio(formulario.oe_nombre.value) == false ){
    	error+="Debe introducir el nombre del objetivo estratégico.\n";
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
        <td colspan="2" class="titulo negrita">ALTA OBJETIVO ESTRATÉGICO</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Código: </td>
        <td><input name="oe_codigo" type="text" class="campo-corto"></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><input name="oe_nombre" type="text" class="campo-largo"></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Área: </td>
        <td><input name="oe_area" type="text" class="campo-largo"></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" value="Crear" class="boton-crear"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>