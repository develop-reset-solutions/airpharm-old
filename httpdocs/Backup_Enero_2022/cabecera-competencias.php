<?php $archivo_actual = $_SERVER["REQUEST_URI"];?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge; chrome=1" />
<title>Airfarm</title>
<meta name="description" content="Airfarm" />
<link rel="stylesheet" type="text/css" href="/css/style.css"/>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 <!--<script src="/librerias/jquery-1.10.0.min.js"></script>
<script src="/librerias/jqueryslidemenu.js"></script>
--></head>
<body>
<header>
    <div class="logo"><table width="100%"><tr><td><a href="/competencias/index.php"><img src="/img/logo.png" width="219" height="58" alt="Airfarm" title="Airfarm"></a></td><td valign="middle" align="right" style="color:white;">Evaluación Competencias</td></tr></table></div>
<?php if($archivo_actual<>"/index.php/"){?>
	    <div >
        
        <ul>
          <?php if($_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH'){?>
          <li><a href="/competencias/administracion/index.php">Administración</a></li>
          <li><a href="/competencias/informes/index.php">Informes</a></li>
          <li><a href="/competencias/diccionario/index.php">Diccionario</a></li>
          <li><a href="/competencias/evaluacion/index.php">Evaluación Competencial</a></li>
		  <?php //} if($_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH' or $_SESSION['usr_categoria']==utf8_decode('Dirección')){?>
          <!--<li><a href="/competencias/administracion/competencias">Competencias</a></li>
		  <li><a href="/competencias/administracion/actitudes">Actitudes</a></li>
          <li><a href="/competencias/administracion/comportamientos">Comportamientos</a></li>-->
		  <?php  }?>
         <!--<li><a href="/dpo">DPO</a></li>
         <li><a href="/objetivos">Objetivos</a></li>
         <li><a href="/medicion_objetivos">Indicadores</a></li> -->
 		 <?php if($_SESSION['usr_id']==115){?><li <?php if($_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH'){?>style="width:40 0px;"<?php }else{?>style="width:430px;"<?php }?>><a href="/competencias/administracion/usuarios/show-pass.php" style="color:#FFF;"><?php echo $_SESSION['usr_nombre']." ".$_SESSION['usr_apellidos'];?></a></li><li style="width:220px; text-align:right"><a href="/cambiar-perfil-com.php">Cambiar perfil (<?php echo $_SESSION['usr_perfil'];?>)</a></li><?php }else{?><li <?php if($_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH'){?>style="width:700px;"<?php }else{?>style="width:800px;"<?php }?>><a href="/competencias/administracion/usuarios/show-pass.php" style="color:#FFF;"><?php echo $_SESSION['usr_nombre']." ".$_SESSION['usr_apellidos'];?></a></li><?php }?>

         <li><a href="/cambiar_ano_com.php">Año: <?php echo $_SESSION['ano'];?></a></li> 
         <li><a href="/competencias/index.php">Home</a></li>
         <li><a href="/login/cerrar_sesion.php">Salir</a></li>
         <?php 
		 if ($_SESSION['acc_dpo']==1){
			 ?>
             <li><a href="/home.php">DPO</a></li>
             <?php
			 }
		 ?>
     </ul>
	</div>
    <?php }?>
</header>
