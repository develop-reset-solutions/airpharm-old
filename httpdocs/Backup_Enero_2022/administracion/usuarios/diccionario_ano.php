<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");

$conn=db_connect();
$dic_ano=$_REQUEST['ano'];
if ($dic_ano!=0){
	$query_dic_new="SELECT * FROM com_diccionarios WHERE dic_cerrado='si' AND dic_ano=".$dic_ano;
	$result_dic_new=mysql_query($query_dic_new) or die ("No se puede ejecutar la sentencia: ".$query_dic_new);
	?>
	<select name="dic_nombre_nuevo" class="campo-largo">
		<option value="0" >Elige el diccionario...</option>
		<?php while($row_dic_new=mysql_fetch_array($result_dic_new)){?>
		<option value="<?php echo $row_dic_new['dic_id'];?>" ><?php echo utf8_encode($row_dic_new['dic_nombre']);?>							
		</option>
		<?php }?>
	</select>
	<?php

} else {
	?>
    <select name="dic_nombre_nuevo" class="campo-largo">
        <option value="0" >Elige el diccionario...</option>
    </select>
    <?php
}
