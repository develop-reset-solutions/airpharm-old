<?php 
session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$dpo_ano=$_SESSION['ano'];
$dpo_id=$_GET['dpo_id'];
$query="SELECT * FROM vdpo_cabeceras WHERE dpo_id=".$dpo_id;
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$dpo_id;
$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
while($row_lin=mysql_fetch_array($result_lin)){
	$peso[utf8_encode($row_lin['obj_tipo'])]+=$row_lin['dl_peso'];
	$peso['total']+=$row_lin['dl_peso'];
}
?>    
<script type="text/javascript">
    $(document).ready(function(){
        $(".campo-dpo").keyup(function(){
            var peso=$(this).val();
            $(this).find("[class=total]").html(peso);
            // calculamos el total de todos los grupos
            var total1=0;
            $(".tipo1").each(function(){
                total1=total1+parseFloat($(this).val());
            })
            $(".total1").html(total1);
            var total2=0;
            $(".tipo2").each(function(){
                total2=total2+parseFloat($(this).val());
            })
            $(".total2").html(total2);
            var total3=0;
            $(".tipo3").each(function(){
                total3=total3+parseFloat($(this).val());
            })
            $(".total3").html(total3);
            var total4=0;
            $(".tipo4").each(function(){
                total4=total4+parseFloat($(this).val());
            })
            $(".total4").html(total4);
            var total=0;
            $(".campo-dpo").each(function(){
                total=total+parseFloat($(this).val());
            })
            $(".total").html(total);
        });
    });
</script>


<link href="../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div class="cabecera_apartados">
  <div class="filtros">
    <form method="post" action="#">
      <table align="center" width="100%">
      <tr>
        <td colspan="7">Editar DPO de <?php echo utf8_encode($row['usr_nombre']." ".$row['usr_apellidos']);?> (<?php echo $dpo_ano;?>)</td>
      </tr>
    </form>
    </table>
  </div>
</div>
<div class="tabla_dpo">
<table width="100%">
<form action="modify_dpo.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="dpo_id" value="<?php echo $row['dpo_id'];?>" />
<?php
	   	$n_lin=1;
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND obj_tipo LIKE '".utf8_decode('Objetivo de compañia')."' ORDER BY dl_peso DESC, obj_descripcion ASC";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		if($num_lin){?>
<tr class="titulo_grupo">
  <td colspan="10" style="text-align:left;">A nivel de compañia</td>
  <td class="numerica"><span class="total1"><?php echo $peso['Objetivo de Compañía'];?></span> %</td>
</tr>
<tr class="titulo_dpo">
  <td></td>
  <td>OE</td>
  <td>Objetivo</td>
  <td>Cód. In.</td>
  <td>Indicador</td>
  <td>Meta</td>
  <td>Un.</td>
  <td class="titulo_grupo celdas_subtotal"></td>
  <td colspan="2">Horquilla</td>
  <td>P.</td>
</tr>
<?php while($row_lin=mysql_fetch_array($result_lin)){?>
<tr class="filas_subtotal">
  <td class="num_lin"><?php echo $n_lin; $n_lin++;?></td>
  <td class="celdas_subtotal"><?php 
					$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['ind_obj_id']." ORDER BY oe_codigo";
					$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		$num_ooe=mysql_num_rows($result_ooe);
		$n=1;
					while($row_ooe=mysql_fetch_array($result_ooe)){
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			echo $row_oe['oe_codigo'];
			if($n>0 and $n<$num_ooe){
				if($n==$num_ooe-1){
					echo "y";
				}else{
					echo ",";
				}
			}
			$n++;
					}?></td>
  <td class="celdas_subtotal"><?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
    <a href="/objetivos/show.php?obj_id=<?php echo $row_lin['ind_obj_id'];?>">
    <?php }?>
    <?php echo utf8_encode($row_lin['obj_descripcion']);?>
    <?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
    </a>
    <?php }?></td>
  <td class="celdas_subtotal"><?php echo utf8_encode($row_lin['ind_codigo']);?></td>
  <td class="celdas_subtotal"><?php if($row_lin['ind_responsable']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
    <a href="/medicion_objetivos/show.php?oa_id=<?php echo $row_lin['dl_oa_id'];?>">
    <?php }?>
    <?php echo utf8_encode($row_lin['ind_nombre']);?>
    <?php if($row_lin['ind_responsable']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
    </a>
    <?php }?></td>
  <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format($row_lin['oa_meta'],2,',','.');?></td>
  <td class="numerica celdas_subtotal"><?php echo utf8_encode($row_lin['ind_meta_un_abreviatura']);?></td>
  <td class="titulo_grupo"></td>
  <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_min'],2,',','.');?></td>
  <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_max'],2,',','.');?></td>
  <td class="numerica celdas_subtotal celdas_peso"><?php echo number_format($row_lin['dl_peso'],1,',','.');?><input type="hidden" class="campo-dpo tipo1" name="dl_peso_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_peso'];?>"></td>
  </tr>
  <?php }?>
<tr>
  <td colspan="11"></td>
</tr>
<?php 
 }
 		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND (obj_tipo LIKE '".utf8_decode('Para el Comité de Dirección')."' OR obj_tipo LIKE '".utf8_decode('Mandos Intermedios')."') ORDER BY dl_peso DESC, obj_descripcion ASC";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		if($num_lin){
		?>
<tr class="titulo_grupo">
  <td colspan="10" style="text-align:left;"><?php 
		if(utf8_encode($row['usr_categoria'])=='Dirección'){?>
    A nivel de comité de dirección
    <?php }else{?>
    A nivel de Mandos Intermedios
    <?php }?></td>
  <td class="numerica"><span class="total2"><?php echo $peso['Para el Comité de Dirección']+$peso['Mandos Intermedios'];?></span> %</td>
</tr>
<tr class="titulo_dpo">
  <td></td>
  <td>OE</td>
  <td>Objetivo</td>
  <td>Cód. In.</td>
  <td>Indicador</td>
  <td>Meta</td>
  <td>Un.</td>
  <td class="titulo_grupo celdas_subtotal"></td>
  <td colspan="2">Horquilla</td>
  <td>P.</td>
</tr>
<?php
		while($row_lin=mysql_fetch_array($result_lin)){?>
<tr class="filas_subtotal">
  <td class="num_lin"><?php echo $n_lin; $n_lin++;?></td>
  <td class="celdas_subtotal"><?php 
					$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['ind_obj_id']." ORDER BY oe_codigo";
					$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		$num_ooe=mysql_num_rows($result_ooe);
					$n=1;
					while($row_ooe=mysql_fetch_array($result_ooe)){
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			echo $row_oe['oe_codigo'];
			if($n>0 and $n<$num_ooe){
				if($n==$num_ooe-1){
					echo "y";
				}else{
					echo ",";
				}
			}
			$n++;
					}?></td>
  <td class="celdas_subtotal"><?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
    <a href="/objetivos/show.php?obj_id=<?php echo $row_lin['ind_obj_id'];?>">
    <?php }?>
    <?php echo utf8_encode($row_lin['obj_descripcion']);?>
    <?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
    </a>
    <?php }?></td>
  <td class="celdas_subtotal"><?php echo utf8_encode($row_lin['ind_codigo']);?></td>
  <td class="celdas_subtotal"><?php if($row_lin['ind_responsable']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
    <a href="/medicion_objetivos/show.php?oa_id=<?php echo $row_lin['dl_oa_id'];?>">
    <?php }?>
    <?php echo utf8_encode($row_lin['ind_nombre']);?>
    <?php if($row_lin['ind_responsable']==$_SESSION['usr_id']){?>
    </a>
    <?php }?></td>
  <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format($row_lin['oa_meta'],2,',','.');?></td>
  <td class="numerica celdas_subtotal"><?php echo utf8_encode($row_lin['ind_meta_un_abreviatura']);?></td>
  <td class="titulo_grupo"></td>
  <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_min'],2,',','.');?></td>
  <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_max'],2,',','.');?></td>
  <td class="numerica celdas_subtotal celdas_peso"><?php echo $row_lin['dl_peso'];?><input type="hidden" class="campo-dpo tipo2" name="dl_peso_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_peso'];?>"></td>
  </tr>
  <?php }?>
<tr>
  <td colspan="11"></td>
</tr>
<?php 
}
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND (obj_tipo LIKE '".utf8_decode('de departamento')."' OR obj_tipo LIKE '".utf8_decode('Proyectos')."') ORDER BY dl_peso DESC, obj_descripcion ASC";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		if($num_lin){
?>
<tr class="titulo_grupo">
  <td colspan="10" style="text-align:left;">A nivel Departamental</td>
  <td class="numerica"><span class="total3"><?php echo $peso['de departamento']+$peso['Proyectos'];?></span> %</td>
</tr>
<tr class="titulo_dpo">
  <td></td>
  <td>OE</td>
  <td>Objetivo</td>
  <td>Cód. In.</td>
  <td>Indicador</td>
  <td>Meta</td>
  <td>Un.</td>
  <td class="titulo_grupo celdas_subtotal"></td>
  <td colspan="2">Horquilla</td>
  <td>P.</td>
</tr>
<?php
		while($row_lin=mysql_fetch_array($result_lin)){?>
<tr class="filas_subtotal">
  <td class="num_lin"><?php echo $n_lin; $n_lin++;?></td>
  <td class="celdas_subtotal"><?php 
					$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['ind_obj_id']." ORDER BY oe_codigo";
					$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		$num_ooe=mysql_num_rows($result_ooe);
					$n=1;
					while($row_ooe=mysql_fetch_array($result_ooe)){
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			echo $row_oe['oe_codigo'];
			if($n>0 and $n<$num_ooe){
				if($n==$num_ooe-1){
					echo "y";
				}else{
					echo ",";
				}
			}
			$n++;
					}?></td>
  <td class="celdas_subtotal"><?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
    <a href="/objetivos/show.php?obj_id=<?php echo $row_lin['ind_obj_id'];?>">
    <?php }?>
    <?php echo utf8_encode($row_lin['obj_descripcion']);?>
    <?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
    </a>
    <?php }?></td>
  <td class="celdas_subtotal"><?php echo utf8_encode($row_lin['ind_codigo']);?></td>
  <td class="celdas_subtotal"><?php if($row_lin['ind_responsable']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
    <a href="/medicion_objetivos/show.php?oa_id=<?php echo $row_lin['dl_oa_id'];?>">
    <?php }?>
    <?php echo utf8_encode($row_lin['ind_nombre']);?>
    <?php if($row_lin['ind_responsable']==$_SESSION['usr_id']){?>
    </a>
    <?php }?></td>
  <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format($row_lin['oa_meta'],2,',','.');?></td>
  <td class="numerica celdas_subtotal"><?php echo utf8_encode($row_lin['ind_meta_un_abreviatura']);?></td>
  <td class="titulo_grupo"></td>
  <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_min'],2,',','.');?></td>
  <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_max'],2,',','.');?></td>
  <td class="numerica celdas_subtotal celdas_peso"><input class="campo-dpo tipo3" name="dl_peso_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_peso'];?>"></td>
</tr>
<?php }?>
<tr>
  <td colspan="11"></td>
</tr>
<?php  }
 		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND obj_tipo LIKE '".utf8_decode('Personal')."' ORDER BY dl_peso DESC, obj_descripcion ASC";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		if($num_lin){
?>
<tr class="titulo_grupo">
  <td colspan="10" style="text-align:left;">A nivel Personal</td>
  <td class="numerica"><span class="total4"><?php echo $peso['Personal'];?></span> %</td>
</tr>
<tr class="titulo_dpo">
  <td></td>
  <td>OE</td>
  <td>Objetivo</td>
  <td>Cód. In.</td>
  <td>Indicador</td>
  <td>Meta</td>
  <td>Un.</td>
  <td class="titulo_grupo celdas_subtotal"></td>
  <td colspan="2">Horquilla</td>
  <td>P.</td>
</tr>
<?php
		while($row_lin=mysql_fetch_array($result_lin)){?>
<tr class="filas_subtotal">
  <td class="num_lin"><?php echo $n_lin; $n_lin++;?></td>
  <td class="celdas_subtotal"><?php 
					$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['ind_obj_id']." ORDER BY oe_codigo";
					$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		$num_ooe=mysql_num_rows($result_ooe);
					$n=1;
					while($row_ooe=mysql_fetch_array($result_ooe)){
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			echo $row_oe['oe_codigo'];
			if($n>0 and $n<$num_ooe){
				if($n==$num_ooe-1){
					echo "y";
				}else{
					echo ",";
				}
			}
			$n++;
					}?></td>
  <td class="celdas_subtotal"><?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
    <a href="/objetivos/show.php?obj_id=<?php echo $row_lin['ind_obj_id'];?>">
    <?php }?>
    <?php echo utf8_encode($row_lin['obj_descripcion']);?>
    <?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
    </a>
    <?php }?></td>
  <td class="celdas_subtotal"><?php echo utf8_encode($row_lin['ind_codigo']);?></td>
  <td class="celdas_subtotal"><?php if($row_lin['ind_responsable']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH' ){?>
    <a href="/medicion_objetivos/show.php?oa_id=<?php echo $row_lin['dl_oa_id'];?>">
    <?php }?>
    <?php echo utf8_encode($row_lin['ind_nombre']);?>
    <?php if($row_lin['ind_responsable']==$_SESSION['usr_id']){?>
    </a>
    <?php }?></td>
  <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format($row_lin['oa_meta'],2,',','.');?></td>
  <td class="numerica celdas_subtotal"><?php echo utf8_encode($row_lin['ind_meta_un_abreviatura']);?></td>
  <td class="titulo_grupo"></td>
  <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_min'],2,',','.');?></td>
  <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_max'],2,',','.');?></td>
  <td class="numerica celdas_subtotal celdas_peso"><input class="campo-dpo tipo4" name="dl_peso_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_peso'];?>"></td>
</tr>
<?php }?>
<tr>
  <td colspan="11"></td>
</tr>
<?php }?>
<tr class="titulo_grupo">
  <td colspan="10" style="text-align:left;">TOTAL</td>
  <td class="numerica"><span class="total"><?php echo $peso['total'];?></span> %</td>
</tr>
<tr>
  <td colspan="11" class="filas_subtotal" align="center"><input type="submit" name="Guardar" id="Guardar" value="Guardar DPO" />
    &nbsp;&nbsp;
    <input type="submit" value="Descartar cambios" /></td>
</tr>
</div>
</div>
<footer> </footer>
</body>
</html>
