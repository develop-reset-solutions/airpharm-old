<?php 
session_start();
require("../../librerias/phpmailer/class.phpmailer.php");
require("../../librerias/phpmailer/class.smtp.php");
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$usr_nombre=mysql_real_escape_string($_POST['usr_nombre']);
$usr_apellidos=mysql_real_escape_string($_POST['usr_apellidos']);
$usr_login=mysql_real_escape_string($_POST['usr_login']);
$usr_email=mysql_real_escape_string($_POST['usr_email']);
$usr_dni=mysql_real_escape_string($_POST['usr_dni']);
$usr_perfil=mysql_real_escape_string($_POST['usr_perfil']);
$usr_categoria=mysql_real_escape_string($_POST['usr_categoria']);
$usr_dep_id=$_POST['usr_dep_id'];
$usr_cen_id=$_POST['usr_cen_id'];
$usr_superior_id=$_POST['usr_superior_id'];
$usr_passmail = $_POST['usr_password']; //contraseña que se envia al usuario 
$usr_password = md5($_POST['usr_password']);
$usr_acc_dpo=$_POST['usr_acc_dpo'];
$usr_acc_com=$_POST['usr_acc_com'];

$query="INSERT INTO usuarios (usr_nombre, usr_apellidos, usr_cen_id, usr_dep_id, usr_dni, usr_email, usr_password, usr_perfil, usr_superior_id, usr_categoria, usr_login, usr_acc_dpo, usr_acc_com) VALUES ('".utf8_decode($usr_nombre)."', '".utf8_decode($usr_apellidos)."', '".$usr_cen_id."', '".$usr_dep_id."', '".utf8_decode($usr_dni)."', '".utf8_decode($usr_email)."', '".$usr_password."', '".$usr_perfil."', '".$usr_superior_id."', '".utf8_decode($usr_categoria)."', '".utf8_decode($usr_login)."', '".$usr_acc_dpo."', '".$usr_acc_com."')";
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
 

if($result){
	
	 $mail = new PHPMailer(true);
	 try {
		$mail->SMTPDebug = 2;
		$mail->Host       = '10.2.0.7';  
		$mail->SMTPAuth   = false;                                
		$mail->Port       = 25;  
		$mail->CharSet = 'UTF-8';                                  
	
		//Recipients
		$mail->setFrom('dpo-no-reply@airpharmlogistics.com', 'dpo-no-reply');
		$mail->addAddress($usr_email);                
  
		// Content
		$mail->isHTML(true);                                 
		$mail->Subject = 'Password Airfarm';
		$mail->Body    = '<center><h3 style="margin:0;font-family:Helvetica, Arial;line-height:1.4;color:#3f526d;font-weight:500;font-size:20px;margin:20px 0px 15px;padding:0;">Bienvenido!</h3>
<div>
  <p style="max-width: 1000px;margin:0;padding:0;font-family:Helvetica, Arial;margin-bottom:10px;font-weight:300;color:#343641;font-size:15px;line-height:1.6;text-align: left;">
    Se ha generado una contraseña para ti, pero por motivos de seguridad, debes cambiarla. Para ello <a href="http://airpharmdpo.com" style=color:#2FB45A;font-size:17px;text-decoration:none;> inicia sesión </a> con tu correo electronico y la contraseña indicada al final y sigue los pasos que alli te indican.
  </p>
  <p style="max-width: 1000px;margin:0;padding:0;font-family:Helvetica, Arial;margin-bottom:10px;font-weight:300;color:#343641;font-size:15px;line-height:1.6;text-align: left;">Usuario: ' .$usr_login .'</p>
  <p style="max-width: 1000px;margin:0;padding:0;font-family:Helvetica, Arial;margin-bottom:10px;font-weight:300;color:#343641;font-size:15px;line-height:1.6;text-align: left;">Contraseña: ' .$usr_passmail .'</p>
</div>

</center>';

	
		$mail->send();
		echo 'Message has been sent';
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
	 
	
}



header('Location: index.php');
?>
