<?php 
session_start();

include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");


?>
<script>alert("cambio de contraseña");</script>
<div id="content">
	<div class="form_ident">
    <form  id="identificacion" name="identificacion" action="cambio-pass-query.php" method="post">
	<center>
    <table width="300px">
    <tr>
    <td colspan="2" height="50px" align="center" style="padding:10px;">Introduzca usuario y contraseña</td></tr>
<tr>    <td valign="middle" style="border-bottom:solid #fff 1px; padding:5px;">Contraseña</td><td style="border-bottom:solid #fff 1px;"><input name="pass" type="password" id="pass" size="23"></td></tr>
<tr>    <td valign="middle" style="padding:5px;">Valida Contraseña</td><td><input name="pass-check" type="password" id="pass-check" size="23"></td></tr>
<tr>    <td colspan="2" align="center" style="padding:10px;"><input type="submit" value="Entrar" style="border:none; background-color:#35424a; color:#92c83e; cursor:pointer; font-size:16px;"></td></tr></table></center>
    </form>
    </ul>
</div>
<footer>
</footer>
</div>
</body>
</html>