<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$usr_id=$_SESSION['usr_id'];
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
        <td colspan="4" align="center"><input type="button" value="Cambiar contraseña" class="boton-crear" onClick="document.location.href = 'edit-pass.php'">&nbsp;<input type="button" value="Volver" class="boton-crear" onClick="document.location.href = '../../home.php'"></td>
      </tr>
    </table>
</center>
  </div>
</div>
<footer> </footer>
</body></html>