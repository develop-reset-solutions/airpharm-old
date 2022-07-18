<?php 

session_start();
include("login/sesion_start.php");
include("librerias/librerias.php");
include("cabecera_previa.php");
$conn=db_connect();

$query="SELECT usr_flogin FROM usuarios WHERE usr_id=".$_SESSION['usr_id'];
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
if($row["usr_flogin"] == 1){
	header('Location: http://airpharmdpo.com/administracion/usuarios/edit-pass.php');
}

$query="SELECT * FROM vusuarios WHERE usr_id=".$_SESSION['usr_id'];
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
$usr_acc_com=$row['usr_acc_com'];
$usr_acc_dpo=$row['usr_acc_dpo'];
if ($usr_acc_com==0 && $usr_acc_dpo==0){
	$_SESSION['acc_com']=0;
	$_SESSION['acc_dpo']=0;
	header("Location: login/error.php");
}
if ($usr_acc_com==1 && $usr_acc_dpo==0){
	$_SESSION['acc_com']=1;
	$_SESSION['acc_dpo']=0;
	header('Location: competencias/index.php');
}
if ($usr_acc_com==0 && $usr_acc_dpo==1){
	$_SESSION['acc_com']=0;
	$_SESSION['acc_dpo']=1;
	header('Location: home.php');
}
if ($usr_acc_com==1 && $usr_acc_dpo==1){
	$_SESSION['acc_com']=1;
	$_SESSION['acc_dpo']=1;
	?>
	<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div style="width:100%;">
        <center><table align="center">
            <tr>
                <td class="celda-home"><input type="button" class="boton-principal" value="DPO" onClick="document.location.href = 'home.php'"></td>
                <td class="celda-home"><input type="button" class="boton-principal" value="Competencias" onClick="document.location.href = 'competencias/index.php'"></td>
             </tr>
        </table></center>
  </div>
</div>
<?php
}
 

?>

<footer> 
</footer>
</body></html>