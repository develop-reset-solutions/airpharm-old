<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$obj_id=$_GET['obj_id'];
$anyo=date('Y');
$query="SELECT * FROM objetivos WHERE obj_id=".$obj_id;
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
  	if( vacio(formulario.obj_nombre.value) == false ){
    	error+="Debe introducir el nombre del objetivo.\n";
		estado=false;
  	}
	if(estado==false){
		alert (error);
	}
	return estado;
} 
function EliminarUsuario(oau_usr_id, oau_oa_id){
	if (confirm('Seguro que desea desasociar este usuario')){
		pagina="modify_usuario.php?oau_usr_id="+oau_usr_id+"&oau_oa_id="+oau_oa_id;
		window.location=pagina;
	}
} 

function AnadirUsuario(oau_oa_id){
	oau_usr_id=document.getElementById('oa_usr_id').value;
	pagina="insert_usuario.php?oau_usr_id="+oau_usr_id+"&oau_oa_id="+oau_oa_id;
	window.location=pagina;
} 


//-->
</script>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="modify.php" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" width="100%" class="tabla_introduccion">
      <tr>
        <td class="titulo negrita">EDITAR INDICADORES</td>
      </tr>
        <tr>
          <td><span class="titulos_campos">Descripción:</span> <?php echo utf8_encode($row['obj_descripcion']);?></td>
        </tr>
         <tr>
         <td><span class="titulos_campos">Año:</span> <?php echo $anyo;?></td>
        </tr>
      <tr>
      <td>Indicadores</td>
      </tr>
      <tr>
      <td>
		<table width="100%">
        <tr>
        <td align="center">Código</td>
        <td>Nombre</td>
        <td>Polaridad</td>
        <td>Meta</td>
        <td>Un.</td>
        <td colspan="2">Horquilla</td>
        <td>Un.</td>
        <td>Responsable</td>
        </tr>
		<?php 
		$query_oa="SELECT * FROM vobjetivos_ano WHERE obj_id=".$obj_id." AND oa_ano=".$anyo." ORDER BY ind_nombre ASC";
		$result_oa=mysql_query($query_oa) or die("No se puede ejecutar la sentencia: ".$query_oa);
		while ($row_oa=mysql_fetch_array($result_oa)){?>
		<tr>
           	<td><input name=""
            	
                	
			               
        </table>
        </td>
        </tr>
        <tr>      
        <td colspan="2" align="center"><input type="button" value="Volver" class="boton-crear" onClick="document.location.href = 'show_usuarios.php?oa_id=<?php echo $oa_id;?>'"></td>
      </tr>
  </form>      <tr>
    </table>
</center>
  </div>
</div>
<footer> </footer>
</body></html>