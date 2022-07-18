<?php 
session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();


if ($_REQUEST['usr_id']!=""){
	$usr_id=$_REQUEST['usr_id'];
	if ($_REQUEST['com_id']!=""){
		$com_id=$_REQUEST['com_id'];
	} else {
		$query_uua ="SELECT * FROM com_usr_ult_acceso WHERE uua_colaborador_id =".$usr_id." AND uua_ano=".$_SESSION['ano']." ORDER BY uua_fecha_mod DESC LIMIT 1";
		$result_uua=mysql_query($query_uua) or die("No se puede ejecutar la sentencia: ".$query_uua);
		$row_uua=mysql_fetch_array($result_uua);
		$com_id=$row_uua['uua_com_id'];
		//if ($com_id!=""){
	}
} else{
	$usr_id=$_SESSION['usr_id'];
	if ($_REQUEST['com_id']!=""){
		$com_id=$_REQUEST['com_id'];
	} else {
		$query_uua ="SELECT * FROM com_usr_ult_acceso WHERE uua_usr_id =".$usr_id." AND uua_ano=".$_SESSION['ano']." ORDER BY uua_fecha_mod DESC LIMIT 1";
		$result_uua=mysql_query($query_uua) or die("No se puede ejecutar la sentencia: ".$query_uua);
		$row_uua=mysql_fetch_array($result_uua);
		$com_id=$row_uua['uua_com_id'];
		$usr_id=$row_uua['uua_colaborador_id'];
	}
}
?>
<script language="javascript">
$(document).ready(function() {
	$(".Guardar").click(function (){
		if(($("#grado").val() == "0" || $("#grado").val() == null) && document.getElementById('grado').disabled == false){ 
        	alert("Tienes que introducir el valor del grado."); 
            return false;
    	}
		
  	});	
	 $("a").click(function(e){
			 comprobar_cambios(e);
		
		});
	//var agrupado=document.getElementById("dic_agrupado").value;
	
	//if (agrupado=="no"){
		var j = 0;
		var completo=true;
		while (j < 3) {
			j ++;
			var i= 0;
			while (i < 4) {
				i++
				comp=document.getElementById("comp_"+j+"_"+i).value;
				if (comp==0){
					completo=false;
				}
			}
		}
		if (completo){
			document.getElementById("grado").disabled = false;
			
		} else{
			document.getElementById("grado").disabled = true;
			document.getElementById("grado").value="";
		}
		/*
	} else {
		var j = 0;
		var completo=true;
		document.getElementById("cambio").value=true;
		while (j < 12) {
			j ++;
			comp=document.getElementById("comp_"+j).value;
			if (comp==0){
				completo=false;
			}
		}
		if (completo){
			document.getElementById("grado").disabled = false;
			
		} else{
			document.getElementById("grado").disabled = true;
			document.getElementById("grado").value="";
		}
	
	}*/
	
 });
 
/*$(function() {
    Poner que habilite o desabilite el grado. Segun si esta o no todo informado.
});*/


function comprobar_cambios(e){
	 var cambio=document.getElementById("cambio").value;
		 if (cambio=="true"){
			var r = confirm("Seguro que quiere salir sin guardar")
			if (r == false) {
				e.preventDefault();
			}
		 }
}
function refrescar(){
	var competencia=document.getElementById("competencia").value;
	var usr_id = document.getElementById("user").value;
	window.location="edit_agrupado.php?com_id="+competencia+"&usr_id="+usr_id;
}
function cambiar_no_agrupado(){
	var competencia=document.getElementById("competencia").value;
	var usr_id = document.getElementById("user").value;
	window.location="edit.php?com_id="+competencia+"&usr_id="+usr_id;
	}
function cambiar_competencia(){
	
	var competencia=document.getElementById("competencia").value;
	var usr_id = document.getElementById("user").value;
		
	var cambio=document.getElementById("cambio").value;

	 if (cambio=="true"){
		var r = confirm("Seguro que quiere salir sin guardar")
		if (r == true) {
			window.location="edit_agrupado.php?com_id="+competencia+"&usr_id="+usr_id;
			
		} else {
			
			   var combo =  document.getElementById("competencia");
			   var com_id =document.getElementById("com_id").value;
			   //alert(com_id);
			   var cantidad = combo.length;
			    //alert(cantidad);
			   for (i = 0; i < cantidad; i++) {
				   //alert("hola");
				  if (combo[i].value == com_id) {
					 combo[i].selected = true;
				  }   
			   }
			
		}
		
	 } else {
	 	window.location="edit_agrupado.php?com_id="+competencia+"&usr_id="+usr_id;
	 }
}
function cambiar_usuario(){
	var usr_id=document.getElementById("user").value;
	var cambio=document.getElementById("cambio").value;
	var usr_id_ant = document.getElementById("usr_id").value;

	if (cambio=="true"){
		var r = confirm("Seguro que quiere salir sin guardar")
		if (r == true) {
			window.location="edit.php?usr_id="+usr_id;
			
		} else {
			
			   var combousr =  document.getElementById("user");
			   var com_id =document.getElementById("com_id").value;
			   //alert(com_id);
			   var cantidad = combousr.length;
			    //alert(cantidad);
			   for (i = 0; i < cantidad; i++) {
				   //alert("hola");
				  if (combousr[i].value == usr_id_ant) {
					 combousr[i].selected = true;
				  }   
			   }
			
			//alert("else")
			/*
			var com_nombre =document.getElementById("com_nombre").value;
			var e = document.getElementById("competencia");
			e.options[e.selectedIndex].value=com_nombre;
			//e.selectedIndex.value=2;
			alert (e.options[e.selectedIndex].value);*/
		}
		
	 } else {
	 	window.location="edit.php?usr_id="+usr_id;
	 }
}

function salir(){
	
	var competencia=document.getElementById("competencia").value;
	var usr_id = document.getElementById("user").value;
		
	var cambio=document.getElementById("cambio").value;

	 if (cambio=="true"){
		var r = confirm("Seguro que quiere salir sin guardar")
		if (r == true) {
			window.location="index.php";
		} else {
			
			   var combo =  document.getElementById("competencia");
			   var com_id =document.getElementById("com_id").value;
			   //alert(com_id);
			   var cantidad = combo.length;
			    //alert(cantidad);
			   for (i = 0; i < cantidad; i++) {
				   //alert("hola");
				  if (combo[i].value == com_id) {
					 combo[i].selected = true;
				  }   
			   }
			
		}
		
	 } else {
		 window.location="index.php";
	 }
}

function cambio_no_agrupado(){
	
	var j = 0;
	var completo=true;
	document.getElementById("cambio").value=true;
	while (j < 3) {
  		j ++;
		var i= 0;
		while (i < 4) {
			i++
			comp=document.getElementById("comp_"+j+"_"+i).value;
			if (comp==0){
				completo=false;
			}
		}
	}
	if (completo){
		document.getElementById("grado").disabled = false;
		
	} else{
		document.getElementById("grado").disabled = true;
		document.getElementById("grado").value="";
	}
}
<!-- falta hacer la funcion cambio_agrupado() que será como la cambio_no_agrupado-->
function cambio_agrupado(){
	var j = 0;
	var completo=true;
	document.getElementById("cambio").value=true;
	while (j < 12) {
  		j ++;
		comp=document.getElementById("comp_"+j).value;
		if (comp==0){
			completo=false;
		}
	}
	if (completo){
		document.getElementById("grado").disabled = false;
		
	} else{
		document.getElementById("grado").disabled = true;
		document.getElementById("grado").value="";
	}
}


</script>
 <input type="hidden" name="cambio" id="cambio" value="false">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
       <?php
			/*
			$query_usr1="SELECT * FROM vusuarios WHERE usr_id=".$usr_id;
            $result_usr1=mysql_query($query_usr1) or die ("No se puede ejecutar la sentencia: ".$query_usr1);
			$row_usr1=mysql_fetch_array($result_usr1)
			*/
		?>
        <table align="center" width="100%">
        
        <tr>
          
          <td class="texto_10">
          	<select name="competencia" id="competencia" onchange="cambiar_competencia()">
			   <?php
                
                $query_vdic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$usr_id." AND dic_ano=".$_SESSION['ano'];
                $result_vdic=mysql_query($query_vdic) or die ("No se puede ejecutar la sentencia: ".$query_vdic);
                $row_vdic=mysql_fetch_array($result_vdic);
				$du_id=$row_vdic['du_id'];
                $dic_id=$row_vdic['dic_id'];
				$dic_agrupado=$row_vdic['dic_agrupado'];
				//Año anterior
				/*
				$query_vdic_ant="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$usr_id." AND dic_ano=".($_SESSION['ano']-1);
                $result_vdic_ant=mysql_query($query_vdic_ant) or die ("No se puede ejecutar la sentencia: ".$query_vdic_ant);
				$row_vdic_ant=mysql_fetch_array($result_vdic_ant);
				if ($row_vdic_ant!=""){
                	$dic_id_ant=$row_vdic_ant['dic_id'];
					$dic_agrupado_ant=$row_vdic_ant['dic_agrupado'];
				}
				*/
                //echo "dic_id".$dic_id;
                $query_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." ORDER BY cd_orden";
                $result_dic=mysql_query($query_dic) or die ("No se puede ejecutar la sentencia: ".$query_dic);
				$n=0;
                 while($row_dic=mysql_fetch_array($result_dic)){
					 $n++;
					if ($com_id==""){$com_id=$row_dic['cd_com_id'];}
					$query_com="SELECT * FROM com_competencias WHERE com_id=". $row_dic['cd_com_id'];
                	$result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
					$row_com=mysql_fetch_array($result_com);
					
					if ($com_id_aux==$com_id){$com_id_sig=$row_dic['cd_com_id'];}

					$query_grado="SELECT duc_grado FROM com_dic_usr_com WHERE duc_com_id=". $row_dic['cd_com_id']." and duc_du_id=".$du_id;
                	$result_grado=mysql_query($query_grado) or die ("No se puede ejecutar la sentencia: ".$query_grado);
					$grado=mysql_result($result_grado, 0);
					//$row_grado=mysql_fetch_array($result_grado);
					
					?>
                    <option  <?php if ($grado!=""){ echo "class='verde'";} ?> value="<?php echo $row_dic['cd_com_id'];?>" <?php if ($row_dic['cd_com_id']==$com_id){$com_id_ant=$com_id_aux;echo "selected";}?> >
                    <?php echo utf8_encode($row_com['com_nombre']);?></option>
										 
                  <?php $com_id_aux=$row_dic['cd_com_id'];}?>
            </select></td>
            <!-- si se quiere poner el recuadro gris quitar el style-->
            <td style="background-color:#999999;"><?php 
				  $col=0;
				  if ($com_id_ant){
					  $col++;
				  	?>
                    <a href="edit_agrupado.php?com_id=<?php echo $com_id_ant;?>&amp;usr_id=<?php echo $usr_id;?>"><img src="../../img/atras.png" width="25" height="25" ></a>
                     <?php }
				  if ($com_id_sig){
					  $col++;
				  	?>
                    
                   <a href="edit_agrupado.php?com_id=<?php echo $com_id_sig;?>&amp;usr_id=<?php echo $usr_id;?>"><img src="../../img/adelante.png" width="25" height="25"></a>
                    
                   <?php }
				  ?></td>
          
          
          <!--<td colspan=" <?php echo 3-$col;?>" style="background-color:#999999; width:200px;"></td>-->
          <td class="texto_14" colspan=" <?php echo 3-$col;?>" style="width:200px;"><?php echo  $row_vdic['dic_nombre'];?></td>
          
          	<td class="texto_10"><input type="button" value="Cambiar a no agrupado" onclick="cambiar_no_agrupado()" /></td>
		  
          <td class="texto_10"> Colaborador:
            <select name="user" id="user" class="texto_10" onchange="cambiar_usuario()">
            <?php
			 if ($_SESSION['usr_perfil']=='Director RRHH'){
		$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE dic_ano=".$_SESSION['ano']." ORDER BY apellidos, nombre ASC";
		$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejecutar la sentencia: ".$query_usr_dic);
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
            		  <option <?php if ($num_grados==$num_grados_ok){ echo "class='verde'";}?> value="<?php echo $row_usr_dic['du_usr_id'];?>" 
					  <?php if ($row_usr_dic['du_usr_id']==$usr_id){echo "selected";}?>> <?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
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
      
       <option <?php if ($num_grados==$num_grados_ok){ echo "class='verde'";}?> value="<?php echo $_SESSION['usr_id'];?>">
			  <?php echo utf8_encode($_SESSION['usr_apellidos']).", ".utf8_encode($_SESSION['usr_nombre']);?></option>
      <?php
	  $query_usr1="SELECT * FROM usuarios ORDER BY usr_apellidos, usr_nombre ASC";
	  //$query_usr1="SELECT * FROM vusuarios WHERE usr_id=".$usr_id;
      $result_usr1=mysql_query($query_usr1) or die ("No se puede ejecutar la sentencia: ".$query_usr1);
	  
	  while($row_usr1=mysql_fetch_array($result_usr1)){
		
		if(evaluador($_SESSION['usr_id'],$row_usr1['usr_id'],$_SESSION['ano']) || superior($_SESSION['usr_id'],$row_usr1['usr_id'])){
			$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$row_usr1['usr_id']." AND dic_ano=".$_SESSION['ano'];
			$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejecutar la sentencia: ".$query_usr_dic);
			
			while($row_usr_dic=mysql_fetch_array($result_usr_dic)){
				
  			    $query_grados="SELECT cd_com_id FROM com_com_dic WHERE cd_dic_id=".$row_usr_dic['dic_id'];
				$result_grados=mysql_query($query_grados) or die ("No se puede ejecutar la sentencia: ".$query_grados);
				$num_grados = mysql_num_rows($result_grados);
											
				//calculo el número de competencias que el usuario tiene el grado informado 
				$num_grados_ok=0;
				$query_grados_ok="SELECT duc_grado FROM vcom_dic_usr_com WHERE du_usr_id=".$row_usr_dic['du_usr_id']." AND du_dic_id=".$row_usr_dic['dic_id'];
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
                <option <?php if ($num_grados==$num_grados_ok){ echo "class='verde'";}?> value="<?php echo $row_usr_dic['du_usr_id'];?>" 
						  <?php if ($row_usr_dic['du_usr_id']==$usr_id){echo "selected";}?>> <?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
              
			<?php }
			
		}
	}
	}
	  
        } ?>
			  
            </select></td>
         
		 </tr>
      
      </table>
      
    </div>
  </div>
  <div class="tabla_dpo">
  <!--<form action="modify.php" method="post" enctype="multipart/form-data" onsubmit="return validacion()">-->
  <form action="modify_agrupado.php" method="post" enctype="multipart/form-data">
    <table width="100%">
	<?php
		
        $query_com1="SELECT * FROM com_competencias WHERE com_id=". $com_id;
		$result_com1=mysql_query($query_com1) or die ("No se puede ejecutar la sentencia: ".$query_com1);
		$row_com1=mysql_fetch_array($result_com1);			
		//$cambio=false;
      ?>
      <input type="hidden" name="cambio" id="cambio" value="false" />
      <input type="hidden" name="usr_id" id="usr_id" value="<?php echo $usr_id;?>" />
      <input type="hidden" name="com_id" id="com_id" value="<?php echo $com_id;?>" />
      <!--<input type="hidden" name="dic_id" value="<?php echo $dic_id;?>" />-->
      <input type="hidden" name="du_id" value="<?php echo $du_id;?>" />
      <input type="hidden" name="com_id_sig" value="<?php echo $com_id_sig;?>" />
      <input type="hidden" name="dic_agrupado" value="<?php echo $dic_agrupado;?>" />
      <tr>
        <td colspan="3" class="filas_subtotal_titulo" ><?php echo utf8_encode($row_com1['com_nombre']);?></td>
      </tr>
      <tr>
        <td colspan="3" class="filas_subtotal" style="font-size: 15px; padding: 15px 10px;"> <?php echo utf8_encode($row_com1['com_descripcion']);?></td>
      </tr>
       <?php 
			$ano_ant=$_SESSION['ano']-1;
		?>
      <tr class="filas_total_verde">
          <td width="90%">Observaciones - Compromisos </td>
          <td width="5%">Puntuación</td>
          <td width="5%"><?php echo $ano_ant;?></td>
      </tr>
      <tr class="filas_subtotal">
        <td>
        	
            <textarea id="observaciones" name="observaciones" class="observaciones" ><?php 
			// hay que calcular el $du_id del colaborador seleccionado.
			$query="SELECT * FROM vcom_dic_usr_com WHERE duc_com_id=". $com_id." AND du_id=". $du_id." AND dic_ano=".$_SESSION['ano'] ;
            //$query="SELECT * FROM vcom_dic_usr_com WHERE duc_com_id=". $com_id." AND du_id=". $du_id; 
            $result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
            $row=mysql_fetch_array($result);
            echo utf8_encode($row['duc_observaciones']);?></textarea>
        </td>
       
        <td>
            <select id="grado" name="grado" class="puntuacion">
            	<option value="0"> </option>
                <option value="A" <?php if ($row['duc_grado']=="A"){echo "selected";}?> >A</option>
                <option value="B" <?php if ($row['duc_grado']=="B"){echo "selected";}?> >B</option>
                <option value="C" <?php if ($row['duc_grado']=="C"){echo "selected";}?> >C</option>
            </select>
        </td>
        <td>
        	<input type="hidden" value="<?php echo "du_usr_id: ".$row['du_usr_id']."com_id: ".$com_id."ano_ant: ".$ano_ant."query: ".$query; ?>"/>
            <?php 
			//if($row['du_usr_id']!=""){
				//$usr_id
				//$query_com_ant="SELECT * FROM vcom_dic_usr_com WHERE duc_com_id=". $com_id." AND du_usr_id=".$row['du_usr_id']." AND dic_ano=".$ano_ant;
				$query_com_ant="SELECT * FROM vcom_dic_usr_com WHERE duc_com_id=". $com_id." AND du_usr_id=".$usr_id." AND dic_ano=".$ano_ant;
				//$query_com_ant="SELECT * FROM vcom_dic_usr_com WHERE duc_com_id=".$row['duc_com_id']." AND duc_usr_id=".$row['duc_usr_id']." AND dic_ano=".($row['dic_ano']-1);
				$result_com_ant=mysql_query($query_com_ant) or die ("No se puede ejecutar la sentencia: ".$query_com_ant);
				$row_com_ant=mysql_fetch_array($result_com_ant);
				//informamos $du_id_ant 
				$du_id_ant=$row_com_ant['du_id'];
				if ($row_com_ant['duc_grado']!=""){
					$grado_ant=$row_com_ant['duc_grado'];
					
				} else {
					$grado_ant="-";
				}
			/*} else {
				$grado_ant="-";
			}*/
			?>
            <input type="hidden" value="<?php echo "du_id_ant: ".$du_id_ant."query_com_ant: ".$query_com_ant; ?>"/>
            <input id="grado_ant" name="grado_ant" class="puntuacion" disabled="disabled" value="<?php echo $grado_ant; ?>"/>
        </td>

      </tr>
      <?php
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////
      /*
	  $query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." and cd_com_id=".$com_id." order by cd_orden";
			$result_com_dic=mysql_query($query_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_com_dic);
			$row_com_dic=mysql_fetch_array($result_com_dic);

			$query_act_com_dic="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$row_com_dic['cd_id'];
			$result_act_com_dic=mysql_query($query_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_act_com_dic);
			
			$num_row_act_com_dic = mysql_num_rows($result_act_com_dic);

			$j=0;
			//while($row_act_com_dic=mysql_fetch_array($result_act_com_dic)){

			 while($row_act_com_dic=mysql_fetch_array($result_act_com_dic)){
			   
			   $query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_act_com_dic['acd_id'];
			   $result_comp_act_com_dic=mysql_query($query_comp_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_comp_act_com_dic);
			   
			   $num_row_comp_act_com_dic = mysql_num_rows($result_comp_act_com_dic);

				
				 while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
					$j++; 
					$query_comp="SELECT * FROM com_comportamientos WHERE comp_id=".$row_comp_act_com_dic['cacd_comp_id'];
					$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
					$row_comp=mysql_fetch_array($result_comp);
					?>	
                    <tr class="filas_subtotal">
                    
                            <td class="celdas_subtotal"> <?php echo $j;?>. <?php echo utf8_encode($row_comp['comp_nombre'])?></td>
                            <td class="celdas_subtotal">
                            	<?php 
									$query_comport="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$row_comp_act_com_dic['cacd_comp_id']." AND ducp_du_id=". $du_id;
									//$query_comport="SELECT * FROM com_dic_usr_comp WHERE ducp_com_id=". $com_id." AND ducp_dic_id=". $dic_id." AND ducp_usr_id=". $usr_id." 
									//AND ducp_comp_orden=".$row_comp_act_com_dic['cacd_numero'];
									$result_comport=mysql_query($query_comport) or die ("No se puede ejecutar la sentencia: ".$query_comport);
									$row_comport=mysql_fetch_array($result_comport);
									 ?>
                                     
                            <input type="hidden" name="comp_id_<?php echo $j;?>" value="<?php $row_comp['comp_id'] ?>" />
                            <select name="comp_<?php echo $j;?>" id="comp_<?php echo $j;?>" onChange="cambio_agrupado()" >
                                <option value="0"> </option>
                                <option value="Si" <?php if ($row_comport['ducp_evaluacion']=="Si"){echo "selected";}?>>Si</option>
                                <option value="No" <?php if ($row_comport['ducp_evaluacion']=="No"){echo "selected";}?>>No</option>
                                <option value="N/A" <?php if ($row_comport['ducp_evaluacion']=="N/A"){echo "selected";}?>>N/A</option>
                              </select>
                            </td>
                             <td class="celdas_subtotal"></td>
						</tr>	
				<?php }		
			}
      */
      ?>
      
      
       <?php //if ($dic_agrupado=="no"){
			$query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." and cd_com_id=".$com_id." order by cd_orden";
			$result_com_dic=mysql_query($query_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_com_dic);
			$row_com_dic=mysql_fetch_array($result_com_dic);

			$query_act_com_dic="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$row_com_dic['cd_id']." ORDER BY acd_grado ASC";
			$result_act_com_dic=mysql_query($query_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_act_com_dic);
			
			$num_row_act_com_dic = mysql_num_rows($result_act_com_dic);
			$num=0;
			$j=0;
			while($row_act_com_dic=mysql_fetch_array($result_act_com_dic)){
				$j++;
				$query_act="SELECT * FROM com_actitudes WHERE act_id=".$row_act_com_dic['acd_act_id'];
				$result_act=mysql_query($query_act) or die ("No se puede ejecutar la sentencia: ".$query_act);
				$row_act=mysql_fetch_array($result_act);
				 ?>
				<!--<tr class="titulo_grupo_verde">
					<td colspan="3" style="text-align:left;"> Grado <?php echo utf8_encode($row_act_com_dic['acd_grado']);?>. <?php echo utf8_encode($row_act['act_nombre']);?></td>
				</tr>-->				
				<?php //$query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_act_com_dic['acd_id'];
				$query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_act_com_dic['acd_id']." ORDER BY cacd_numero DESC";
				$result_comp_act_com_dic=mysql_query($query_comp_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_comp_act_com_dic);
				
				
				$i=0;
				while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
					$num++;
					$i++;
					$query_comp="SELECT * FROM com_comportamientos WHERE comp_id=".$row_comp_act_com_dic['cacd_comp_id'];
					$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
					$row_comp=mysql_fetch_array($result_comp);
					?>	
						<tr class="filas_subtotal">
							<td class="celdas_subtotal"> <?php echo $num; //echo utf8_encode($row_comp_act_com_dic['cacd_numero']);?>. <?php echo utf8_encode($row_comp['comp_nombre']);?></td>
							<td class="celdas_subtotal">
                            	<?php 
								//$query_comport="SELECT * FROM com_dic_usr_comp WHERE ducp_com_id=". $com_id." AND ducp_dic_id=". $dic_id." AND ducp_usr_id=". $usr_id." AND 									ducp_actitud='".$row_act_com_dic['acd_grado']."' AND ducp_comp_orden=".$row_comp_act_com_dic['cacd_numero'];
								
								$query_comport="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$row_comp_act_com_dic['cacd_comp_id']." AND ducp_du_id=". $du_id;
								$result_comport=mysql_query($query_comport) or die ("No se puede ejecutar la sentencia: ".$query_comport);
								$row_comport=mysql_fetch_array($result_comport);
								 ?>
                              
                              <input type="hidden" name="comp_id_<?php echo $j;?>_<?php echo $i;?>" id="comp_id_<?php echo $j;?>_<?php echo $i;?>" value="<?php echo $row_comp['comp_id'] ?>" />
                              <select name="comp_<?php echo $j;?>_<?php echo $i;?>" id="comp_<?php echo $j;?>_<?php echo $i;?>"  onChange="cambio_no_agrupado()">
                                <option value="0"> </option>
                                <option value="Si" <?php if ($row_comport['ducp_evaluacion']=="Si"){echo "selected";}?>>Si</option>
                                <option value="No" <?php if ($row_comport['ducp_evaluacion']=="No"){echo "selected";}?>>No</option>
                                <option value="N/A" <?php if ($row_comport['ducp_evaluacion']=="N/A"){echo "selected";}?>>N/A</option>
                              </select>
                            </td>
                            <td class="celdas_subtotal">
                            <?php 
								if ($du_id_ant!=""){
									$query_comport="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$row_comp_act_com_dic['cacd_comp_id']." AND ducp_du_id=". $du_id_ant;
									$result_comport=mysql_query($query_comport) or die ("No se puede ejecutar la sentencia: ".$query_comport);
									$row_comport=mysql_fetch_array($result_comport);
									if ($row_comport['ducp_evaluacion']!=""){
										$evaluacion_ant=$row_comport['ducp_evaluacion'];
									} else{
										$evaluacion_ant="-";
									}
									//$evaluacion_ant=$row_comport['ducp_evaluacion'];
									//echo $row_comport['ducp_evaluacion'];
								}
								else{
									$evaluacion_ant="-";
									}
									//.$query_comport."/".$du_id_ant
								 ?>
                                 <input type="hidden" value="<?php echo $query_comport."/".$du_id_ant ?>"  />
                                 <p class="resultado_anterior"><?php echo $evaluacion_ant; ?></p>
                            </td>
						</tr>	
				<?php }		
				
			}
      
      
			?>
     
      <tr>
        <td colspan="3" class="filas_subtotal" align="center">
          <input type="submit" class="Guardar" name="Guardar" id="Guardar" value="Guardar"/>
          &nbsp;
          &nbsp;
          <?php 
		  if ($com_id_sig){
			  ?>
			  <input type="submit" class="Guardar" name="Guardar-seguir" id="Guardar-seguir" value="Guardar y seguir"/>
			  &nbsp;
			  &nbsp;
			  <?php 
		  }
		  ?>
          <input type="submit" class="Guardar" name="Guardar-salir" id="Guardar-salir" value="Guardar y salir" /> &nbsp;&nbsp;
          <input type="button" value="Salir" onclick="salir()" /> &nbsp;&nbsp;
          <input type="button" value="Descartar cambios" onclick="refrescar()" /></td>
      </tr>
    </table>
    
    
    </form>
  </div>
</div>
<footer> </footer>
</body></html>