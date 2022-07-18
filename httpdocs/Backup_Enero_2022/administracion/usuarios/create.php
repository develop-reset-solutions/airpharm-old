<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$query_dep="SELECT * FROM departamentos ORDER BY dep_nombre ASC";
$result_dep=mysql_query($query_dep) or die ("No se puede ejecutar la sentencia: ".$query_dep);
$query_cen="SELECT * FROM centros ORDER BY cen_nombre ASC";
$result_cen=mysql_query($query_cen) or die ("No se puede ejecutar la sentencia: ".$query_cen);
$query_sup="SELECT * FROM usuarios ORDER BY usr_apellidos ASC, usr_nombre ASC";
$result_sup=mysql_query($query_sup) or die ("No se puede ejecutar la sentencia: ".$query_sup);
?>
<script language="javascript" type="text/javascript">
function validarPasswd(){
    var p1 = document.getElementById("usr_password").value;
    var p2 = document.getElementById("usr_password1").value;
    var espacios = false;
    var cont = 0;
    while (!espacios && (cont < p1.length)) {
	    if (p1.charAt(cont) == " ")
	  	espacios = true;
	    cont++;
    }
    if (espacios) {
    	alert ("La contraseña no puede contener espacios en blanco");
    	return false;
    }
    if (p1.length == 0 || p2.length == 0) {
	    alert("Los campos de la contraseña no pueden quedar vacios");
	    return false;
    }
    if (p1 != p2) {
	    alert("Las contraseñas deben de coincidir");
	    return false;
    } else {
	    return true;
    }
}
function foo() {
   alert("Se ha enviado un email al correo indicado.");  
   return true;
}
/*
function aparece_diccionario(){
	var val=document.getElementById("dic_ano_nuevo").value;
	
	$.ajax({
		url: "diccionario_ano.php",
		type: "POST",
		data:'ano='+val,
		success: function(data){			
			$("#diccionario_ano").html(data);
		}        
   	});
	
}
*/
</script>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="insert.php" method="post" onSubmit="return validarPasswd()" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="4" class="titulo negrita">ALTA USUARIO</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><input name="usr_nombre" type="text" class="campo-largo" required="required"></td>
        <td class="titulos_campos"> Apellidos: </td>
        <td><input name="usr_apellidos" type="text" class="campo-largo" required="required"></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre de usuario: </td>
        <td colspan="3"><input name="usr_login" type="text" class="campo-largo" required="required"></td>
      </tr>
       <tr>
        <td class="titulos_campos">Superior jerárquico: </td>
        <td><select name="usr_superior_id" class="campo-largo">
        <option value="">Ninguno</option>
        <?php while($row_sup=mysql_fetch_array($result_sup)){?>
        <option value="<?php echo $row_sup['usr_id'];?>"><?php echo utf8_encode($row_sup['usr_apellidos'].', '.$row_sup['usr_nombre']);?></option>
        <?php }?>
        </select>
        </td>
        <td class="titulos_campos"> Categoría: </td>
        <td><select name="usr_categoria" class="campo-largo">
        <option value="">Ninguna</option>
        <option value="Direccion">Dirección</option>
        <option value="Mando intermedio">Mando intermedio</option>
        <option value="Colaborador">Colaborador</option>
        </select>
        </td>
      </tr>
     <tr>
        <td class="titulos_campos"> Email: </td>
        <td><input name="usr_email" type="text" class="campo-largo" required="required"></td>
        <td class="titulos_campos"> DNI: </td>
        <td><input name="usr_dni" type="text" class="campo-corto" required="required"></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Centro: </td>
        <td><select name="usr_cen_id" class="campo-largo" required>
        <option value="">Seleccionar centro ...</option>
        <?php while($row_cen=mysql_fetch_array($result_cen)){?>
        <option value="<?php echo $row_cen['cen_id'];?>"><?php echo utf8_encode($row_cen['cen_nombre']);?></option>
        <?php }?>
        </select>
        </td>
        <td class="titulos_campos"> Departamento: </td>
        <td><select name="usr_dep_id" class="campo-largo" required>
        <option value="">Seleccionar departamento ...</option>
        <?php while($row_dep=mysql_fetch_array($result_dep)){?>
        <option value="<?php echo $row_dep['dep_id'];?>"><?php echo utf8_encode($row_dep['dep_nombre']);?></option>
        <?php }?>
        </select>
        </td>
      </tr>
      <tr>
      <td class="titulos_campos">Contraseña:</td>
      <td><input type="password" name="usr_password" id="usr_password" required="required" class="campo-largo"/></td>
      <td class="titulos_campos">Repetir contraseña:</td>
      <td><input type="password" name="usr_password1" id="usr_password1" required="required" class="campo-largo"/></td>
      <tr>
        <td class="titulos_campos"> Perfil: </td>
        <td colspan="3"><select name="usr_perfil" class="campo-largo" required>
        <option value="">Seleccionar perfil ...</option>
        <option value="Administrador">Administrador</option>
        <option value="Director General">Director General</option>
        <option value="Director RRHH">Director RRHH</option>
        <option value="Usuario">Usuario</option>
        </select>
        </td>
      </tr>
      
       <tr>
        <td class="titulos_campos"> Acceso: </td>
        <td colspan="3"><input type="checkbox" name="usr_acc_dpo" value="1">DPO<br/><input type="checkbox" name="usr_acc_com" value="1">Competencias
        </td>
      </tr>
      <!--
      
      
       <tr>
        <td colspan="4" class="titulos_campos"> Diccionarios: </td>

        </td>
      </tr>
      
      <tr>
        <td colspan="4">
            <table width="100%">
                <thead>
                    <td class="titulos_campos" width="20%">Año</td>
                    <td class="titulos_campos" width="40%">Diccionario</td>
                    <td class="titulos_campos" width="40%">Evaluador</td>

                </thead>
                <tr>
                    <td>
                    	
                        <select id="dic_ano_nuevo" name="dic_ano_nuevo" class="campo-largo" onchange="aparece_diccionario()">
                            <option value="" >Elige el año...</option>
                                <?php 
                                $i=$_SESSION['ano'];
                                $final= date('Y')+1;
                                while($i <= $final){?>
                            <option value="<?php echo $i;?>" ><?php echo $i;?></option>
                            <?php
                            $i++; 
                            }?>
                        </select>
                        
                    </td>
                    <td>
                    <div id="diccionario_ano" name="diccionario_ano">
                        <select name="dic_nombre_nuevo" class="campo-largo">
                            <option value="" >Elige el diccionario...</option>
                        </select>
                    </div>
                       
                    </td>
                    <td>
                    <?php 
					$query_usr="SELECT * FROM usuarios ORDER BY usr_apellidos";
					$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
					?>
					<select name="evaluador" class="campo-largo">
						<option value="" >Elige evaluador...</option>
						<?php while($row_usr=mysql_fetch_array($result_usr)){?>
						<option value="<?php echo $row_usr['usr_id'];?>" ><?php echo utf8_encode($row_usr['usr_apellidos']).", ".utf8_encode($row_usr['usr_nombre']);?>							
						</option>
						<?php }?>
					</select>
                        <?php echo $row_dic['du_responsable'];?>
                    </td>
                </tr>
            </table>
        </td>
      </tr>      
      -->
      <tr>
        <td colspan="4" align="center"><input type="submit" value="Crear" class="boton-crear" onclick="return foo();"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>