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
    <div class="logo"><table width="100%"><tr><td><a href="/competencias/index.php"><img src="/img/logo.png" width="219" height="58" alt="Airfarm" title="Airfarm"></a></td><td valign="middle" align="right" style="color:white;">Gestión Capital Humano</td></tr></table></div>
<?php if($archivo_actual<>"/index.php/"){?>
	    <div >
        
        <ul>
          
         <li><a href="/login/cerrar_sesion.php">Salir</a></li>
     </ul>
	</div>
    <?php }?>
</header>
