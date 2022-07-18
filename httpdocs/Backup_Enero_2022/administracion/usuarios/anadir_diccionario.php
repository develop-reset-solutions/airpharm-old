<?php  session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");

$conn=db_connect();
$usr_id=$_REQUEST['usr_id'];
$dic_id=$_REQUEST['dic_id'];
?>
 <table width="100%">
     <thead>
		<td class="titulos_campos" width="10%">Año</td>
        <td class="titulos_campos" width="30%">Diccionario</td>
   	    <td class="titulos_campos" width="40%">Evaluador</td>
       	<td class="titulos_campos" width="10%">Autoevaluable</td>
		<td class="titulos_campos" width="10%">Acciones</td>
     </thead>
     <?php
		$query_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$usr_id;
		if ($dic_id!=""){
		$query_dic.=" AND dic_id <> ".$dic_id;	
			}
		$query_dic.=" ORDER BY dic_ano DESC";
		$result_dic=mysql_query($query_dic) or die ("No se puede ejecutar la sentencia (query_dic): ".$query_dic);
		$num_rows = mysql_num_rows($result_dic);
		
		if ($num_rows > 0){?>
		
			<?php
			$j=0;
			while($row_dic=mysql_fetch_array($result_dic)){
				$ano[$j]=$row_dic['dic_ano'];
				?>
				<tr>
					<td>
						<?php echo $row_dic['dic_ano'];?>
					</td>
					<td>
						<?php echo $row_dic['dic_nombre'];?>
					</td>
					
					<td>
						<?php echo utf8_encode($row_dic['usr_apellidos']).", ".utf8_encode($row_dic['usr_nombre']);?>
					</td>
                    <td>
                        <center><input type="checkbox" name="autoevaluable1" disabled="disabled" value="1" <?php if($row_dic['du_autoevaluable']==1){?> checked="checked"<?php }?> ></center>
                    </td>
       				<td>
	                    <a href="delete_diccionario.php?du_id=<?php echo $row_dic['du_id'];?>">
                        <img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a>
	                </td>
	
				</tr>
				<?php $j++;
			}
		}
		if($dic_id!=""){
		$query_dic1="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$usr_id." AND dic_id=".$dic_id;
		$result_dic1=mysql_query($query_dic1) or die ("No se puede ejecutar la sentencia: ".$query_dic1);
		$row_dic1=mysql_fetch_array($result_dic1)
		 ?> 
         
        <tr>
            <td>
                <select id="dic_ano_nuevo" name="dic_ano_nuevo" class="campo-largo" onchange="aparece_diccionario()">
                    <option value="0" >Elige el año...</option>
                    <?php 
                    $query_ano="SELECT DISTINCT dic_ano FROM com_diccionarios WHERE dic_cerrado='si'";
                    $result_ano=mysql_query($query_ano) or die ("No se puede ejecutar la sentencia: ".$query_ano);
                    while($row_ano=mysql_fetch_array($result_ano)){	
                        $mostrar=1;
                        $j=0;
                        while($j < $num_rows){
                            if ($row_ano['dic_ano']==$ano[$j]){$mostrar= 0;}
                            $j++;
                        }
                        if ($mostrar==1){
                            ?>
                            <option value="<?php echo $row_ano['dic_ano'];?>" <?php if ($row_ano['dic_ano']==$row_dic1['dic_ano']){echo "selected";} ?> ><?php echo $row_ano['dic_ano'];?></option>
                        <?php }
                    }?>
                </select>
                
            </td>
            <td>
            <div id="diccionario_ano" name="diccionario_ano">
                <!--<select name="dic_nombre_nuevo" class="campo-largo">
                    <option value="<?php echo $row_dic1['dic_id'] ?>" ><?php echo $row_dic1['dic_nombre'];?></option>
                </select>
                -->
         		<?php       
                $query_dic_new="SELECT * FROM com_diccionarios WHERE dic_ano=".$row_dic1['dic_ano']." AND dic_cerrado='si'";
				$result_dic_new=mysql_query($query_dic_new) or die ("No se puede ejecutar la sentencia: ".$query_dic_new);
				?>
				<select name="dic_nombre_nuevo" class="campo-largo">
					<option value="0" >Elige el diccionario...</option>
					<?php while($row_dic_new=mysql_fetch_array($result_dic_new)){?>
					<option value="<?php echo $row_dic_new['dic_id'];?>" <?php if($row_dic_new['dic_id']== $row_dic1['dic_id']){echo "selected";}?> ><?php echo utf8_encode($row_dic_new['dic_nombre']);?>							
					</option>
					<?php }?>
				</select>
            </div>
               
            </td>
            <td>
            <?php 
            $query_usr="SELECT * FROM usuarios ORDER BY usr_apellidos";
            $result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
            ?>
            <select name="evaluador" class="campo-largo">
                <option value="" >Elige evaluador...</option>
                <?php while($row_usr=mysql_fetch_array($result_usr)){?>
                <option value="<?php echo $row_usr['usr_id'];?>"<?php if ($row_usr['usr_id']==$row_dic1['du_responsable']){echo "selected";} ?> ><?php echo utf8_encode($row_usr['usr_apellidos']).", ".utf8_encode($row_usr['usr_nombre']);?>							
                </option>
                <?php }?>
            </select>
            
            </td>
             <td>
                <center><input type="checkbox" name="autoevaluable" value="1" <?php if ($row_dic1['du_autoevaluable']==1){echo "checked=checked";}?> ></center>
            </td>                                                            
            <td>
                 <a href="">
                        <img src="/img/volver.png" width="20" height="20" alt="Volver" title="Volver"></a>
            </td>
        </tr>
        <?php
		
	
		}else{
		
		$query_ano="SELECT DISTINCT dic_ano FROM com_diccionarios WHERE dic_cerrado='si'";
		$result_ano=mysql_query($query_ano) or die ("No se puede ejecutar la sentencia: ".$query_ano);
		$num_rows_ano = mysql_num_rows($result_ano);
		if ($num_rows<$num_rows_ano){
	 ?> 
    <tr>
        
        <td>
            
            <select id="dic_ano_nuevo" name="dic_ano_nuevo" class="campo-largo" onchange="aparece_diccionario()">
                <option value="0" >Elige el año...</option>
				<?php 
				$query_ano="SELECT DISTINCT dic_ano FROM com_diccionarios WHERE dic_cerrado='si'";
				$result_ano=mysql_query($query_ano) or die ("No se puede ejecutar la sentencia: ".$query_ano);
				/*
                $i=$_SESSION['ano'];
                $final= date('Y')+1;
                while($i <= $final){
					*/
				while($row_ano=mysql_fetch_array($result_ano)){	
					$mostrar=1;
					$j=0;
					//echo "año: ".$ano[$j];
                    
					while($j < $num_rows){
                        if ($row_ano['dic_ano']==$ano[$j]){$mostrar= 0;}
						$j++;
                    }
                    if ($mostrar==1){
						?>
						<option value="<?php echo $row_ano['dic_ano'];?>" ><?php echo $row_ano['dic_ano'];?></option>
                    <?php }
                }?>
            </select>
            
        </td>
        <td>
        <div id="diccionario_ano" name="diccionario_ano">
            <select name="dic_nombre_nuevo" class="campo-largo">
                <option value="" >Elige el diccionario...</option>
            </select>
        </div>
           
        </td>
        <td>
        <?php 
        $query_usr="SELECT * FROM usuarios ORDER BY usr_apellidos";
        $result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
        ?>
        <select name="evaluador" class="campo-largo">
            <option value="" >Elige evaluador...</option>
            <?php while($row_usr=mysql_fetch_array($result_usr)){?>
            <option value="<?php echo $row_usr['usr_id'];?>" ><?php echo utf8_encode($row_usr['usr_apellidos']).", ".utf8_encode($row_usr['usr_nombre']);?>							
            </option>
            <?php }?>
        </select>
            
        </td>
         <td>

            <center><input type="checkbox" name="autoevaluable" value="1" <?php if ($row_dic1['du_autoevaluable']==1){echo "checked=checked";}?> ></center>
        </td>
        <td>
	        <a href=""><img src="/img/volver.png" width="20" height="20" alt="Volver" title="Volver"></a>
        </td>
    </tr>
    <?php
	} else {
		?>
	<tr>
		 <td colspan="3">
		    No hay diccionarios preparados para los siguientes años
		  </td>
    </tr>
    <?php
	}
	}
	?> 
</table>
            	
    
    
    
    
   