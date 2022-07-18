<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$dpo_ano=$_SESSION['ano'];
?>
<script type="text/javascript">
$(document).ready(function(){
 	$( "#seleccionar" ).click(function() {
  		$('input[type=checkbox]').each( function() {
			this.checked = true;
		});
	});
 	$( "#desseleccionar" ).click(function() {
  		$('input[type=checkbox]').each( function() {
			this.checked = false;
		});
	});
});
</script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
        <td colspan="5">Seleccionar usuarios para resumen</td>
        </tr>
        </table>
      </form>
    </div>
  </div>
  <div class="tabla_apartados">
  <form name="generar" action="resumen-grupos-excel.php" method="post">
  	<table width="100%">
    <tr>
    <td colspan="4"><input type="button" name="seleccionar" id="seleccionar" value="Seleccionar todos">&nbsp;<input type="button" name="desseleccionar" id="desseleccionar" value="Anular selección"></td>
	<?php 
	$cont=1;
	$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND usr_id<>130 AND (usr_perfil='Usuario' OR usr_perfil='Director RRHH') ORDER BY usr_apellidos, usr_nombre ASC";
	$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
	while($row_usr=mysql_fetch_array($result_usr)){
		if($row_usr['usr_id']==$_SESSION['usr_id']){
   			if (($cont % 4)==1){?>
				<tr>
            <?php }?> <td width="25%"><input type="checkbox" name="usr_id[]" value="<?php echo $row_usr['usr_id'];?>">&nbsp;<?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></td>
  			<?php if (($cont % 4) ==0){?>
				</tr>
			<?php }$cont++;

		 }else{
				$es_superior=false;
				$superior=$row_usr['usr_superior_id'];
				if($superior==$_SESSION['usr_id']){
					$es_superior=true;
				}
				while($superior<>'130' and $es_superior==false and $superior<>''){
					$query_usr2="SELECT * FROM usuarios WHERE usr_id=".$superior;
					$result_usr2=mysql_query($query_usr2) or die ("No se puede ejecutar la sentencia: ".$query_usr2);
					$row_usr2=mysql_fetch_array($result_usr2);
					$superior=$row_usr2['usr_superior_id'];
					if($superior==$_SESSION['usr_id']){
						$es_superior=true;
					}
				}
				if($es_superior or $_SESSION['usr_perfil']=='Director General' or $_SESSION['usr_perfil']=='Director RRHH'){
					$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_usr_id=".$row_usr['usr_id']." AND dpo_ano=".$dpo_ano;
					$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
					$num_dpo=mysql_num_rows($result_dpo);
					if($num_dpo){
                 			if (($cont % 4)==1){?>
				<tr>
            <?php }?> <td width="25%"><input type="checkbox" name="usr_id[]" value="<?php echo $row_usr['usr_id'];?>">&nbsp;<?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></td>
  			<?php if (($cont % 4) ==0){?>
				</tr>
			<?php }$cont++;
              		}
				}
		}
	}	if (($cont % 4) ==0){?>
			</tr>
		<?php }
?>	       
<tr><td align="center" colspan="4"><input type="submit" value="Generar Excel"></td></tr>
        </table>
	</form>
  </div>
</div>
<footer> </footer>
</body></html>