<?php 
session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
?>

<script language="javascript">
function cambiar_act(val,j){
	//alert($('input:text[name=nombre]').val());
	
	//var grado = $('#grado_'+j ).val();
	//alert(grado);
	//var val = $('#cenid').val();
	
	$.ajax({
		url: "cargar_actitud.php",
		type: "POST",
		data:'actitud='+val+'&j='+j,
		success: function(data){			
			$("#actitud_"+j).html(data);
			//$("#actitud").html(data);
			
		}        
   	});
}

function validarcampos(){
	var dic_agrupado=document.getElementById("dic_agrupado").value;
	
	//if (dic_agrupado=="no"){
		var act_1=document.getElementById("act_1").value;
		var act_2=document.getElementById("act_2").value;
		var act_3=document.getElementById("act_3").value;
		var comp_1_1=document.getElementById("comp_1_1").value;
		var comp_1_2=document.getElementById("comp_1_2").value;
		var comp_1_3=document.getElementById("comp_1_3").value;
		var comp_1_4=document.getElementById("comp_1_4").value;
		var comp_2_1=document.getElementById("comp_2_1").value;
		var comp_2_2=document.getElementById("comp_2_2").value;
		var comp_2_3=document.getElementById("comp_2_3").value;
		var comp_2_4=document.getElementById("comp_2_4").value;
		var comp_3_1=document.getElementById("comp_3_1").value;
		var comp_3_2=document.getElementById("comp_3_2").value;
		var comp_3_3=document.getElementById("comp_3_3").value;
		var comp_3_4=document.getElementById("comp_3_4").value;
		
		if (act_1==0 || act_2==0 || act_3==0){
			alert ("Hay que elegir las tres actitudes");
		} 
		else{
			if (act_1==act_2 || act_1==act_3 || act_3==act_2 ||comp_1_1==comp_1_2 || comp_1_1==comp_1_3 || comp_1_1==comp_1_4 || comp_1_2==comp_1_3 || comp_1_2==comp_1_4 || comp_1_3==comp_1_4 || 
			comp_2_1==comp_2_2 || comp_2_1==comp_2_3 || comp_2_1==comp_2_4 || comp_2_2==comp_2_3 || comp_2_2==comp_2_4 || comp_2_3==comp_2_4 || comp_3_1==comp_3_2 || comp_3_1==comp_3_3 || 
			comp_3_1==comp_3_4 || comp_3_2==comp_3_3 || comp_3_2==comp_3_4 || comp_3_3==comp_3_4 ){
				alert ("Las actitudes y los comportamientos no se pueden repetir");
				
			} else{
				document.form_act.submit()
			}
		}
	/*} else if (dic_agrupado=="si"){
		var comp_1=document.getElementById("comp_1").selectedIndex;
		var comp_2=document.getElementById("comp_2").selectedIndex;
		var comp_3=document.getElementById("comp_3").selectedIndex;
		var comp_4=document.getElementById("comp_4").selectedIndex;
		var comp_5=document.getElementById("comp_5").selectedIndex;
		var comp_6=document.getElementById("comp_6").selectedIndex;
		var comp_7=document.getElementById("comp_7").selectedIndex;
		var comp_8=document.getElementById("comp_8").selectedIndex;
		var comp_9=document.getElementById("comp_9").selectedIndex;
		var comp_10=document.getElementById("comp_10").selectedIndex;
		var comp_11=document.getElementById("comp_11").selectedIndex;
		var comp_12=document.getElementById("comp_12").selectedIndex;
		
		if (comp_1==comp_2 || comp_1==comp_3 || comp_1==comp_4 ||comp_1==comp_5 || comp_1==comp_6 || comp_1==comp_7 || comp_1==comp_8 || comp_1==comp_9 || comp_1==comp_10 || comp_1==comp_11 ||
			comp_1==comp_12 || comp_2==comp_3 || comp_2==comp_4 || comp_2==comp_5 || comp_2==comp_6 || comp_2==comp_7 || comp_2==comp_8 || comp_2==comp_9 || comp_2==comp_10 || comp_2==comp_11 ||
			comp_2==comp_12 || comp_3==comp_4 ||comp_3==comp_5 || comp_3==comp_6 || comp_3==comp_7 || comp_3==comp_8 || comp_3==comp_9 || comp_3==comp_10 || comp_3==comp_11 || comp_3==comp_12 ||
			comp_4==comp_5 || comp_4==comp_6 || comp_4==comp_7 || comp_4==comp_8 || comp_4==comp_9 || comp_4==comp_10 || comp_4==comp_11 || comp_4==comp_12 || comp_5==comp_6 || comp_5==comp_7 || 
			comp_5==comp_8 || comp_5==comp_9 || comp_5==comp_10 || comp_5==comp_11 || comp_5==comp_12 || comp_6==comp_7 || comp_6==comp_8 || comp_6==comp_9 || comp_6==comp_10 || comp_6==comp_11 ||
			comp_6==comp_12 || comp_7==comp_8 || comp_7==comp_9 || comp_7==comp_10 || comp_7==comp_11 || comp_7==comp_12 || comp_8==comp_9 || comp_8==comp_10 || comp_8==comp_11 || comp_8==comp_12 ||
			comp_9==comp_10 || comp_9==comp_11 || comp_9==comp_12  ||  comp_10==comp_11 || comp_10==comp_12 || comp_11==comp_12 ){
				alert ("Los comportamientos no se pueden repetir");
				
			} else{
				document.form_act.submit()
			}
		}*/
}
/*
	function cambiar_com_id(val,val2){
		window.location="show.php?com_id="+val+"&dic_id="+val2;
		}
	function redirigir(val,val2){
		alert(val,val2);
		window.location="create.php?com_id="+val+"&dic_id="+val2;
	}
	*/
</script>

<?php 
$com_id=$_REQUEST['com_id'];
$dic_id=$_REQUEST['dic_id'];
$query_dic="SELECT * FROM com_diccionarios WHERE dic_id=".$dic_id;
$result_dic=mysql_query($query_dic) or die ("No se puede ejecutar la sentencia: ".$query_dic);
$row_dic=mysql_fetch_array($result_dic);
$dic_agrupado=$row_dic['dic_agrupado'];
?>
<link href="../../../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
    
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
        
          <td >Competencias de <?php echo $row_dic['dic_nombre'] ?></td>
        </tr>
      
        </table>
      </form>
      
    </div>
  </div>
  
 
  <div class="tabla_dpo">
   <form  id="form_act" name="form_act" action="modify.php?com_id=<?php echo $com_id ?>&amp;dic_id=<?php echo $dic_id ?>" method="post" enctype="multipart/form-data" onsubmit="return validarcampos(this)">
   	<input type="hidden" name="com_id" value="<?php echo $com_id;?>">
   	<input type="hidden" name="dic_id" value="<?php echo $dic_id;?>">
    <input type="hidden" id="dic_agrupado" name="dic_agrupado" value="<?php echo $dic_agrupado;?>">
    <?php
	$query_com="SELECT * FROM com_competencias WHERE com_id=".$com_id;
    $result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
    $row_com=mysql_fetch_array($result_com)
	?>
    <table width="100%">
      <tr>
        <td class="titulo"><?php echo utf8_encode($row_com['com_nombre']);?></td>
      </tr>
      <tr>
        <td  class="filas_subtotal" style="font-size: 15px; padding: 15px 10px;"><?php echo utf8_encode($row_com['com_descripcion']);?></td>
      </tr>
      
	  <?php //repasar los selects o mirar de hacerlo con la vista cuando vaya bien.
		//if ($dic_agrupado=="no"){
			$query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." and cd_com_id=".$com_id." order by cd_orden";
			$result_com_dic=mysql_query($query_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_com_dic);
			$row_com_dic=mysql_fetch_array($result_com_dic);
			
			$query_act_com_dic="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$row_com_dic['cd_id']." ORDER BY acd_grado ";
			if($dic_agrupado=="no"){
				$query_act_com_dic.="DESC";
			}else{
				$query_act_com_dic.="ASC";
			}
			$result_act_com_dic=mysql_query($query_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_act_com_dic);
			
			$num_row_act_com_dic = mysql_num_rows($result_act_com_dic);
			$j=0;
			//Rellena los datos que hay en la base de datos.
			while($row_act_com_dic=mysql_fetch_array($result_act_com_dic)){
				$query_act="SELECT * FROM com_actitudes WHERE act_id=".$row_act_com_dic['acd_act_id'];
				$result_act=mysql_query($query_act) or die ("No se puede ejecutar la sentencia: ".$query_act);
				$row_act=mysql_fetch_array($result_act);
				$j++;
				 ?>
				
				<tr class="titulo_grupo">
					<td  style="text-align:left;"> 
					Grado <?php echo  $row_act_com_dic['acd_grado'];
					/*
					if ($j==1){ echo "A: ";}
					if ($j==2){ echo "B: ";}
					if ($j==3){ echo "C: ";}
					*/
					?>:
			
					<select class="select_largo" name="act_<?php echo $j; ?>" id="act_<?php echo $j; ?>" onchange="cambiar_act(this.value,<?php echo $j ?>)">
			
						<?php 
						$actitud=$row_act_com_dic['acd_act_id'];
						$query_act="SELECT * FROM com_actitudes WHERE act_com_id=".$com_id;
						$result_act=mysql_query($query_act) or die ("No se puede ejecutar la sentencia: ".$query_act);
						while($row_act=mysql_fetch_array($result_act)){
						   ?>
						   <option value="<?php echo $row_act['act_id']?>" <?php if ($row_act['act_id']==$actitud){echo "selected";}?>><?php echo utf8_encode($row_act['act_nombre'])?>
						   </option> 
							<?php }?>
					</select>
				   </td>
				</tr>				
				<tr class="filas_subtotal">
					<td class="celdas_subtotal"> 
					<div nombre="actitud_<?php echo $j ;?>" id="actitud_<?php echo $j ;?>" >
					<table>
						<?php $query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_act_com_dic['acd_id']." ORDER BY cacd_numero ";
						if($dic_agrupado=="no"){
							$query_comp_act_com_dic.="ASC";
						} else{
							$query_comp_act_com_dic.="DESC";
						}
						
						$result_comp_act_com_dic=mysql_query($query_comp_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_comp_act_com_dic);
						while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
							$comportamiento=$row_comp_act_com_dic['cacd_comp_id'];
							//echo " comportamiento: ".$comportamiento;
							//echo " actitud: ".$actitud;
							
							//$query_comp="SELECT * FROM com_comportamientos WHERE comp_id=".$comportamiento;
							//$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
							//$row_comp=mysql_fetch_array($result_comp);
							//Mirar como queda esta parte.
							?>	
							<tr>
								<td> <?php echo $row_comp_act_com_dic['cacd_numero'];?>. 
									<select class="select_largo" name="comp_<?php echo $j;?>_<?php echo $row_comp_act_com_dic['cacd_numero'];?>" id="comp_<?php echo $j;?>_<?php echo $row_comp_act_com_dic['cacd_numero'];?>" >
										<?php 
										$query_comp="SELECT * FROM com_comportamientos WHERE comp_act_id=".$actitud;
										$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
										while($row_comp=mysql_fetch_array($result_comp)){
										 ?>
										  <option value="<?php echo $row_comp['comp_id']?>"<?php if ($row_comp['comp_id']==$comportamiento){echo "selected";}?>><?php echo utf8_encode($row_comp['comp_nombre'])?>
										  </option> 
										<?php }?>
									</select>
								</td>
							</tr>	
							
						<?php } ?>	
					</table>
					</div>
					</td>
				</tr>	
			<?php }
			//Si no esta asignada las tres actitudes
			while ($j < 3){
			//if ($num_row_act_com_dic<1){
				$j++;
				?>
				
				<tr class="titulo_grupo">
					<td style="text-align:left;">
					  Grado <?php if ($j==1){ echo "A: ";}
					if ($j==2){ echo "B: ";}
					if ($j==3){ echo "C: ";}
					?>
					 
					<select class="select_largo" name="act_<?php echo $j ?>" id="act_<?php echo $j ?>" onchange="cambiar_act(this.value,<?php echo $j ?>)">
						<option value="0">Elige una actitud...</option>
						<?php 
						$query_act="SELECT * FROM com_actitudes WHERE act_com_id=".$com_id;
						$result_act=mysql_query($query_act) or die ("No se puede ejecutar la sentencia: ".$query_act);
						while($row_act=mysql_fetch_array($result_act)){
						   ?>
						   <option value="<?php echo $row_act['act_id']?>"><?php echo utf8_encode($row_act['act_nombre'])?></option> 
						<?php }?>
					</select>
					</td>
				</tr>
				<tr class="filas_subtotal">
					<td class="celdas_subtotal"> 
					<div nombre="actitud_<?php echo $j; ?>" id="actitud_<?php echo $j; ?>" >
					<table>
					 <?php 
						$i = 0;
						while ($i < 4){
							$i++;
							?>	
							<tr>
								<td> <?php echo $i;?>. 
									<select class="select_largo" name="comp_<?php echo $j;?>_<?php echo $i;?>"  id="comp_<?php echo $j;?>_<?php echo $i;?>" >
										<option value="0">Elige un comportamiento...</option>
										<?php 
										if ($act_id==""){$act_id=0;}
										$query_comp="SELECT * FROM com_comportamientos WHERE comp_act_id=".$act_id;
										$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
										while($row_comp=mysql_fetch_array($result_comp)){
										   ?>
										   <option value="<?php echo $row_comp['comp_id']?>"><?php echo utf8_encode($row_comp['comp_nombre'])?></option> 
										<?php }?>
									</select>
								</td>
							</tr>	
						<?php }?>
					</table>
					</div>
					</td>
				</tr>
				<?php
			}
		/*
		}
		else if ($dic_agrupado=="si"){
			
			$query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." and cd_com_id=".$com_id." order by cd_orden";
			$result_com_dic=mysql_query($query_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_com_dic);
			$row_com_dic=mysql_fetch_array($result_com_dic);

			$query_act_com_dic="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$row_com_dic['cd_id'];
			$result_act_com_dic=mysql_query($query_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_act_com_dic);
			
			
		   
		   while($row_act_com_dic=mysql_fetch_array($result_act_com_dic)){
			   
			   $query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_act_com_dic['acd_id'];
			   $result_comp_act_com_dic=mysql_query($query_comp_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_comp_act_com_dic);
			   
			   $num_row_comp_act_com_dic = mysql_num_rows($result_comp_act_com_dic);

				if ($num_row_comp_act_com_dic<12){
					?>
					 <tr>
						<td colspan="2" class="filas_subtotal" style="color:red; font-size: 15px; padding: 15px 10px;">La competencia no está completa aprieta a Editar y complétala </td>
					</tr>
				<?php }
				 while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
					 $j++
					/* $query_comp="SELECT * FROM com_comportamientos WHERE comp_id=".$row_comp_act_com_dic['cacd_comp_id'];
					$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
					$row_comp=mysql_fetch_array($result_comp);*//*
					?>	
                    <tr class="filas_subtotal">
                            <td class="celdas_subtotal"> <?php echo $j;?>. 
                                <!--<select name="act_id">-->
                                <select class="select_largo" name="comp_<?php echo $j;?>"  id="comp_<?php echo $j;?>" >
                                    <option value="0">Elige un comportamiento...</option>
										<?php 
										$query_comp="SELECT * FROM com_comportamientos WHERE comp_com_id=".$com_id." AND comp_act_id =0"; 
										$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
										while($row_comp=mysql_fetch_array($result_comp)){
										   ?>
										   <option value="<?php echo $row_comp['comp_id']?>" <?php if ($row_comp['comp_id']==$row_comp_act_com_dic['cacd_comp_id']){echo "selected";}?>>
										   <?php echo utf8_encode($row_comp['comp_nombre'])?></option> 
										<?php }?>
								</select>
							</td>
						</tr>	
						<!--<tr class="filas_subtotal">
							<td class="celdas_subtotal"> <?php echo utf8_encode($row_comp_act_com_dic['cacd_numero']);?>. <?php echo utf8_encode($row_comp['comp_nombre']);?></td>
							
						</tr>-->	
				<?php }		
				
				
		   	/*while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
					 $query_comp="SELECT * FROM com_comportamientos WHERE comp_id=".$row_comp_act_com_dic['cacd_comp_id'];
					$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
					$row_comp=mysql_fetch_array($result_comp);
					?>	
                    	<tr>
                            <td class="celdas_subtotal"> <?php echo $j;?>. 
                                <!--<select name="act_id">-->
                                <select class="select_largo" name="comp_<?php echo $j;?>"  id="comp_<?php echo $j;?>" >
                                    <option value="0">Elige un comportamiento...</option>
										<?php 
										$query_comp="SELECT * FROM com_comportamientos WHERE comp_com_id=".$com_id." AND comp_act_id =0"; 
										$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
										while($row_comp=mysql_fetch_array($result_comp)){
										   ?>
										   <option value="<?php echo $row_comp['comp_id']?>" <?php if ($j==$row_comp_act_com_dic['cacd_numero']){echo "selected";}?>>
										   <?php echo utf8_encode($row_comp['comp_nombre'])?></option> 
										<?php }?>
								</select>
							</td>
						</tr>	
						
				<?php }		
				*//*
			
			}
			while ($j < 12){
				?>
					<tr class="filas_subtotal">
					<td > 
					<div nombre="actitud_<?php echo $j; ?>" id="actitud_<?php echo $j; ?>" >
					<table>
					 <?php 
						
						while ($j < 12){
							$j++;
							?>	
							<tr>
								<td class="celdas_subtotal"> <?php echo $j;?>. 
									<!--<select name="act_id">-->
									<select class="select_largo" name="comp_<?php echo $j;?>"  id="comp_<?php echo $j;?>" >
										<option value="0">Elige un comportamiento...</option>
										<?php 
										$query_comp="SELECT * FROM com_comportamientos WHERE comp_com_id=".$com_id." AND comp_act_id =0"; 
										$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
										$k=0;
										while($row_comp=mysql_fetch_array($result_comp)){
											$k++;
										   ?>
										   <option value="<?php echo $row_comp['comp_id']?>"  <?php if ($j==$k){echo "selected";}?>><?php echo utf8_encode($row_comp['comp_nombre'])?></option> 
										<?php }?>
									</select>
								</td>
							</tr>	
						<?php }?>
					</table>
					</div>
					</td>
				</tr>
                <?php
			}
		}*/
		?>
        <tr>
            <td  class="filas_subtotal" align="center">

            
              <input type="button" name="Guardar" id="Guardar" value="Guardar" onclick="validarcampos()" />
			  &nbsp;
              &nbsp;
              <input type="button" name="Volver" id="Volver" value="Volver a Competencias" onClick="document.location.href = '../show.php?dic_id=<?php echo $dic_id;?>'" />
               &nbsp;
              &nbsp;
              <input type="button" name="Volver" id="Volver" value="Volver a Ver" onClick="document.location.href = 'show.php?com_id=<?php echo $com_id;?>&dic_id=<?php echo $dic_id;?>'" />
              <!--<input type="button" name="Guardar" id="Guardar" value="Guardar"/>                           ?com_id=1&dic_id=10
              &nbsp;
              &nbsp;
              <input type="submit" name="Guardar" id="Guardar" value="Guardar y seguir" />
              &nbsp;
              &nbsp;
              <input type="submit" value="Descartar cambios" />-->
            </td>
        </tr>
    </table>
    </form>
    </td>
    </tr>
    </table>
  </div>
</div>
<footer> </footer>
</body></html>
