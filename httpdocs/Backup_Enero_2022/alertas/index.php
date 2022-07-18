<?php 
session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$ano=$_SESSION['ano'];
$query="SELECT * FROM alertas WHERE ale_ano=".$ano;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$num=mysql_num_rows($result);
if(!$num){
	$query="INSERT INTO alertas (ale_ano) VALUES ('".$ano."')";
	$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
}
$query="SELECT * FROM alertas WHERE ale_ano=".$ano;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
?>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div class="cabecera_apartados">
  <div class="filtros">
    <table align="center" width="100%">
      <tr>
        <td>Gestión de alertas <?php echo $ano;?></td>
      </tr>
    </table>
  </div>
</div>
<div class="tabla_apartados">
  <form action="modify_alertas.php" method="post">
    <table>
      <tr>
        <td colspan="5" class="titulo_grupo"><a name="Mediciones"></a>Mediciones</td>
      </tr>
      <tr class="titulo_dpo">
        <td></td>
        <td>Recordatorio</td>
        <td>Fecha Limite</td>
        <td>Tiempo</td>
        <td>Texto</td>
      </tr>
      <tr>
        <td valign="top" class="celdas_subtotal arriba">T1</td>
        <td valign="top" class="celdas_subtotal arriba"><input name="ale_med1_recordatorio" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_med1_recordatorio']);?>"></td>
        <td valign="top" class="celdas_subtotal arriba"><input name="ale_med1_fechalimite" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_med1_fechalimite']);?>"></td>
        <td valign="top" class="celdas_subtotal arriba"><input name="ale_med1_temp" type="text" class="campo-ncomentario numerica" value="<?php echo utf8_encode($row['ale_med1_temp']);?>"></td>
        <td class="celdas_subtotal arriba"><textarea name="ale_med1_texto" class="texto_largo"><?php echo utf8_encode($row['ale_med1_texto']);?></textarea></td>
      </tr>
      <tr>
        <td class="celdas_subtotal arriba">T2</td>
        <td class="celdas_subtotal arriba"><input name="ale_med2_recordatorio" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_med2_recordatorio']);?>"></td>
        <td class="celdas_subtotal arriba"><input name="ale_med2_fechalimite" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_med2_fechalimite']);?>"></td>
        <td class="celdas_subtotal arriba"><input name="ale_med2_temp" type="text" class="campo-ncomentario numerica" value="<?php echo utf8_encode($row['ale_med2_temp']);?>"></td>
        <td class="celdas_subtotal arriba"><textarea name="ale_med2_texto" class="texto_largo"><?php echo utf8_encode($row['ale_med2_texto']);?></textarea></td>
      </tr>
      <tr>
        <td class="celdas_subtotal arriba">T3</td>
        <td class="celdas_subtotal arriba"><input name="ale_med3_recordatorio" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_med3_recordatorio']);?>"></td>
        <td class="celdas_subtotal arriba"><input name="ale_med3_fechalimite" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_med3_fechalimite']);?>"></td>
        <td class="celdas_subtotal arriba"><input name="ale_med3_temp" type="text" class="campo-ncomentario numerica" value="<?php echo utf8_encode($row['ale_med3_temp']);?>"></td>
        <td class="celdas_subtotal arriba"><textarea name="ale_med3_texto" class="texto_largo"><?php echo utf8_encode($row['ale_med3_texto']);?></textarea></td>
      </tr>
      <tr>
        <td class="celdas_subtotal arriba">T4</td>
        <td class="celdas_subtotal arriba"><input name="ale_med4_recordatorio" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_med4_recordatorio']);?>"></td>
        <td class="celdas_subtotal arriba"><input name="ale_med4_fechalimite" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_med4_fechalimite']);?>"></td>
        <td class="celdas_subtotal arriba"><input name="ale_med4_temp" type="text" class="campo-ncomentario numerica" value="<?php echo utf8_encode($row['ale_med4_temp']);?>"></td>
        <td class="celdas_subtotal arriba"><textarea name="ale_med4_texto" class="texto_largo"><?php echo utf8_encode($row['ale_med4_texto']);?></textarea></td>
      </tr>
      <tr>
        <td class="celdas_subtotal arriba">Anual</td>
        <td class="celdas_subtotal arriba"><input name="ale_medf_recordatorio" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_medf_recordatorio']);?>"></td>
        <td class="celdas_subtotal arriba"><input name="ale_medf_fechalimite" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_medf_fechalimite']);?>"></td>
        <td class="celdas_subtotal arriba"><input name="ale_medf_temp" type="text" class="campo-ncomentario numerica" value="<?php echo utf8_encode($row['ale_medf_temp']);?>"></td>
        <td class="celdas_subtotal arriba"><textarea name="ale_medf_texto" class="texto_largo"><?php echo utf8_encode($row['ale_medf_texto']);?></textarea></td>
      </tr>
      <tr>
        <td colspan="5" class="titulo_grupo"><a name="Mediciones"></a>Definiciones DPO</td>
      </tr>
      <tr class="titulo_dpo">
        <td></td>
        <td>Recordatorio</td>
        <td>Fecha Limite</td>
        <td>Tiempo</td>
        <td>Texto</td>
      </tr>
      <tr>
        <td class="celdas_subtotal arriba">Definición previa</td>
        <td class="celdas_subtotal arriba"><input name="ale_defp_recordatorio" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_defp_recordatorio']);?>"></td>
        <td class="celdas_subtotal arriba"><input name="ale_defp_fechalimite" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_defp_fechalimite']);?>"></td>
        <td class="celdas_subtotal arriba"><input name="ale_defp_temp" type="text" class="campo-ncomentario numerica" value="<?php echo utf8_encode($row['ale_defp_temp']);?>"></td>
        <td class="celdas_subtotal arriba"><textarea name="ale_defp_texto" class="texto_largo"><?php echo utf8_encode($row['ale_defp_texto']);?></textarea></td>
      </tr>
      <tr>
        <td class="celdas_subtotal arriba">Definición definitiva</td>
        <td class="celdas_subtotal arriba"><input name="ale_deff_recordatorio" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_deff_recordatorio']);?>"></td>
        <td class="celdas_subtotal arriba"><input name="ale_deff_fechalimite" type="text" class="campo-fcomentario numerica" value="<?php echo cambiaf_a_normal($row['ale_deff_fechalimite']);?>"></td>
        <td class="celdas_subtotal arriba"><input name="ale_deff_temp" type="text" class="campo-ncomentario numerica" value="<?php echo utf8_encode($row['ale_deff_temp']);?>"></td>
        <td class="celdas_subtotal arriba"><textarea name="ale_deff_texto" class="texto_largo"><?php echo utf8_encode($row['ale_deff_texto']);?></textarea></td>
      </tr>
      <tr>
      <td colspan="5" class="celdas_subtotal" align="center"><input type="submit" name="Guardar" id="Guardar" value="Guardar"></td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>
