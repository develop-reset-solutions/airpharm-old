<?php session_start();
include("../../login/sesion_start.php");
include("../../login/sesion_start_rrhh.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");

$conn=db_connect();
$dic_id=$_REQUEST['dic_id'];

//$query="SELECT dic_nombre FROM com_diccionarios WHERE dic_id=".$dic_id;
$query="SELECT dic_nombre FROM com_diccionarios" ;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
?>
<link href="../../css/style.css" rel="stylesheet" type="text/css">


<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
            <td colspan="5">Diccionario <?php echo $row['dic_nombre'] ?></td>
              <tr>
             <td><a href="competencias/create.php?dic_id=<?php echo $dic_id?>" class="texto_10">Añadir Competencia</a>
            </td>
              <td style="background-color:transparent; width:1000px;">
              </td>
              <!--<td class="texto_10"> COMPETENCIAS:
                  <input name="com_nombre" type="text" class="texto_10" value="<?php echo $com_nombre;?>"/>
              </td>
              <td><input type="submit" name="filtrar" id="filtrar" value="Filtrar" class="texto_10"/></td>
              <td><input name="reset" type="submit" id="reset" value="Todas" class="texto_10" /></td>-->
          </tr>
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
			//echo $num_row_com_dic;
            while($row_com_dic=mysql_fetch_array($result_com_dic)){
				 
				 ?>
             <tr class="filas_subtotal">
				<td><?php echo $row_com_dic['cd_orden']?></td>
                <?php $query_com="SELECT * FROM com_competencias WHERE com_id=".$row_com_dic['cd_com_id'];
            		$result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
					$row_com=mysql_fetch_array($result_com)
					?>
                <td><?php echo utf8_encode($row_com['com_nombre'])?></td>
                <td class="numerica">
                    <a href="competencias/show.php?com_id=<?php echo $row_com['com_id'];?>&amp;dic_id=<?php echo $dic_id;?>">
                    	<img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles">
                    </a>
                    &nbsp;
                    <a href="competencias/edit.php?com_id=<?php echo $row_com['com_id'];?>&amp;dic_id=<?php echo $dic_id;?>">
                    	<img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar">
                    </a>
                    &nbsp;
                    <a href="competencias/delete.php?orden=<?php echo $row_com_dic['cd_orden']?>&amp;dic_id=<?php echo $dic_id;?>">
                    	<img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar">
                    </a>
                    
                    <?php 
					/* //////////// Hay que mirar como hacer lo de cambiar el orden de las competencias.	//////////////////////////////////////////////////////////////////		
					if ($row_com_dic['cd_orden']!=$num_row_com_dic){?>
                    	&nbsp;
                        <a href="bajar.php?com_id=<?php echo $row_com['com_id'];?>">
                            <img src="/img/bajar.png" width="20" height="20" alt="Bajar" title="Bajar">
                        </a>
                    
                    <?php } 
					if ($row_com_dic['cd_orden']!= 1){?>
                    	&nbsp;
                        <a href="subir.php?com_id=<?php echo $row_com['com_id'];?>">
                            <img src="/img/subir.png" width="20" height="20" alt="Subir" title="Subir">
                        </a>
                    <?php } 
					*/
					?>
	          	</td> 
             </tr>
            <?php }?>
      
     
 	    </table>
  </div>
    <center><input type="button" value="Volver a Diccionarios" class="boton-crear" onClick="document.location.href = 'index.php'">
    <!--&nbsp;<input type="button" value="Guardar Orden" class="boton-crear" onClick="">--></center>
</div>
<footer> </footer>
</body></html>


