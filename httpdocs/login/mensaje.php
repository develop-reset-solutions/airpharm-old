<?php
   require_once('variables.php'); 
   $texto=$_GET[Texto];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<title>Gesti&oacute;n de Siniestros</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<style type="text/css">
<!--

#Layer1 {
	position:absolute;
	left:50%;
	top:27px;
	width:1024px;
	height:768px;
	z-index:1;
	margin-left: -510px;
}
#Layer2 {
	position:absolute;
	top:371px;
	width:488px;
	z-index:2;
	left: 282px;
	height: 178px;
}
-->
</style>

<link href="../css/forms2.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
#Layer3 {
	position:absolute;
	left:20px;
	top:214px;
	width:990px;
	height:29px;
	z-index:2;
}
.Estilo1 {
	font-size: 12pt;
	font-weight: bold;
	color:#0D2160;
}
.Estilo2 {color: #0D2160}
.style1 {
	font-size: 10pt;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<div id="Todo">
<div id="SombraIzda"><img src="../img/SombraIzquierda.png" width="24" height="768" /></div>
<div id="SombraDcha"><img src="../img/SombraDerecha.png" width="24" height="768" /></div>
<div id="Layer1">
<img src="/img/fondo_nada.png" width="1024" height="768" border="0" usemap="#Map" />

<div class="Estilo1" id="Layer3">
  <div align="center" class="Estilo2">Sistema de Gesti&oacute;n de Siniestros </div>
</div>
</div>
<div id="LayerNew">

<p align="center" class="Estilo1"><?php echo "$texto"; ?></p>
<p align="center" class="Estilo1"><a href="<?php echo "$pagina_principal"; ?>" target="_self">Volver</a></p>
</div>
</div>
</div>

</body>
</html>
