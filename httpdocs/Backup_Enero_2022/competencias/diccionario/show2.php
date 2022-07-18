<?php session_start();
include("../../login/sesion_start.php");
include("../../login/sesion_start_rrhh.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");

$conn=db_connect();
$dic_id=$_REQUEST['dic_id'];

$query="SELECT * FROM com_diccionarios WHERE dic_id=".$dic_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
?>
<script language="javascript">
function subir(val){
	var orden_nuevo = val-1;
	var id="ord_"+val;
	var id_nuevo="ord_"+orden_nuevo;
	var id2="orden_"+val;
	var id2_nuevo="orden_"+orden_nuevo;
	var id3="o_"+val;
	var id3_nuevo="o_"+orden_nuevo;
	var competencia=document.getElementById(id).innerHTML;
	var competencia_ant=document.getElementById(id_nuevo).innerHTML;
	var valor=document.getElementById(id2).innerHTML;
	var valor_ant=document.getElementById(id2_nuevo).innerHTML;
	var v=document.getElementById(id3).value;
	var v_ant=document.getElementById(id3_nuevo).value;
	document.getElementById("ord_"+val).innerHTML=competencia_ant;
	document.getElementById("ord_"+orden_nuevo).innerHTML=competencia;
	document.getElementById("orden_"+val).innerHTML=valor_ant;
	document.getElementById("orden_"+orden_nuevo).innerHTML=valor;
	document.getElementById("o_"+val).value=v_ant;
	document.getElementById("o_"+orden_nuevo).value=v;
	}
function bajar(val){
	var orden_nuevo = val+1;
	var id="ord_"+val;
	var id_nuevo="ord_"+orden_nuevo;
	var id2="orden_"+val;
	var id2_nuevo="orden_"+orden_nuevo;
	var id3="o_"+val;
	var id3_nuevo="o_"+orden_nuevo;
	var competencia=document.getElementById(id).innerHTML;
	var competencia_sig=document.getElementById(id_nuevo).innerHTML;
	var valor=document.getElementById(id2).innerHTML;
	var valor_sig=document.getElementById(id2_nuevo).innerHTML;
	var v=document.getElementById(id3).value;
	var v_ant=document.getElementById(id3_nuevo).value;
	document.getElementById("ord_"+val).innerHTML=competencia_sig;
	document.getElementById("ord_"+orden_nuevo).innerHTML=competencia;
	document.getElementById("orden_"+val).innerHTML=valor_sig;
	document.getElementById("orden_"+orden_nuevo).innerHTML=valor;
	document.getElementById("o_"+val).value=v_ant;
	document.getElementById("o_"+orden_nuevo).value=v;
	}
function guardar_orden(){
	var num_max=document.getElementById("num_max").value;
	var dic_id=document.getElementById("dic_id").value;
	if (num_max > 0){var com_1=document.getElementById("o_1").value;} else {var com_1=""}
	if (num_max > 1){var com_2=document.getElementById("o_2").value;} else {var com_2=""}
	if (num_max > 2){var com_3=document.getElementById("o_3").value;} else {var com_3=""}
	if (num_max > 3){var com_4=document.getElementById("o_4").value;} else {var com_4=""}
	if (num_max > 4){var com_5=document.getElementById("o_5").value;} else {var com_5=""}
	if (num_max > 5){var com_6=document.getElementById("o_6").value;} else {var com_6=""}
	if (num_max > 6){var com_7=document.getElementById("o_7").value;} else {var com_7=""}
	if (num_max > 7){var com_8=document.getElementById("o_8").value;} else {var com_8=""}
	if (num_max > 8){var com_9=document.getElementById("o_9").value;} else {var com_9=""}
	if (num_max > 9){var com_10=document.getElementById("o_10").value;} else {var com_10=""}
	if (num_max > 10){var com_11=document.getElementById("o_11").value;} else {var com_11=""}
	if (num_max > 11){var com_12=document.getElementById("o_12").value;} else {var com_12=""}
	if (num_max > 12){var com_13=document.getElementById("o_13").value;} else {var com_13=""}
	if (num_max > 13){var com_14=document.getElementById("o_14").value;} else {var com_14=""}
	if (num_max > 14){var com_15=document.getElementById("o_15").value;} else {var com_15=""}
	if (num_max > 15){var com_16=document.getElementById("o_16").value;} else {var com_16=""}
	if (num_max > 16){var com_17=document.getElementById("o_17").value;} else {var com_17=""}
	if (num_max > 17){var com_18=document.getElementById("o_18").value;} else {var com_18=""}
	if (num_max > 18){var com_19=document.getElementById("o_19").value;} else {var com_19=""}
	if (num_max > 19){var com_20=document.getElementById("o_20").value;} else {var com_20=""}
	if (num_max > 20){var com_21=document.getElementById("o_21").value;} else {var com_21=""}
	if (num_max > 21){var com_22=document.getElementById("o_22").value;} else {var com_22=""}
	if (num_max > 22){var com_23=document.getElementById("o_23").value;} else {var com_23=""}
	if (num_max > 23){var com_24=document.getElementById("o_24").value;} else {var com_24=""}
	if (num_max > 24){var com_25=document.getElementById("o_25").value;} else {var com_25=""}
	window.location="guardar_orden.php?dic_id="+dic_id+"&num_max="+num_max+"&com_1="+com_1+"&com_2="+com_2+"&com_3="+com_3+"&com_4="+com_4+"&com_5="+com_5+"&com_6="+com_6+"&com_7="+com_7+"&com_8="+com_8+"&com_9="+com_9+"&com_10="+com_10+"&com_11="+com_11+"&com_12="+com_12+"&com_13="+com_13+"&com_14="+com_14+"&com_15="+com_15+"&com_16="+com_16+"&com_17="+com_17+"&com_18="+com_18+"&com_19="+com_19+"&com_20="+com_20+"&com_21="+com_21+"&com_22="+com_22+"&com_23="+com_23+"&com_24="+com_24+"&com_25="+com_25;
	}
</script>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
            <td colspan="2">Diccionario <?php echo $row['dic_nombre'] ?></td>
        </tr>   
		 <?php if ($row['dic_cerrado']=="no"){?> 
            <tr>
                <td>
                    <a href="competencias/create.php?dic_id=<?php echo $dic_id?>" class="texto_10">Añadir Competencia</a>
                </td>
                <td style="background-color:transparent; width:1000px;">
                </td>
            </tr>	
         <?php }?>
             
          
        </table>
      </form>
    </div>
  </div>
   
  
  <div class="tabla_apartados">
  	
    <table width="100%">
      <thead>
	    	<td width="10%">Orden</td>
      		<td width="75%">Competencia</td>
            <td width="15%">Acción</td>
      </thead>
      <?php 
      		//$query_com="SELECT * FROM vcom_diccionario WHERE cd_dic_id=".$dic_id." order by cd_orden";
			$query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." order by cd_orden";
            $result_com_dic=mysql_query($query_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_com_dic);
			$num_row_com_dic = mysql_num_rows($result_com_dic);
			?>
            <input type="hidden" name="dic_id" id="dic_id" value="<?php echo $dic_id ?>">
			 <input type="hidden" name="num_max" id="num_max" value="<?php echo $num_row_com_dic ?>">
             <?php 
			//echo $num_row_com_dic;
            while($row_com_dic=mysql_fetch_array($result_com_dic)){
				 
				 ?>
             <tr class="filas_subtotal">
				<td id="orden_<?php echo $row_com_dic['cd_orden']?>"><?php echo $row_com_dic['cd_orden']?></td>
                <?php $query_com="SELECT * FROM com_competencias WHERE com_id=".$row_com_dic['cd_com_id'];
            		$result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
					$row_com=mysql_fetch_array($result_com)
					?>
                <td id="ord_<?php echo $row_com_dic['cd_orden']?>"><?php echo utf8_encode($row_com['com_nombre'])?></td>
                <input type="hidden" name="o_<?php echo $row_com_dic['cd_orden']?>" id="o_<?php echo $row_com_dic['cd_orden']?>" value="<?php echo $row_com_dic['cd_com_id'] ?>">
                <td class="numerica">
                    <a href="competencias/show.php?com_id=<?php echo $row_com['com_id'];?>&amp;dic_id=<?php echo $dic_id;?>">
                    	<img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles">
                    </a>
                     <?php if ($row['dic_cerrado']=="no"){?> 
                        &nbsp;
                        <a href="competencias/edit.php?com_id=<?php echo $row_com['com_id'];?>&amp;dic_id=<?php echo $dic_id;?>">
                            <img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar">
                        </a>
                        &nbsp;
                        <a href="competencias/delete.php?orden=<?php echo $row_com_dic['cd_orden']?>&amp;dic_id=<?php echo $dic_id;?>">
                            <img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar">
                        </a>
                        
                        <?php 
                        
                        if ($row_com_dic['cd_orden']!=$num_row_com_dic){?>
                            &nbsp;
                                <img src="/img/bajar.png" width="20" height="20" alt="Bajar" title="Bajar" onclick="bajar(<?php echo $row_com_dic['cd_orden']?>)">
                        <?php } 
                        if ($row_com_dic['cd_orden']!= 1){?>
                            &nbsp;
                                <img src="/img/subir.png" width="20" height="20" alt="Subir" title="Subir" onclick="subir(<?php echo $row_com_dic['cd_orden']?>)">
                        <?php } 
					}
					?>
	          	</td> 
             </tr>
            <?php }?>
      
     
 	    </table>
  	</div>
    <center><input type="button" value="Volver a Diccionarios" class="boton-crear" onClick="document.location.href = '../diccionario/index.php'">
    &nbsp;<input type="button" value="Guardar Orden" class="boton-crear" onclick="guardar_orden()"></center>
   
</div>

<footer> </footer>
</body></html>


