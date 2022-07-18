<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$usr_id=$_GET['usr_id'];
$query="SELECT * FROM vusuarios WHERE usr_id=".$usr_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="4" class="titulo negrita">VER USUARIO</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><?php echo utf8_encode($row['usr_nombre']);?></td>
        <td class="titulos_campos"> Apellidos: </td>
        <td><?php echo utf8_encode($row['usr_apellidos']);?></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre de usuario: </td>
        <td colspan="3"><?php echo utf8_encode($row['usr_login']);?></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Email: </td>
        <td><?php echo utf8_encode($row['usr_email']);?></td>
        <td class="titulos_campos"> DNI: </td>
        <td><?php echo utf8_encode($row['usr_dni']);?></td>
      </tr>
      <tr>
        <td class="titulos_campos">Superior jerárquico: </td>
        <td><?php echo utf8_encode($row['sj_nombre'].' '.$row['sj_apellidos']);?></td>
        <td class="titulos_campos">Categoría: </td>
        <td><?php echo utf8_encode($row['usr_categoria']);?></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Centro: </td>
        <td><?php echo utf8_encode($row['cen_nombre']);?>
        </td>
        <td class="titulos_campos"> Departamento: </td>
        <td><?php echo utf8_encode($row['dep_nombre']);?>
        </td>
      </tr>
      <tr>
        <td class="titulos_campos"> Perfil: </td>
        <td><?php echo utf8_encode($row['usr_perfil']);?>
        </td>
      <td class="titulos_campos">Baja:</td>
      <td><input type="checkbox" disabled="disabled" <?php if($row['usr_baja']){?>checked="checked"<?php }?> /></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Acceso: </td>
        <td colspan="3"><input type="checkbox" disabled="disabled" name="usr_acc_dpo" <?php if($row['usr_acc_dpo']==1){?> checked="checked"<?php }?>  >DPO<br/>
        <input type="checkbox" disabled="disabled" name="usr_acc_com" <?php if($row['usr_acc_com']==1){?> checked="checked"<?php }?> >Competencias
        </td>
      </tr>
       <?php 
            $query_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$usr_id." ORDER BY dic_ano DESC";
            $result_dic=mysql_query($query_dic) or die ("No se puede ejecutar la sentencia: ".$query_dic);
            $num_rows = mysql_num_rows($result_dic);
            if ($num_rows > 0){?>
      <tr>
        <td colspan="4" class="titulos_campos"> Diccionarios: </td>
        </td>
      </tr>
      <tr>
      <td colspan="4">
         <table width="100%">
             <thead>
                <td class="titulos_campos" width="10%">Año</td>
                <td class="titulos_campos" width="35%">Diccionario</td>
                <td class="titulos_campos" width="40%">Evaluador</td>
                <td class="titulos_campos" width="15%">Autoevaluable</td>
             </thead>
                <?php
                while($row_dic=mysql_fetch_array($result_dic)){
                    ?>
                    <tr>
                        <td>
                            <?php echo $row_dic['dic_ano'];?>
                        </td>
                        <td>
                            <?php echo $row_dic['dic_nombre'];?>
                        </td>
                        
                        <td>
                            <?php echo utf8_encode($row_dic['usr_apellidos']).", ".utf8_encode($row_dic['usr_nombre']);?>
                        </td>
                         <td>
                            <center><input type="checkbox" disabled="disabled" name="autoevaluable" <?php if($row_dic['du_autoevaluable']==1){echo  "checked=checked"; }?>  value="1" ></center>
                        </td>
                    </tr>
                    <?php
                }
         ?> 
         </table>
       
        </td>
      </tr>
			<?php
            }
       
         ?>
      <tr>
        <td colspan="4" align="center"><input type="button" value="Editar" class="boton-crear" onClick="document.location.href = 'edit.php?usr_id=<?php echo $usr_id;?>'">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
      </tr>
    </table>
</center>
  </div>
</div>
<footer> </footer>
</body></html>