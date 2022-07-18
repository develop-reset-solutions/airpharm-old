<?php 
session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
?>
<script language="javascript">
	function cambiar_com_id(val,val2){
		window.location="show.php?com_id="+val+"&dic_id="+val2;
		}
	
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
        
          <td colspan="2">Competencias de <?php echo $row_dic['dic_nombre'] ?></td>
        </tr>
        <tr>
            <td style="background-color:transparent; width:1200px;">
           	</td>
           	<td class="texto_10">
                <select name="com_id" onchange="cambiar_com_id(this.value,<?php echo $dic_id ?>)">
                    <?php 
                    $query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." order by cd_orden";
                    $result_com_dic=mysql_query($query_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_com_dic);
                    while($row_com_dic=mysql_fetch_array($result_com_dic)){
                        $query_com="SELECT * FROM com_competencias WHERE com_id=".$row_com_dic['cd_com_id'];
                        $result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
                        $row_com=mysql_fetch_array($result_com)
                        
                         ?>
                        
                         <option value="<?php echo $row_com['com_id']?>" 
                         <?php if ($row_com['com_id']==$com_id){$com_nombre=$row_com['com_nombre']; $com_descripcion=$row_com['com_descripcion']; echo "selected";}?>>
                         <?php echo utf8_encode($row_com['com_nombre'])?></option> 
                    <?php }?>
                </select>
            </td>
            
		</tr>
        </table>
      </form>
      
    </div>
  </div>
 
  <div class="tabla_dpo">
   <form action="edit.php?com_id=<?php echo $com_id ?>&amp;dic_id=<?php echo $dic_id ?>"  method="post" enctype="multipart/form-data">
    <table width="100%">
       
      <!--<input type="hidden" name="dpo_id" value="<?php echo $row['dpo_id'];?>" />-->
      <tr>
        <td colspan="2" class="titulo"><?php echo utf8_encode($com_nombre);?></td>
      </tr>
      <tr>
        <td colspan="2" class="filas_subtotal" style="font-size: 15px; padding: 15px 10px;"><?php echo utf8_encode($com_descripcion);?></td>
      </tr>
      
	   <?php 
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

			if ($num_row_act_com_dic<3){
				?>
				 <tr>
        			<td colspan="2" class="filas_subtotal" style="color:red; font-size: 15px; padding: 15px 10px;">La competencia no está completa aprieta a Editar y complétala </td>
      			</tr>
			<?php }
			while($row_act_com_dic=mysql_fetch_array($result_act_com_dic)){
				$query_act="SELECT * FROM com_actitudes WHERE act_id=".$row_act_com_dic['acd_act_id'];
				$result_act=mysql_query($query_act) or die ("No se puede ejecutar la sentencia: ".$query_act);
				$row_act=mysql_fetch_array($result_act);
				 ?>
				<tr class="titulo_grupo">
					<td colspan="2" style="text-align:left;"> Grado <?php echo utf8_encode($row_act_com_dic['acd_grado']);?>. <?php echo utf8_encode($row_act['act_nombre']);?></td>
				</tr>				
				<?php $query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_act_com_dic['acd_id']." ORDER BY cacd_numero ";
				if($dic_agrupado=="no"){
					$query_comp_act_com_dic.="ASC";
				} else{
					$query_comp_act_com_dic.="DESC";
				}
				
				$result_comp_act_com_dic=mysql_query($query_comp_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_comp_act_com_dic);
				while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
					$query_comp="SELECT * FROM com_comportamientos WHERE comp_id=".$row_comp_act_com_dic['cacd_comp_id'];
					$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
					$row_comp=mysql_fetch_array($result_comp);
					?>	
						<tr class="filas_subtotal">
							<td class="celdas_subtotal"> <?php echo utf8_encode($row_comp_act_com_dic['cacd_numero']);?>. <?php echo utf8_encode($row_comp['comp_nombre']);?></td>
							<!--<td class="celdas_subtotal"><input type="text"></td>-->
						</tr>	
				<?php }		
				
			}
	   /*}
	   else if ($dic_agrupado=="si"){
		   $query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." and cd_com_id=".$com_id." order by cd_orden";
			$result_com_dic=mysql_query($query_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_com_dic);
			$row_com_dic=mysql_fetch_array($result_com_dic);

			$query_act_com_dic="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$row_com_dic['cd_id'];
			$result_act_com_dic=mysql_query($query_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_act_com_dic);
			$num_row_act_com_dic = mysql_num_rows($result_act_com_dic);
			
			if ($num_row_act_com_dic<1){
				?>
				 <tr>
					<td colspan="2" class="filas_subtotal" style="color:red; font-size: 15px; padding: 15px 10px;">La competencia no está completa aprieta a Editar y complétala </td>
				</tr>
			<?php }
		   
		   while($row_act_com_dic=mysql_fetch_array($result_act_com_dic)){
			   
			   $query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_act_com_dic['acd_id']." ORDER BY cacd_numero";
			   $result_comp_act_com_dic=mysql_query($query_comp_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_comp_act_com_dic);
			   
			   
				
				 while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
					 $query_comp="SELECT * FROM com_comportamientos WHERE comp_id=".$row_comp_act_com_dic['cacd_comp_id'] ;
					$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
					$row_comp=mysql_fetch_array($result_comp);
					?>	
						<tr class="filas_subtotal">
							<td class="celdas_subtotal"> <?php echo utf8_encode($row_comp_act_com_dic['cacd_numero']);?>. <?php echo utf8_encode($row_comp['comp_nombre']);?></td>
							
						</tr>	
				<?php }		
				
			}
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   /*
			$query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." and cd_com_id=".$com_id." order by cd_orden";
			$result_com_dic=mysql_query($query_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_com_dic);
			//$row_com_dic=mysql_fetch_array($result_com_dic);
			
			
			$j=0;
			//Rellena los datos que hay en la base de datos.
			while($row_com_dic=mysql_fetch_array($result_com_dic)){
							?>
					<tr class="filas_subtotal">
					<td > 
					<div nombre="actitud_<?php echo $j; ?>" id="actitud_<?php echo $j; ?>" >
					<table>
					 <?php  $query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_act_com_dic['acd_id'];
							$result_comp_act_com_dic=mysql_query($query_comp_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_comp_act_com_dic);
							while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
								$query_comp="SELECT * FROM com_comportamientos WHERE comp_id=".$row_comp_act_com_dic['cacd_comp_id'];
								$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
								$row_comp=mysql_fetch_array($result_comp);
					 
					 /*
							$query_comp="SELECT * FROM com_comportamientos WHERE comp_com_id=".$com_id." AND comp_act_id =0"; 
							$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
							while($row_comp=mysql_fetch_array($result_comp)){*//*
								   ?>
								   <tr class="filas_subtotal">
										<td class="celdas_subtotal"> <?php echo utf8_encode($row_comp_act_com_dic['cacd_numero']);?>. <?php echo utf8_encode($row_comp['comp_nombre']);?></td>
								   </tr>
                                   	<?php
							}
							?>
					</table>
					</div>
						</td>
					</tr>
					<?php
			}*/
		//}
		?>
    
        <td colspan="2" class="filas_subtotal" align="center">
        <?php if ($row_dic['dic_cerrado']=="no"){?> 
        	<input type="submit" name="Editar" id="Editar" value="Editar"/>
           	&nbsp;
        <?php }?> 
          	<input type="button" name="Volver" id="Volver" value="Volver a Competencias" onClick="document.location.href = '../show.php?dic_id=<?php echo $dic_id;?>'"/>
          <!--&nbsp;
          <input type="submit" name="Guardar" id="Guardar" value="Guardar y seguir" />
          &nbsp;
          &nbsp;
          <input type="submit" value="Descartar cambios" />--></td>
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
