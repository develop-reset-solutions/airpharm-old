<?php
function do_html_head($title,$description)
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-15" />
<title><?php echo $title;?></title>
<meta name="description" content="<?php echo $description;?>" />
<link rel="stylesheet" href="/css/style.css" type="text/css"/>
<script language="JavaScript" src="/librerias/ConstructorXMLHttpRequest.js"></script>
<script language="JavaScript" src="/librerias/ClasePeticionAjax.js"></script>
<script language="JavaScript" src="/librerias/ClasePeticionAjaxHtml.js"></script>
<script language="JavaScript" src="/librerias/ClasePeticionAjaxImagen.js"></script>
<script language="JavaScript" src="/librerias/ClasePeticionAjaxJavascript.js"></script>
<script language="JavaScript" src="/librerias/jquery-1.5.1.min.js"></script>
<script language="JavaScript" src="/librerias/jquery.validate.min.js"></script>
<script language="JavaScript" src="/librerias/funciones.js"></script>
<script language="JavaScript" src="/librerias/calendario_dw.js"></script>

<?php
}

function do_html_header()
{
?>
<div id="contenedor">
<img src="/img/fondo_vacio.jpg" height="800" width="1250" />
<div id="logo"><img src="/img/logo.png" width="314" height="108"></div>
<div id="iconos">
<form action="/login/cerrar_sesion.php" method="post" enctype="multipart/form-data" name="form01" target="_self" >
<input name="Inicio" type="submit" value="Inicio" />&nbsp;&nbsp;<input name="Salir" type="submit" value="Salir" />
</form>
</div>
<div id="menu">
<?php if ($_SESSION["tipo"]=="Administrador"){?><a href="/Configuracion/Configuracion.php">Administraci&oacute;n</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/Usuarios/Usuarios.php">Usuarios</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php }?><a href="/Clientes_ofe/Clientes.php">Clientes Of.</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/Ofertas/Ofertas.php">Ofertas</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/Clientes/Clientes.php">Clientes</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if ($_SESSION["tipo"] != "Comercial" and $_SESSION["tipo"] != "Telemarketing"){?><a href="/Proyectos/Proyectos.php">Proyectos</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php }if ($_SESSION["tipo"] != "Comercial" and $_SESSION["tipo"] != "Financiero"){?><a href="/Horas/Horas.php">Horas</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  }?><a href="/Gastos/Gastos.php">Gastos</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/informes/Informes.php">Informes</a></div>
<?php
}
function do_html_footer()
{
?>
<div id="pie">
&nbsp;&nbsp;&nbsp;<a href="http://www.resetsoluciones.com" target="_blank">Desarrollado por Reset Soluciones</a>Soy <?php echo $_SESSION["name"];?> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</body>
</html>
<?php
}
?>