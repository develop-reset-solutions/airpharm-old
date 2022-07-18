<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$dep_id=$_GET['dep_id'];
$query="SELECT * FROM vdepartamentos WHERE dep_id=".$dep_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">VER DEPARTAMENTO</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><?php echo utf8_encode($row['dep_nombre']);?></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Director/a: </td>
        <td><?php echo utf8_encode($row['usr_apellidos'].", ".$row['usr_nombre']);?></td>
      </tr>
      <tr>
        <td colspan="2">
        	<table width="100%">
            	<tr>
                	<td colspan="2" align="center">
                		COLABORADORES
                	</td>
                </tr>
            	<?php $query_usr="SELECT * FROM usuarios WHERE usr_dep_id=".$dep_id." ORDER BY usr_apellidos ASC, usr_nombre ASC";
				$result_usr=mysql_query($query_usr) or die("No se puede ejecutar la sentencia: ".$query_usr);
				$n==0;
				while($row_usr=mysql_fetch_array($result_usr)){
                	if($n%2==0){?>
						<tr>
                    <?php }?>                   	
               		<td><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></td>
                	<?php if($n%2==1){?>
						</tr>
                    <?php }?>                   	
               <?php $n++;
			   }?>     
			</table>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="button" value="Editar" class="boton-crear" onClick="document.location.href = 'edit.php?dep_id=<?php echo $dep_id;?>'">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
      </tr>
    </table>
</center>
  </div>
</div>
<footer> </footer>
</body></html>