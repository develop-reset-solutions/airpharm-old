<?php 
session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
?>
<script language="javascript">
	function cambiar_com_id(val){
		
		var dic_id = document.getElementById("id").value;
		var cd_orden = document.getElementById("orden").value;
		window.location="insert_c.php?com_id="+val+"&dic_id="+dic_id+"&cd_orden="+cd_orden;

		}
	function ver(val){
		
		window.location="show_c.php?com_id="+val;

	}
</script>
<?php 
$dic_id=$_REQUEST['dic_id'];
$query="SELECT * FROM com_diccionarios WHERE dic_id=".$dic_id;
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
?>
<link href="../../../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
    <input name="id" id="id" type="hidden" value="<?php echo $dic_id ?>">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
          <td colspan="7">Diccionario <?php echo $row['dic_nombre'] ?></td>
        </tr>
        <tr>
       
       

         <!--<td class="texto_10"><input type="button" class="texto_10" value="Cambiar competencia"></td>-->
         <!-- <td style="background-color:#999999; width:600px;"></td>
          <td class="texto_10"> Colaborador:
            <select name="dpo_usr_id" id="dpo_usr_id" class="texto_10">
              <option value="<?php echo $dpo_usr_id;?>"><?php echo utf8_encode($row['usr_apellidos'].", ".$row['usr_nombre']);?></option>
              <?php 
					$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 ORDER BY usr_apellidos, usr_nombre ASC";
					$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
					while($row_usr=mysql_fetch_array($result_usr)){
					?>
              <option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$dpo_usr_id){?><?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
              <?php }?>
            </select></td>
          <td><input type="submit" name="filtrar" id="filtrar" value="Filtrar" class="texto_10"/></td>-->
		</tr>
        </table>
      </form>
      
    </div>
  </div>
   <div class="tabla_apartados">
    <table width="100%">
      <thead>
		<td width="10%">Orden</td>
      	<td width="80%">Competencia</td>
       <td width="10%">Acción</td>
      </thead>
      <?php
	  $query_ccd="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id;
	  $result_ccd=mysql_query($query_ccd) or die ("No se puede ejecutar la sentencia: ".$query_ccd);
	  
	  while($row_ccd=mysql_fetch_array($result_ccd)){?>
   	  <tr class="filas_subtotal">
      	<td><?php $ult_num= $row_ccd['cd_orden']; echo $row_ccd['cd_orden']?></td>
        
   	    <td><select name="com_id">
        		<?php 
				$query_com="SELECT * FROM com_competencias";
				//$query_com="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id ORDER BY cd_orden Asc;
				$result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
				while($row_com=mysql_fetch_array($result_com)){
					 ?>
				 <option value="<?php echo $row_com['com_id']?>" <?php if ($row_com['com_id']==$com_id){$com_nombre=$row_com['com_nombre']; $com_descripcion=$row_com['com_descripcion']; echo "selected";}?>>
				 <?php echo utf8_encode($row_com['com_nombre'])?></option> 
				<?php }?>
            </select></td>
        <td class="numerica">
	        <!--<img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles" onclick="ver(<?php echo $row_com['com_id'];?>)"></a>&nbsp;-->
        	<!--
            <a href="show_c.php?com_id=<?php echo "hola".$row_com['com_id'];?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;
        	<a href="edit2.php?com_id=<?php echo $row_com['com_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;
            <a href="delete2.php?com_id=<?php echo $row_com['com_id'];?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a>
            -->
        </td>
      </tr>
 <?php }?>
	 <tr class="filas_subtotal">
     <td><?php $num_siguiente = $ult_num + 1; echo $num_siguiente ?></td>
     <input name="orden" id="orden" type="hidden" value="<?php echo $num_siguiente?>">
     <td>Añade otra competencia: <select name="com_id" onchange="cambiar_com_id(this.value)">
            <option value="0" >Selecciona una competencia...</option>
            <?php 
            $query_com="SELECT * FROM com_competencias";
            //$query_com="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id;
            $result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
            while($row_com=mysql_fetch_array($result_com)){
             ?>
             <option value="<?php echo $row_com['com_id']?>" <?php if ($row_com['com_id']==$com_id){$com_nombre=$row_com['com_nombre']; $com_descripcion=$row_com['com_descripcion']; echo "selected";}?>>
             <?php echo utf8_encode($row_com['com_nombre'])?></option> 
            <?php }?>
         </select></td>
	    <td class="numerica"></td>
      </tr>
     
 	    </table>
  </div>
  <center>
  	<input type="button" value="Guardar el cambio de orden" class="boton-crear" onClick="document.location.href = '../competencias/index2.php'">&nbsp;
  	<input type="button" value="Crear nueva Competencia" class="boton-crear" onClick="document.location.href = '../competencias/create.php'">&nbsp;
    <!--<input type="button" value="Modificar Competencias" class="boton-crear" onClick="document.location.href = '../diccionario/show_c.php?$dic_id'">&nbsp;-->
  	<input type="button" value="Volver a Diccionarios" class="boton-crear" onClick="document.location.href = '../diccionario/index.php'">
  </center>

</div>
<footer> </footer>
</body></html>