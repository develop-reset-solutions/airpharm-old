<?php
session_start();
include("../librerias/librerias.php");
do_html_head();
?>
</head>

<body>
<?php do_html_header();?>
<div id="area_trabajo">
<center><table width="1000px" border="1">
	<tr>
		<td align="center" valign="middle">
			<table cellspacing="20">
            	<tr>
                	<td valign="middle" align="center">
        No tiene privilegios para acceder a esta p&aacute;gina.<br>
		Su intento de acceso ha sido rechazado<br>
p&oacute;ngase en contacto con su administrador <br>

<p>&nbsp;</p>
<p align="center"><a href="../index.php" target="_self">Volver</a></p>
                  	</td>
			  </tr>
			</table>
		</td>
	</tr>
</table>
</center>
</div>
<?php do_html_footer();?>