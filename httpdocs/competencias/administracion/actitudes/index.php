<?php session_start();
//session_start_rrhh();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");

$conn=db_connect();
?>
<script language="javascript">
	function cambiar_com_id(val){
		window.location="index.php?com_id="+val;
		}
</script>
<?php 
$com_id=$_REQUEST['com_id'];
if($com_id==""){ 
	$com_id=1;
}
$query="SELECT * FROM com_actitudes";


$query.=" WHERE act_com_id=".$com_id;
if($_POST['filtrar']){
	$act_nombre=$_POST['act_nombre'];
	$query.=" and act_nombre LIKE '%".utf8_decode($act_nombre)."%'";
	
}elseif($_POST['reset']){
	$act_nombre='';
	$query.="";
}

$query.=" ORDER BY act_id ASC";


?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
        <td colspan="6">Actitudes</td>
          <tr>
         <td><a href="create.php?com_id=<?php echo $com_id?>" class="texto_10">Añadir nueva</a>
        </td>
        <?php 
			$query_com="SELECT * FROM com_competencias";
			$result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
		?>
         <td>Competencias: 
         <select name="com_id" onchange="cambiar_com_id(this.value)">
         <?php while($row_com=mysql_fetch_array($result_com)){?>
		 	<option value="<?php echo $row_com['com_id']?>" <?php if ($row_com['com_id']==$com_id){echo "selected";}?>><?php echo utf8_encode($row_com['com_nombre'])?></option> 
  		<?php }?>
		</select>
        </td>
          <td style="background-color:transparent; width:200px;">
          </td>
            <td class="texto_10"> ACTITUDES:
              <input name="act_nombre" type="text" class="texto_10" value="<?php echo $act_nombre;?>"/></td>
            <td><input type="submit" name="filtrar" id="filtrar" value="Filtrar" class="texto_10"/></td>
            <td><input name="reset" type="submit" id="reset" value="Todas" class="texto_10" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  <div class="tabla_apartados">
    <table width="100%">
      <thead>
	    	<!--<td width="5%">Grado</td>
      		<td width="85%">Actitud</td>-->
            <td width="90%">Actitud</td>
        	<td width="10%">Acción</td>
      </thead>
      <?php
	  $result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	  while($row=mysql_fetch_array($result)){?>
   	  <tr class="filas_subtotal">
      	<!--<td><center>A<?php // falta programar esta parte echo utf8_encode($row['act_nombre']);?></center></td>-->
   	    <td><?php echo utf8_encode($row['act_nombre']);?></td>
        <td class="numerica">
        	<a href="show.php?act_id=<?php echo $row['act_id'];?>&com_id=<?php echo $com_id;?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;
            <a href="edit.php?act_id=<?php echo $row['act_id'];?>&com_id=<?php echo $com_id;?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;
            <a href="delete.php?act_id=<?php echo $row['act_id'];?>&com_id=<?php echo $com_id;?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a></td>
      </tr>
 <?php }?>
 	    </table>
  </div>
    <center><input type="button" value="Volver a Competencias" class="boton-crear" onClick="document.location.href = '../competencias/index.php'"></center>
</div>
<footer> </footer>
</body></html>