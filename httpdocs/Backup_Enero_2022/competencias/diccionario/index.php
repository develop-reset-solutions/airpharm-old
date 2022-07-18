<?php session_start();
include("../../login/sesion_start.php");
include("../../login/sesion_start_rrhh.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");

$conn=db_connect();
?>
<!--
<script language="javascript">
	function cambiar_dic_id(val){
		window.location="index.php?dic_id="+val;
		}
</script>-->
<?php 
//$dic_id=$_REQUEST['dic_id'];
/*
if($dic_id==""){ 
	$dic_id=1;
}
*/
$query="SELECT * FROM com_diccionarios WHERE dic_ano=".$_SESSION['ano'];

if($_POST['filtrar']){
	$dic_nombre=$_POST['dic_nombre'];
	$query.=" AND dic_nombre LIKE '%".utf8_decode($dic_nombre)."%'";
	
}elseif($_POST['reset']){
	$dic_nombre='';
	$query.="";
}
$query.=" ORDER BY dic_nombre ASC";

?>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
            <td colspan="6">Diccionarios</td>
              <tr>
             <td><a href="create.php" class="texto_10">Añadir nuevo</a>
            </td>
            <td><a href="duplicar_dic/index.php" class="texto_10">Duplicar</a>
            </td>
            <!--
            <?php 
                $query_com="SELECT * FROM com_competencias";
                $result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
            ?>
             <td>Competencias: 
             <select name="dic_id" onchange="cambiar_dic_id(this.value)">
             <?php while($row_com=mysql_fetch_array($result_com)){?>
                <option value="<?php echo $row_com['dic_id']?>" <?php if ($row_com['dic_id']==$dic_id){echo "selected";}?>><?php echo utf8_encode($row_com['dic_nombre'])?></option> 
            <?php }?>
            </select>
            </td>
            -->
              <td style="background-color:transparent; width:650px;">
              </td>
              <td class="texto_10"> DICCIONARIOS:
                  <input name="dic_nombre" type="text" class="texto_10" value="<?php echo $dic_nombre;?>"/>
              </td>
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
	    	
            <td width="90%">Diccionarios</td>
        	<td width="10%">Acción</td>
      </thead>
      <?php
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
   	    <td <?php if ($num_comp==$num_comp_com and $num_comp!=0){echo 'class="verde"';}?>><?php 
		if ($row['dic_cerrado']=='si'){
                  if ($_SESSION['usr_perfil']=='Director RRHH'){
                      ?>
                     <a href="abrir.php?dic_id=<?php echo $row['dic_id'];?>">
                     <img src="/img/cerrar.png" width="15" height="15" alt="Abrir" title="Abrir"></a>
                     <?php
                      }else{
                    ?> <img src="/img/cerrar.png" width="15" height="15"><?php }?>
             
              <?php }
			  echo utf8_encode($row['dic_nombre']);
		?></td>
		<?php /*if ($row['dic_cerrado']=="si"){?><img src="/img/cerrar.png" width="20" height="20"><?php }*/?></td>
        <td class="numerica">
        	<a href="show.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/ver.png" width="15" height="15" alt="Ver detalles" title="Ver detalles"></a>&nbsp;
	        <?php if ($row['dic_cerrado']=="no"){?>
                <a href="edit.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/editar.png" width="15" height="15" alt="Editar" title="Editar"></a>&nbsp;
                <?php if ($num_comp==$num_comp_com){?>
                    <a href="cerrar.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/cerrar.png" width="15" height="15" alt="Cerrar" title="Cerrar"></a>&nbsp;				
                <?php }?>
                <a href="duplicar_dic/delete.php?dic_id=<?php echo $row['dic_id'];?>"><img src="/img/borrar.png" width="15" height="15" alt="Borrar" title="Borrar"></a>&nbsp;
            <?php }?>
      </tr>
 <?php  }?>
 	    </table>
  </div>
    <!--<center><input type="button" value="Volver a Competencias" class="boton-crear" onClick="document.location.href = '../competencias/index.php'"></center>-->
</div>
<footer> </footer>
</body></html>