<?php 
session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();

//$query_usr1="SELECT * FROM usuarios WHERE usr_baja=0 ORDER BY usr_apellidos, usr_nombre ASC";
$query_usr1="SELECT * FROM usuarios ORDER BY usr_apellidos, usr_nombre ASC";
$result_usr1=mysql_query($query_usr1) or die ("No se puede ejecutar la sentencia: ".$query_usr1);
	
/*
if($_POST['filtrar']){
	$dic_nombre=$_POST['dic_nombre'];
	$query.=" AND dic_nombre LIKE '%".utf8_decode($dic_nombre)."%'";
	
}elseif($_POST['reset']){
	$dic_nombre='';
	$query.="";
}
$query.=" ORDER BY dic_nombre ASC";
*/
?>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
	<?php if ($_SESSION['usr_perfil']=='Director RRHH'){
		$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE dic_ano=".$_SESSION['ano'];
		if($_REQUEST['filtrar']){
			$filtrar_apellidos=$_REQUEST['filtrar_apellidos'];
			$query_usr_dic.=" AND apellidos LIKE '%".utf8_decode($filtrar_apellidos)."%'";
			
		}
		
		$query_usr_dic.=" ORDER BY apellidos, nombre ASC";
		$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejecutar la sentencia: ".$query_usr_dic);
		
		
		?>
		
       <div class="filtros">
         <form method="post" action="#">
            <table align="center" width="100%">
            <tr>
                <!--<td><a href="duplicar_competencias.php" class="texto_10">Duplicar Competencias</a>
                <td style="background-color:transparent; width:950px;"></td>
                
                <td style="background-color:transparent; width:1100px;"></td>
			    -->
                 <td style="background-color:transparent; width:825px;"></td>
     			<td class="texto_10"> Apellidos:
                  <input name="filtrar_apellidos" type="text" class="texto_10" value="<?php echo $filtrar_apellidos;?>"/>
              	  &nbsp;<input type="submit" name="filtrar" id="filtrar" value="Filtrar" class="texto_10"/></td>
                 <td><a target="blank" href="imprimir_todos.php" class="texto_10">Imprimir Todos</a>
                </td>
                
              </tr>
            </table>
          </form>  
       </div>
   <?php } ?>
   <div class="tabla_apartados">
    <table width="100%">
    	<thead>
			<td class="izq" width="10%">Estado</td>
	    	<td class="izq" width="35%">Colaborador</td>
            <td class="izq" width="35%">Diccionario</td>
            <td width="10%">Fecha Cierre</td>
        	<td width="10%">Acción</td>
      </thead>
      <?php
	  if ($_SESSION['usr_perfil']=='Director RRHH'){
		//$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE dic_ano=".$_SESSION['ano']." ORDER BY apellidos, nombre ASC";
		//$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejecutar la sentencia: ".$query_usr_dic);
		while($row_usr_dic=mysql_fetch_array($result_usr_dic)){
		    $query_grados="SELECT cd_com_id FROM com_com_dic WHERE cd_dic_id=".$row_usr_dic['dic_id'];
			$result_grados=mysql_query($query_grados) or die ("No se puede ejecutar la sentencia: ".$query_grados);
			$num_grados = mysql_num_rows($result_grados);
			
			$query_vdic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$row_usr_dic['du_usr_id']." AND dic_ano=".$_SESSION['ano'];
 	       	$result_vdic=mysql_query($query_vdic) or die ("No se puede ejecutar la sentencia: ".$query_vdic);
    	    $row_vdic=mysql_fetch_array($result_vdic);
				
			//calculo el número de competencias que el usuario tiene el grado informado 
			$num_grados_ok=0;
			$query_grados_ok="SELECT duc_grado FROM vcom_dic_usr_com WHERE du_usr_id=".$row_usr_dic['du_usr_id']." AND du_dic_id=".$row_vdic['dic_id'];
			//$query_grados_ok="SELECT duc_grado FROM com_dic_usr_com WHERE duc_usr_id=".$row_usr_dic['du_usr_id']." and duc_dic_id=".$row_vdic['dic_id'];
			$result_grados_ok=mysql_query($query_grados_ok) or die ("No se puede ejecutar la sentencia: ".$query_grados_ok);
			while($row_grados_ok=mysql_fetch_array($result_grados_ok)){								
				if($row_grados_ok['duc_grado']!=""){$num_grados_ok++;}
			}
		
			$query_usr="SELECT * FROM usuarios WHERE usr_id=".$row_usr_dic['du_usr_id'];
			$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
			$row_usr=mysql_fetch_array($result_usr);
			
			?>
            <tr class="filas_subtotal">
                     <td><?php if ($row_vdic['du_cerrado']=='1'){?>
                        <img src="/img/cerrar.png" width="15" height="15" alt="Cerrar" title="Cerrar">
                     <?php } else { ?>
                        <img src="/img/abrir.png" width="15" height="15" alt="Cerrar" title="Cerrar">
                     <?php }?>
                     </td>
                	 <td <?php if ($num_grados==$num_grados_ok){echo 'class="verde"';}?>> 
					  <?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']); ?>
                     <td><?php echo utf8_encode($row_vdic['dic_nombre']);?></td>
                     <td><center><?php if ($row_vdic['du_fecha_cierre']!="" and $row_vdic['du_fecha_cierre']!="0000-00-00" ){echo cambiaf_a_normal($row_vdic['du_fecha_cierre']);}?></center></td>

                    <td class="numerica">
                    
                        <a href="show.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>"><img src="/img/ver.png" width="15" height="15" alt="Ver" title="Ver"></a>&nbsp;
                        <?php if ($row_usr_dic['du_cerrado']=='0'){?>
							<a href="edit.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>"><img src="/img/editar.png" width="15" height="15" alt="Editar" title="Editar"></a>&nbsp;
                       <?php
						}
					    if ($num_grados==$num_grados_ok && $row_usr_dic['du_cerrado']=='0'){?>
                            <a href="cerrar.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>&dic_id=<?php echo $row_usr_dic['dic_id'];?>">
                            <img src="/img/cerrar.png" width="15" height="15" alt="Cerrar" title="Cerrar"></a>&nbsp;
                        <?php } 
						 if ($row_usr_dic['du_cerrado']=='1'){
						  if ($_SESSION['usr_perfil']=='Director RRHH'){
							  ?>
							 <a href="abrir.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>&dic_id=<?php echo $row_usr_dic['dic_id'];?>">
                             <img src="/img/abrir.png" width="15" height="15" alt="Abrir" title="Abrir"></a>
                             
                      <?php }
						 }
						/*if ($row_usr_dic['du_cerrado']=='1'){?>
                            <a >
                            <img src="/img/abrir.png" width="15" height="15" alt="Abrir" title="Abrir"></a>&nbsp;
                        <?php }*/
						?>
                        <a target="blank" href="imprimir.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>">
                        <img src="/img/impresora.png" width="15" height="15" alt="Imprimir" title="Imprimir"></a>&nbsp;
						<?php /*if ($row['dic_cerrado']=="no"){?>
                            <a href="edit.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;
                            <?php if ($num_comp==$num_comp_com){?>
	                            <a href="cerrar.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/cerrar.png" width="20" height="20" alt="Cerrar" title="Cerrar"></a>&nbsp;				
                            <?php }?>
                            <a href="duplicar_dic/delete.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a>&nbsp;
                    	<?php } */?>
                        
                    </td>
      			</tr>
              
			<?php }
		} //ahora empieza los que no son Director RRHH
	  else{	  
	  
		$query_vdic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$_SESSION['usr_id']." AND dic_ano=".$_SESSION['ano'];
		$result_vdic=mysql_query($query_vdic) or die ("No se puede ejecutar la sentencia: ".$query_vdic);
		$row_vdic=mysql_fetch_array($result_vdic);
		
	if ( $row_vdic['dic_id']!=""){
					 
	    $query_grados="SELECT cd_com_id FROM com_com_dic WHERE cd_dic_id=".$row_vdic['dic_id'];
		$result_grados=mysql_query($query_grados) or die ("No se puede ejecutar la sentencia: ".$query_grados);
		$num_grados = mysql_num_rows($result_grados);
									
		//calculo el número de competencias que el usuario tiene el grado informado 
		$num_grados_ok=0;
		$query_grados_ok="SELECT duc_grado FROM vcom_dic_usr_com WHERE du_usr_id=".$_SESSION['usr_id']." AND du_dic_id=".$row_vdic['dic_id'];
		//$query_grados_ok="SELECT duc_grado FROM com_dic_usr_com WHERE duc_usr_id=".$_SESSION['usr_id']." and duc_dic_id=".$row_vdic['dic_id'];
		$result_grados_ok=mysql_query($query_grados_ok) or die ("No se puede ejecutar la sentencia: ".$query_grados_ok);
		while($row_grados_ok=mysql_fetch_array($result_grados_ok)){								
			if($row_grados_ok['duc_grado']!=""){$num_grados_ok++;}
		}
	  ?>
      
      <tr class="filas_subtotal">
	         <td><?php if ($row_vdic['du_cerrado']=='1'){?>
             	<img src="/img/cerrar.png" width="15" height="15" alt="Cerrar" title="Cerrar">
			 <?php } else { ?>
             	<img src="/img/abrir.png" width="15" height="15" alt="Cerrar" title="Cerrar">
			 <?php }?></td>
             <td <?php if ($num_grados==$num_grados_ok){echo 'class="verde"';}?>> 
             <?php echo utf8_encode($_SESSION['usr_apellidos']).", ".utf8_encode($_SESSION['usr_nombre']);
             /* if ($row_vdic['du_cerrado']=='1'){
                  if ($_SESSION['usr_perfil']=='Director RRHH'){
                      ?>
                     <a href="abrir.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>&dic_id=<?php echo $row_vdic['dic_id'];?>">
                     <img src="/img/cerrar_rojo.fw.png" width="15" height="15" alt="Abrir" title="Abrir"></a>
                     <?php
                      }else{
                    ?> <img src="/img/cerrar_rojo.fw.png" width="15" height="15"><?php }?></td>
             
              <?php } */
			  ?> 
            
             <td><?php echo utf8_encode($row_vdic['dic_nombre']);?></td>
             <td><center><?php if ($row_vdic['du_fecha_cierre']!="" and $row_vdic['du_fecha_cierre']!="0000-00-00" ){echo cambiaf_a_normal($row_vdic['du_fecha_cierre']);}?></center></td>
             <td class="numerica">
                <a href="show.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>">
                <img src="/img/ver.png" width="15" height="15" alt="Ver" title="Ver"></a>&nbsp;
               <?php if ($row_vdic['du_cerrado']=='0' && $row_vdic['du_autoevaluable']=='1'){?>
               <a href="edit.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>">
               <img src="/img/editar.png" width="15" height="15" alt="Editar" title="Editar"></a>&nbsp;
                <?php }
                 if ($num_grados==$num_grados_ok && $row_vdic['du_cerrado']=='0' && $row_vdic['du_autoevaluable']=='1'){?>
                    <a href="cerrar.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>&dic_id=<?php echo $row_vdic['dic_id'];?>">
                    <img src="/img/cerrar.png" width="15" height="15" alt="Cerrar" title="Cerrar"></a>&nbsp;
                <?php }
					if ($row_usr_dic['du_cerrado']=='1'){
						  if ($_SESSION['usr_perfil']=='Director RRHH'){
							  ?>
							 <a href="abrir.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>&dic_id=<?php echo $row_usr_dic['dic_id'];?>">
                             <img src="/img/abrir.png" width="15" height="15" alt="Abrir" title="Abrir"></a>
                             
                      <?php }
						 }
				
				?>
                <a  target="blank" href="imprimir.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>">
                <img src="/img/impresora.png" width="15" height="15" alt="Imprimir" title="Imprimir"></a>&nbsp;
                <?php /*if ($row['dic_cerrado']=="no"){?>
                <a href="edit.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;
                <?php if ($num_comp==$num_comp_com){?>
                <a href="cerrar.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/cerrar.png" width="20" height="20" alt="Cerrar" title="Cerrar"></a>&nbsp;				
                <?php }?>
                <a href="duplicar_dic/delete.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a>&nbsp;
            <?php } */ }?>
        </tr>
      <?php
	  while($row_usr1=mysql_fetch_array($result_usr1)){

		if(superior($_SESSION['usr_id'],$row_usr1['usr_id'])){
			$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_responsable=".$row_usr1['usr_id']." AND dic_ano=".$_SESSION['ano'];
			$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejecutar la sentencia: ".$query_usr_dic);
			while($row_usr_dic=mysql_fetch_array($result_usr_dic)){
				
  			    $query_grados="SELECT cd_com_id FROM com_com_dic WHERE cd_dic_id=".$row_usr_dic['dic_id'];
				$result_grados=mysql_query($query_grados) or die ("No se puede ejecutar la sentencia: ".$query_grados);
				$num_grados = mysql_num_rows($result_grados);
											
				//calculo el número de competencias que el usuario tiene el grado informado 
				$num_grados_ok=0;
				$query_grados_ok="SELECT duc_grado FROM vcom_dic_usr_com WHERE du_usr_id=".$row_usr_dic['du_usr_id']." AND du_dic_id=".$row_vdic['dic_id'];
				//$query_grados_ok="SELECT duc_grado FROM com_dic_usr_com WHERE duc_usr_id=".$row_usr_dic['du_usr_id']." and duc_dic_id=".$row_vdic['dic_id'];
				$result_grados_ok=mysql_query($query_grados_ok) or die ("No se puede ejecutar la sentencia: ".$query_grados_ok);
				while($row_grados_ok=mysql_fetch_array($result_grados_ok)){								
					if($row_grados_ok['duc_grado']!=""){$num_grados_ok++;}
				}
				
				$query_usr="SELECT * FROM usuarios WHERE usr_id=".$row_usr_dic['du_usr_id'];
				$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
				$row_usr=mysql_fetch_array($result_usr);
				
				$query_vdic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$row_usr_dic['du_usr_id']." AND dic_ano=".$_SESSION['ano'];
 	        	$result_vdic=mysql_query($query_vdic) or die ("No se puede ejecutar la sentencia: ".$query_vdic);
    		    $row_vdic=mysql_fetch_array($result_vdic);
				?>
                <tr class="filas_subtotal">
                     <td><?php if ($row_vdic['du_cerrado']=='1'){?>
                        <img src="/img/cerrar.png" width="15" height="15" alt="Cerrar" title="Cerrar">
                     <?php } else { ?>
                        <img src="/img/abrir.png" width="15" height="15" alt="Cerrar" title="Cerrar">
                     <?php }?>
                     </td>
                	 <td <?php if ($num_grados==$num_grados_ok){echo 'class="verde"';}?>> 
					  <?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']); 
					  /*if ($row_usr_dic['du_cerrado']=='1'){
						  if ($_SESSION['usr_perfil']=='Director RRHH'){
							  ?>
							 <a href="abrir.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>&dic_id=<?php echo $row_usr_dic['dic_id'];?>">
                             <img src="/img/cerrar.png" width="15" height="15" alt="Abrir" title="Abrir"></a>
                             <?php
							  }else{
						  ?> <img src="/img/cerrar.png" width="15" height="15"><?php }?></td>
                     
                      <?php }*/
						
					 ?>
                    <td><?php echo utf8_encode($row_vdic['dic_nombre']);?></td>
					<td><center><?php if ($row_vdic['du_fecha_cierre']!="" and $row_vdic['du_fecha_cierre']!="0000-00-00" ){echo cambiaf_a_normal($row_vdic['du_fecha_cierre']);}?></center></td>
                    
                    <td class="numerica">
                    
                        <a href="show.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>"><img src="/img/ver.png" width="15" height="15" alt="Ver" title="Ver"></a>&nbsp;
                        <?php if ($row_usr_dic['du_cerrado']=='0'){?>
							<a href="edit.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>"><img src="/img/editar.png" width="15" height="15" alt="Editar" title="Editar"></a>&nbsp;
                       <?php
						}
					    if ($num_grados==$num_grados_ok && $row_usr_dic['du_cerrado']=='0'){?>
                            <a href="cerrar.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>&dic_id=<?php echo $row_usr_dic['dic_id'];?>">
                            <img src="/img/cerrar.png" width="15" height="15" alt="Cerrar" title="Cerrar"></a>&nbsp;
                        <?php } 
							if ($row_usr_dic['du_cerrado']=='1'){
							  if ($_SESSION['usr_perfil']=='Director RRHH'){
								  ?>
								 <a href="abrir.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>&dic_id=<?php echo $row_usr_dic['dic_id'];?>">
								 <img src="/img/abrir.png" width="15" height="15" alt="Abrir" title="Abrir"></a>
								 
						  <?php }
							 }
						?>
                        <a target="blank" href="imprimir.php?usr_id=<?php echo $row_vdic['du_usr_id'];?>">
                        <img src="/img/impresora.png" width="15" height="15" alt="Imprimir" title="Imprimir"></a>&nbsp;
						<?php /*if ($row['dic_cerrado']=="no"){?>
                            <a href="edit.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;
                            <?php if ($num_comp==$num_comp_com){?>
	                            <a href="cerrar.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/cerrar.png" width="20" height="20" alt="Cerrar" title="Cerrar"></a>&nbsp;				
                            <?php }?>
                            <a href="duplicar_dic/delete.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a>&nbsp;
                    	<?php } */?>
                        
                    </td>
      			</tr>
              
			<?php }
		}
	}
	}
	  
	 /* 
	  $result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	  while($row=mysql_fetch_array($result)){
		  $query_comp="SELECT * FROM vcom_diccionario WHERE cd_dic_id=".$row['dic_id'];
		  $result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
		  $num_comp = mysql_num_rows($result_comp);
		  $query_comp="SELECT DISTINCT cd_com_id FROM com_com_dic WHERE cd_dic_id=".$row['dic_id'];
		  $result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
		  $num_com = mysql_num_rows($result_comp);
		  $num_comp_com= $num_com*12;
		  ?>
   	  <tr class="filas_subtotal">
   	    <td <?php if ($num_comp==$num_comp_com){echo 'class="verde"';}?>><?php echo utf8_encode($row['dic_nombre']);?>
		</td>
        <td class="numerica">
        	<a href="show.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;
	        <?php if ($row['dic_cerrado']=="no"){?>
                <a href="edit.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;
                <?php if ($num_comp==$num_comp_com){?>
                    <a href="cerrar.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/cerrar.png" width="20" height="20" alt="Cerrar" title="Cerrar"></a>&nbsp;				
                <?php }?>
                <a href="duplicar_dic/delete.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a>&nbsp;
            <?php }?>
      </tr>
 <?php  }*/
		
 ?>
 		 <!--<tr class="filas_subtotal">
             <td colspan="3" >No hay resultados </td>
 			</tr>-->
            <?php  //}
 			?>
 	    </table>
  </div>
    <!--<center><input type="button" value="Volver a Competencias" class="boton-crear" onClick="document.location.href = '../competencias/index.php'"></center>-->
</div>
<footer> </footer>
</body></html>