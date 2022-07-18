<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");

$conn=db_connect();
?>
<script language="javascript">
	function cambiar_act_id(val){
		window.location="index.php?act_id="+val;
		}
</script>
<?php 
$act_id=$_REQUEST['act_id'];
if($act_id==""){ 
	$act_id=0;
}
$query="SELECT * FROM com_comportamientos";


$query.=" WHERE comp_act_id=".$act_id;
if($_POST['filtrar']){
	$comp_nombre=$_POST['comp_nombre'];
	$query.=" and comp_nombre LIKE '%".utf8_decode($comp_nombre)."%'";
}elseif($_POST['reset']){
	$comp_nombre='';
	$query.="";
}

$query.=" ORDER BY comp_id ASC";


?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
        <td colspan="6">Comportamientos</td>
          <tr>
         <td><a href="create.php?act_id=<?php echo $act_id?>" class="texto_10">Añadir nuevo</a>
        </td>
        <?php 
			$query_act="SELECT * FROM com_actitudes";
			$result_act=mysql_query($query_act) or die ("No se puede ejecutar la sentencia: ".$query_act);
		?>
         <td>Actitudes: 
         <select class="select_normal" name="act_id" onchange="cambiar_act_id(this.value)">
         <!--<option value="0">Sin actitud, diccionario agrupado</option>-->
         <?php while($row_act=mysql_fetch_array($result_act)){?>
		 	<option value="<?php echo $row_act['act_id']?>" <?php if ($row_act['act_id']==$act_id){echo "selected";}?>><?php echo utf8_encode($row_act['act_nombre'])?></option> 
  		<?php }?>
		</select>
        </td>
          <td style="background-color:transparent; width:100px;">
          </td>
            <td class="texto_10"> COMPORTAMIENTOS:
              <input name="comp_nombre" type="text" class="texto_10" value="<?php echo $comp_nombre;?>"/></td>
            <td><input type="submit" name="filtrar" id="filtrar" value="Filtrar" class="texto_10"/></td>
            <td><input name="reset" type="submit" id="reset" value="Todos" class="texto_10" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  <div class="tabla_apartados">
    <table width="100%">
      <thead>
	    	<!--<td width="5%">Grado</td>
      		<td width="85%">Comportamiento</td>-->
            <td width="90%">Comportamiento</td>
        	<td width="10%">Acción</td>
      </thead>
      <?php
	  $result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	  while($row=mysql_fetch_array($result)){?>
   	  <tr class="filas_subtotal">
      	<!--<td><center>A<?php // falta programar esta parte echo utf8_encode($row['comp_nombre']);?></center></td>-->
   	    <td><?php echo utf8_encode($row['comp_nombre']);?></td>
        <td class="numerica">
        	<a href="show.php?comp_id=<?php echo $row['comp_id'];?>&act_id=<?php echo $act_id;?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;
            <a href="edit.php?comp_id=<?php echo $row['comp_id'];?>&act_id=<?php echo $act_id;?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;
            <a href="delete.php?comp_id=<?php echo $row['comp_id'];?>&act_id=<?php echo $act_id;?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a></td>
      </tr>
 <?php }?>
 	    </table>

  </div>
  <center><input type="button" value="Volver a Actitudes" class="boton-crear" onClick="document.location.href = '../actitudes/index.php'"></center>
</div>
<footer> </footer>
</body></html>