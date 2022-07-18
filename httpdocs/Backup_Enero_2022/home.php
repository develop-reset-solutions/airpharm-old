<?php 
session_start();
include("login/sesion_start.php");
include("librerias/librerias.php");
include("cabecera.php");

$conn=db_connect();

$query="SELECT usr_flogin FROM usuarios WHERE usr_id=".$_SESSION['usr_id'];
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
if($row["usr_flogin"] == 1){
	header('Location: http://airpharmdpo.com/administracion/usuarios/edit-pass.php');
}
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div style="width:100%;">
        <center><table align="center">
        <tr>
        <td class="celda-home"><input type="button" class="boton-principal" value="Consultar/Editar DPO" onClick="document.location.href = 'dpo'"></td>
         <td class="celda-home"><input type="button" class="boton-principal" value="Objetivos" onClick="document.location.href = 'objetivos'"></td>
        <td class="celda-home"><input type="button" class="boton-principal" value="Indicadores <?php echo $_SESSION['ano'];?>" onClick="document.location.href = 'medicion_objetivos'"></td>
         </tr>
        <tr>
         <?php if($_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_categoria']==utf8_decode('Dirección') and $_SESSION['ano']>=2016){?><td class="celda-home"><input type="button" class="boton-principal" value="Crear/Duplicar DPO" onClick="document.location.href = 'dpo_creacion'"></td><?php }?>
 <?php if($_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH' or $_SESSION['usr_categoria']==utf8_decode('Dirección')){?> 
      <td class="celda-home"><input type="button" class="boton-principal texto_verde" value="Informes" onClick="document.location.href = '/informes'"></td><?php }?>
</tr>
        </table></center>
  </div>
  <div class="tabla_apartados">
  </div>
</div>
<footer> 
</footer>
</body></html>