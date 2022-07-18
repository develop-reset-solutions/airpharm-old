<?php 
session_start();
include("../login/sesion_start.php");
include("../login/sesion_start_rrhh.php");
include("../librerias/librerias.php");
include("../cabecera-competencias.php");

$conn=db_connect();

$query="SELECT usr_flogin FROM usuarios WHERE usr_id=".$_SESSION['usr_id'];
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
if($row["usr_flogin"] == 1){
	header('Location: http://10.2.0.66/administracion/usuarios/edit-pass.php');
}


if ($_SESSION['usr_perfil']=='Director RRHH'){
?>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div style="width:100%;">
  	<center><table align="center">
       <tr>
          <td class="celda-home"><input type="button" class="boton-principal2" value="Administración" onClick="document.location.href = '/competencias/administracion/index.php'"></td>
          <td class="celda-home"><input type="button" class="boton-principal2" value="Diccionario" onClick="document.location.href = '/competencias/diccionario/index.php'"></td>
          <td class="celda-home"><input type="button" class="boton-principal2" value="Evaluación Competencial" onClick="document.location.href = '/competencias/evaluacion/index.php'"></td>
		 
		   

          <!--<td class="celda-home"><input type="button" class="boton-principal" value="Indicadores <?php echo $_SESSION['ano'];?>" onClick="document.location.href = 'medicion_objetivos'"></td>-->
       </tr>
         
		
		
		
        <!--
       <tr>
       <?php if($_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_categoria']==utf8_decode('Dirección') and $_SESSION['ano']>=2016){?><td class="celda-home"><input type="button" class="boton-principal" value="Crear/Duplicar DPO" onClick="document.location.href = 'dpo_creacion'"></td><?php }?>-->
       <tr>
 <?php if($_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH' or $_SESSION['usr_categoria']==utf8_decode('Dirección')){?> 
      <td class="celda-home"><input type="button" class="boton-principal2 texto_verde" value="Informes" onClick="document.location.href = 'informes'"></td><?php }?>
		   <td></td>
		    <td class="celda-home"><input type="button" class="boton-principal2"   value="Eval. Comp. Libre" onClick="document.location.href = '/competencias/evaluacion/index_libre.php'"></td>
		   
		   
</tr>
     </table></center>
  </div>
  <div class="tabla_apartados">
  </div>
</div>
<?php 
} else {
	header('Location: /competencias/evaluacion/index.php');
	}
?>
<footer> 
</footer>
</body></html>