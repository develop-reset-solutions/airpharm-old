<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
?>
<script language="javascript">
/*
function anadir_dic(){
	
	var usr_id=document.getElementById("usr_id").value;
	//alert (usr_id);
	//window.location="anadir_diccionario.php?usr_id="+usr_id;
	$.ajax({
		url: "anadir_diccionario.php",
		type: "POST",
		data:'usr_id='+usr_id,
		success: function(data){			
			$("#diccionario").html(data);
			//$("#actitud").html(data);
			
		}        
   	});
}
*/

function aparece_diccionario(){
	var val=document.getElementById("dic_ano_nuevo").value;
	
	$.ajax({
		url: "/administracion/usuarios/diccionario_ano.php",
		type: "POST",
		data:'ano='+val,
		success: function(data){			
			$("#diccionario_ano").html(data);
		}        
   	});
}
</script>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="replica_dic.php" method="post" >
   <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">DUPLICAR DICCIONARIO</td>
      </tr>
      <tr>
        <td class="titulos_campos">Año Origen: </td>
        <td>
            <select id="dic_ano_nuevo" name="dic_ano_nuevo" class="campo-largo" onchange="aparece_diccionario()">
                <option value="0" >Elige el año...</option>
                <?php 
                $query_ano="SELECT DISTINCT dic_ano FROM com_diccionarios WHERE dic_cerrado='si' order by dic_ano";
                $result_ano=mysql_query($query_ano) or die ("No se puede ejecutar la sentencia: ".$query_ano);
                while($row_ano=mysql_fetch_array($result_ano)){	
                  
                        ?>
                        <option value="<?php echo $row_ano['dic_ano'];?>" ><?php echo $row_ano['dic_ano'];?></option>
                    <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="titulos_campos">Diccionario: </td>
        <td>
            <div id="diccionario_ano" name="diccionario_ano">
               
         		<?php
				if($row_dic1['dic_ano']!=""){
					$query_dic_new="SELECT * FROM com_diccionarios WHERE dic_ano=".$row_dic1['dic_ano']." AND dic_cerrado='si'";
					$result_dic_new=mysql_query($query_dic_new) or die ("No se puede ejecutar la sentencia: ".$query_dic_new);
				}
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
      </tr>
      <tr>
        <td class="titulos_campos">Año nuevo: </td>
        <td>
            <select id="dic_ano_duplicado" name="dic_ano_duplicado" class="campo-largo" >
                <option value="0" >Elige el año...</option>
               <!-- <option value="2015" >2015</option>
                <option value="2016" >2016</option>-->
 
                <!-- Si queremos que vaya los if hay que informar el año por javascript -->
	            <?php if ($row_dic1['dic_ano']!=date("Y")){ ?>
                       <option value="<?php echo date("Y"); ?>" ><?php echo date("Y");?></option>
                <?php } 
				if ($row_dic1['dic_ano']!=(date("Y")+1)){ ?>
                       <option value="<?php echo date("Y")+1; ?>" ><?php echo date("Y")+1;?></option>
             	<?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
        	<input type="submit" value="Duplicar" class="boton-crear">&nbsp;
        	<input type="button" value="Volver" class="boton-crear" onClick="document.location.href = '../index.php'">
        </td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>