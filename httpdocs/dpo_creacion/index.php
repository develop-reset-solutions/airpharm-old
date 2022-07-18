<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<script language="javascript">

function alerta( ano ){
	var select1 = document.getElementById('usr_id');
	//var combo = document.getElementById("producto");
	var selected = select1.options[select1.selectedIndex].text;
    //var selectedOption = this.options[select1.selectedIndex];

	//var usr_id = this.options[select.usr_id];

   //var usr_id = document.getElementById("usr_id").value;
   if (confirm("Los datos del usuario "+selected+" del año "+ano+" si existen seran eliminados.")){
       document.form_index.submit()
    }

}

/*
function alerta(ano){
	usr_id= document.getElementById("usr_id").value;
	//ano= document.getElementById("usr_id").value;
	alert("Los datos del usuario "+usr_id+" del año "+ano+" si existen seran eliminados.")
	}*/
	/*
$(document).ready(function () {


    $("#guardar").click(function (){
        if( $("#nombre").val() == "" ){
            alert("Tienes que introducir el nombre .");
            return false;
		}else if( $("#primer_apellido").val() == "" ){
            alert("Tienes que introducir primer apellido.");
            return false;
		}else if( $("#fecha_nacimiento").val() == "" || !isValidDate($("#fecha_nacimiento").val())  ){
            alert("Tienes que introducir la fecha de nacimiento correctamente.");
            return false;

		}else if( $("#num_doc").val() == "" ){
            alert("Tienes que introducir el número del documento.");
            return false;
		}else if( $("#genero").val() == "" ){
            alert("Tienes que seleccionar el género.");
            return false;
		}else if( $("#mail").val() == "" || !emailreg.test($("#mail").val()) ){
            alert("Se tiene que indicar un email correcto.");
            return false;
		}else if( $("#movil").val() == "" ){
            alert("Tienes que introducir el teléfono móvil.");
            return false;
		}else if( $("#pais").val() == "" ){
            alert("Tienes que introducir el país.");
            return false;
		}else if( $("#provincia").val() == "" ){
            alert("Tienes que introducir la provincia.");
            return false;
		}else if( $("#poblacion").val() == ""){
            alert("Tienes que introducir la población.");
            return false;
		}else if( $("#cp").val() == "" ){
            alert("Tienes que introducir el código postal.");
            return false;
		}else if( $("#direccion").val() == "" ){
            alert("Tienes que introducir la dirección.");
            return false;
		}else if( $("#programa").val() == "" ){
            alert("Tienes que seleccionar un programa.");
            return false;

        }
    });
});*/
</script>
<div id="content">
<div style="width:100%;">
<center>   <form name="form_index" id="form_index" action="insert.php" method="post" style="text-align:-moz-center;">
   <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">CREAR NUEVA DPO</td>
      </tr>
      <tr>
        <td class="titulos_campos">Colaborador: </td>
        <td><select name="usr_id" id="usr_id" class="campo-largo" required>
        		<option value="">Seleccionar colaborador ...</option>
              <?php
				if($_SESSION['usr_perfil']=='Director General' or $_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH'){
					$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil='Usuario' OR usr_perfil='Director RRHH') ORDER BY usr_apellidos, usr_nombre ASC";
					$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
					while($row_usr=mysql_fetch_array($result_usr)){?>
              <option value="<?php echo $row_usr['usr_id'];?>"><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
              <?php
						}
				}else{
					$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil='Usuario' OR usr_perfil='Director RRHH') ORDER BY usr_apellidos, usr_nombre ASC";
					$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
					while($row_usr=mysql_fetch_array($result_usr)){
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
						if($es_superior){?>
              <option value="<?php echo $row_usr['usr_id'];?>"><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
              <?php
					}}
                }?>
            </select></td>
      </tr>
      <tr>
        <td class="titulos_campos">Plantilla: </td>
        <td><select name="dpo_id" class="campo-largo" required>
        		<option value="vacia">DPO vacia</option>
            	<?php $query_dpo="SELECT * FROM vdpo_cabeceras WHERE dpo_ano=".$_SESSION['ano']." ORDER BY usr_apellidos, usr_nombre ASC";
					$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
				while($row_dpo=mysql_fetch_array($result_dpo)){
?>
                	<option value="<?php echo $row_dpo['dpo_id'];?>"><?php echo utf8_encode($row_dpo['usr_apellidos'].", ".$row_dpo['usr_nombre']);?></option>      <?php }?>
            	<?php
				$anomenos=$_SESSION['ano']-1;
				$query_dpo="SELECT * FROM vdpo_cabeceras WHERE dpo_ano=".$anomenos." ORDER BY usr_apellidos, usr_nombre ASC";
					$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
				while($row_dpo=mysql_fetch_array($result_dpo)){ ?>

                	<option value="<?php echo $row_dpo['dpo_id']."_".$anomenos;?>"><?php echo utf8_encode($row_dpo['usr_apellidos'].", ".$row_dpo['usr_nombre'])." (".$anomenos.")";?></option>        <?php  }?>

        </select></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
       <!-- <input type="submit" value="Crear" class="boton-crear">&nbsp;-->
       <input type="button" value="Crear" class="boton-crear" onClick="alerta(<?php echo $_SESSION['ano'] ?>)">&nbsp;
        <input type="button" value="Volver" class="boton-crear" onClick="document.location.href = '/home.php'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>
