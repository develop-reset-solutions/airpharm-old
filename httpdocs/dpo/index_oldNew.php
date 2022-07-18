<?php 
session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$dpo_ano=$_SESSION['ano'];
if($_SESSION['usr_id']){
	$dpo_usr_id=$_SESSION['usr_id'];
}
if($_SESSION['usr_id']==129){
	$dpo_usr_id=64;
}
if($_SESSION['usr_perfil']=='Director General' or $_SESSION['usr_perfil']=='Administrador'){
	$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_ano=".$dpo_ano." ORDER BY dpo_usr_id ASC";
	$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
	$row_dpo=mysql_fetch_array($result_dpo);
	$dpo_usr_id=$row_dpo['dpo_usr_id'];
}


if($_GET['dpo_id']){
	$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_id=".$_GET['dpo_id'];
	$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
	$row_dpo=mysql_fetch_array($result_dpo);
	$dpo_usr_id=$row_dpo['dpo_usr_id'];
}



$valor_sim=$_POST['valor_sim'];
if($_POST['filtrar'] or $_POST['simular']){
	if($_POST['dpo_usr_id']){
		$dpo_usr_id=$_POST['dpo_usr_id'];
	}
}

echo "el identificador es: ".$dpo_usr_id;


$query="SELECT * FROM vdpo_cabeceras WHERE dpo_ano=".$dpo_ano." AND dpo_usr_id=".$dpo_usr_id;
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id'];
$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia1: ".$query_lin);
while($row_lin=mysql_fetch_array($result_lin)){
	$peso[utf8_encode($row_lin['obj_tipo'])]+=$row_lin['dl_peso'];
	$peso['total']+=$row_lin['dl_peso'];
}

$total_q1=0;
$total_q2=0;
$total_q3=0;
$total_q4=0;
$total_anual=0;
?>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
          <td colspan="7">DPO de <?php echo utf8_encode($row['usr_nombre']." ".$row['usr_apellidos']);?> (<?php echo $dpo_ano;?>)</td>
        <tr>
<!--          <td class="texto_10"><?php if($_SESSION['usr_perfil']=='Director RRHH'){?><input type="button" onClick="document.location.href = '../dpo_creacion/'" value="Crear DPO" class="texto_10" ><?php }?></td>
-->          <td class="texto_10"><input type="button" onClick="window.open('imprimir_dpo.php?dpo_id=<?php echo $row['dpo_id'];?>','_newtab')" value="Imprimir DPO" class="texto_10" ></td>
          <td class="texto_10"><input type="button" onClick="window.open('export-excel.php?dpo_id=<?php echo $row['dpo_id'];?>','_newtab')" value="Excel DPO" class="texto_10" ></td>
          <td class="texto_10"><input type="button" onClick="window.open('imprimir_dpo_consecucion.php?dpo_id=<?php echo $row['dpo_id'];?>&valor_sim=<?php echo $valor_sim;?>','_newtab')" value="Imprimir consecución" class="texto_10" ></td>
          <td class="texto_10">Valor:&nbsp;
            <input type="text" name="valor_sim" id="valor_sim" value="<?php echo $valor_sim;?>" class="texto_10" style="width:50px;">
            <input type="hidden" name="dpo_usr_id" id="dpo_usr_id" value="<?php echo $dpo_usr_id;?>">
            &nbsp;
            <input type="submit" name="simular" id="simular" value="Simular" class="texto_10"/></td>
          <td style="background-color:#999999; width:195px;"></td>
          <td class="texto_10"> Colaborador:
            <select name="dpo_usr_id" id="dpo_usr_id" class="texto_10">
              <?php 
				if($_SESSION['usr_perfil']=='Director General' or $_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH'){
					$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil='Usuario' OR usr_perfil='Director RRHH') ORDER BY usr_apellidos, usr_nombre ASC";
					$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
					while($row_usr=mysql_fetch_array($result_usr)){
						$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_usr_id=".$row_usr['usr_id']." AND dpo_ano=".$dpo_ano;
						$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
						$num_dpo=mysql_num_rows($result_dpo);
						if($num_dpo){
				
				
							
				?>
              <option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$dpo_usr_id){?> selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
              <?php 		}
					}
				}else{
					echo "NO entra como perfil direc. adm dir RRHH";
					$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil='Usuario' OR usr_perfil='Director RRHH') ORDER BY usr_apellidos, usr_nombre ASC";
					$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
					while($row_usr=mysql_fetch_array($result_usr)){
						if($row_usr['usr_id']==$_SESSION['usr_id']){?>
              <option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$dpo_usr_id){?> selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
              <?php }else{
						$es_superior=false;
						$superior=$row_usr['usr_superior_id'];
						if($superior==$_SESSION['usr_id']){
							$es_superior=true;
						}
						while($superior<>'130' and $es_superior==false and $superior<>''){
							$query_usr2="SELECT * FROM usuarios WHERE usr_id=".$superior;
							$result_usr2=mysql_query($query_usr2) or die ("No se puede ejecutar la sentencia: ".$query_usr2);
							$row_usr2=mysql_fetch_array($result_usr2);
							$superior=$row_usr2['usr_superior_id'];
							if($superior==$_SESSION['usr_id']){
								$es_superior=true;
							}
						}
						if($es_superior){
							$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_usr_id=".$row_usr['usr_id']." AND dpo_ano=".$dpo_ano;
							$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
							$num_dpo=mysql_num_rows($result_dpo);
							if($num_dpo){?>
              <option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$dpo_usr_id){?> selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
              <?php 			}
						}
					}}
                }?>
            </select></td>
               <td><input type="submit" name="filtrar" id="filtrar" value="Filtrar" class="texto_10"/></td>
          <!--            <td><input name="reset" type="submit" id="reset" value="Resetear" class="texto_10" /></td>
--> </tr>
      </form>
      </table>
    </div>
  </div>

<?php echo "fin";?>
