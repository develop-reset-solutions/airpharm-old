<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$usr_id=$_POST['usr_id'];
$usr_nombre=mysql_real_escape_string($_POST['usr_nombre']);
$usr_apellidos=mysql_real_escape_string($_POST['usr_apellidos']);
$usr_login=mysql_real_escape_string($_POST['usr_login']);
$usr_email=mysql_real_escape_string($_POST['usr_email']);
$usr_dni=mysql_real_escape_string($_POST['usr_dni']);
$usr_perfil=mysql_real_escape_string($_POST['usr_perfil']);
$usr_categoria=mysql_real_escape_string($_POST['usr_categoria']);
$usr_dep_id=$_POST['usr_dep_id'];
$usr_cen_id=$_POST['usr_cen_id'];
$usr_baja=$_POST['usr_baja'];
$usr_superior_id=$_POST['usr_superior_id'];
$usr_password_n=$_POST['usr_password'];
$usr_password = md5($_POST['usr_password']);
$usr_acc_dpo=$_POST['usr_acc_dpo'];
$usr_acc_com=$_POST['usr_acc_com'];


$query="UPDATE usuarios SET usr_nombre='".utf8_decode($usr_nombre)."', usr_apellidos='".utf8_decode($usr_apellidos)."', usr_login='".utf8_decode($usr_login)."', usr_cen_id='".$usr_cen_id."', usr_dep_id='".$usr_dep_id."', usr_dni='".utf8_decode($usr_dni)."', usr_email='".utf8_decode($usr_email)."', usr_categoria='".utf8_decode($usr_categoria)."', usr_superior_id='".$usr_superior_id."', usr_acc_dpo='".$usr_acc_dpo."', usr_acc_com='".$usr_acc_com."'";
if($usr_password_n<>'*****'){
	$query.=", usr_password='".$usr_password."'";
}
$query.=", usr_perfil='".$usr_perfil."', usr_baja='".$usr_baja."' WHERE usr_id=".$usr_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);

$dic_ano_nuevo=$_REQUEST['dic_ano_nuevo'];
$dic_id= $_REQUEST['dic_nombre_nuevo'];
$evaluador= $_REQUEST['evaluador'];
if ($_REQUEST['autoevaluable']==1){
	$autoevaluable= $_REQUEST['autoevaluable'];
} else {
	$autoevaluable=0;
}
if ($dic_ano_nuevo!=""){
	$query_dic_usr="SELECT * FROM vcom_diccionarios_usuarios WHERE dic_ano=".$dic_ano_nuevo." AND du_usr_id=".$usr_id;
	$result_dic_usr=mysql_query($query_dic_usr) or die ("No se puede ejecutar la sentencia: ".$query_dic_usr);
	$rows_dic_usr=mysql_fetch_array($result_dic_usr);
	$num_rows_dic_usr = mysql_num_rows($result_dic_usr);
	if ($num_rows_dic_usr > 0){
		$query_update="UPDATE com_diccionarios_usuarios SET du_responsable='".$evaluador."', du_autoevaluable='".$autoevaluable."', du_dic_id=".$dic_id." 
		WHERE du_id=".$rows_dic_usr['du_id']." AND du_usr_id=".$usr_id;
		$result_update=mysql_query($query_update) or die ("No se puede ejecutar la sentencia: ".$query_update);
	} else {
		$query_insert="INSERT INTO com_diccionarios_usuarios (du_dic_id, du_usr_id, du_responsable, du_autoevaluable) VALUES (".$dic_id.", ".$usr_id.", ".$evaluador.", ".$autoevaluable.")";
		$result_update=mysql_query($query_insert) or die ("No se puede ejecutar la sentencia: ".$query_insert);
		//Tambien se crea la tabla com_dic_usr_com y com_dic_usr_comp.
		
		$query_du ="SELECT * FROM com_diccionarios_usuarios WHERE du_dic_id=".$dic_id." AND du_usr_id=".$usr_id." AND du_responsable=".$evaluador." AND du_autoevaluable=".$autoevaluable;
		$result_cd=mysql_query($query_du) or die("No se puede ejecutar la sentencia: ".$query_du);
		$row_du=mysql_fetch_array($result_cd);
		$du_id=$row_du['du_id'];
		
		//tabla com_dic_usr_com 

		$query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id;
		$result_com_dic=mysql_query($query_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_com_dic);
		while($row_com_dic=mysql_fetch_array($result_com_dic)){
			
			$query_i_duc="INSERT INTO com_dic_usr_com (duc_du_id, duc_com_id) VALUES (".$du_id.", ".$row_com_dic['cd_com_id'].")";
			$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);
		
		//tabla com_dic_usr_comp

			$query_com_dic2="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." and cd_com_id=".$row_com_dic['cd_com_id']." order by cd_orden";
			$result_com_dic2=mysql_query($query_com_dic2) or die ("No se puede ejecutar la sentencia: ".$query_com_dic2);
			$row_com_dic2=mysql_fetch_array($result_com_dic2);

			$query_act_com_dic="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$row_com_dic2['cd_id'];
			$result_act_com_dic=mysql_query($query_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_act_com_dic);
			
			

			
			while($row_act_com_dic=mysql_fetch_array($result_act_com_dic)){
				/*
				$query_act="SELECT * FROM com_actitudes WHERE act_id=".$row_act_com_dic['acd_act_id'];
				$result_act=mysql_query($query_act) or die ("No se puede ejecutar la sentencia: ".$query_act);
				$row_act=mysql_fetch_array($result_act);
				 */
				$query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_act_com_dic['acd_id'];
				$result_comp_act_com_dic=mysql_query($query_comp_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_comp_act_com_dic);
				
				
				
				while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
					/*
					$query_comp="SELECT * FROM com_comportamientos WHERE comp_id=".$row_comp_act_com_dic['cacd_comp_id'];
					$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
					$row_comp=mysql_fetch_array($result_comp);
						*/		
								
					$query_comport="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$row_comp_act_com_dic['cacd_comp_id']." AND ducp_du_id=". $du_id;
					$result_comport=mysql_query($query_comport) or die ("No se puede ejecutar la sentencia: ".$query_comport);
					$row_comport=mysql_fetch_array($result_comport);
					
					$query_i_ducp="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id) VALUES (".$du_id.", ".$row_comp_act_com_dic['cacd_comp_id'].")";
					$result=mysql_query($query_i_ducp) or die("No se puede ejecutar la sentencia: ".$query_i_ducp);	
					 }		
			}
		}		
		
		/*
		$query_com_dic_com="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." and cd_com_id=".$row_com_dic['cd_com_id'];
		$result_com_dic_com=mysql_query($query_com_dic_com) or die ("No se puede ejecutar la sentencia: ".$query_com_dic_com);
		//$row_com_dic=mysql_fetch_array($result_com_dic);
		while($row_com_dic_com=mysql_fetch_array($result_com_dic_com)){
		// hasta aqui bien.	
		echo "row_com_dic_com['cd_id']: ".$row_com_dic_com['cd_id'];
		$query_act_com_dic="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$row_com_dic_com['cd_id'];
		$result_act_com_dic=mysql_query($query_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_act_com_dic);
		
		//$num_row_act_com_dic = mysql_num_rows($result_act_com_dic);

		
			while($row_act_com_dic=mysql_fetch_array($result_act_com_dic)){
				echo "row_act_com_dic['acd_id']: ".$row_act_com_dic['acd_id'];
				$query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_act_com_dic['acd_id'];
				$result_comp_act_com_dic=mysql_query($query_comp_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_comp_act_com_dic);
				
				while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
					//$query_comp="SELECT * FROM com_comportamientos WHERE comp_id=".$row_comp_act_com_dic['cacd_comp_id'];
					//$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
					//$row_comp=mysql_fetch_array($result_comp);
					//$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id) VALUES (".$du_id.", ".$row_comp['cacd_comp_id'].")";
					echo "row_comp_act_com_dic['cacd_comp_id']: ".$row_comp_act_com_dic['cacd_comp_id'];
					//Poner los inserts luego
					//$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id) VALUES (".$du_id.", ".$row_comp_act_com_dic['cacd_comp_id'].")";
					//$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
				
				}
			}
		}
		*/
		/*
		INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id) VALUES (27, )
		?>
		<!-- variable comp_id_<?php echo $j;?>_<?php echo $i;?>  (j de 1 a 3) y (i de 1 a 4)-->
        <?php
        $i = 1;
		while ($i <= 10) {
    		echo $i++; 
		}
		$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id, ducp_evaluacion ) VALUES (".$du_id.", ".$comp_id_1_1.", '".$comp_1_1."')";
		$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);
		*/
	}
}
header('Location: index.php');
?>