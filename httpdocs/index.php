<?php include("cabecera-index.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting( E_ALL );

?>
<div id="content">
	<div class="form_ident">
    <form  id="identificacion" name="identificacion" action="/login/check_login.php" method="post">
	<center>
    <table width="300px">
    <tr>
    <td colspan="2" height="50px" align="center" style="padding:10px;">Introduzca usuario y contraseña</td></tr>
<tr>    <td valign="middle" style="border-bottom:solid #fff 1px; padding:5px;">Usuario</td><td style="border-bottom:solid #fff 1px;"><input name="login" type="text" id="login" size="24"></td></tr>
<tr>    <td valign="middle" style="padding:5px;">Contraseña</td><td><input name="pass" type="password" id="pass" size="23"></td></tr>
<tr>    <td colspan="2" align="center" style="padding:10px;"><input type="submit" value="Entrar" style="border:none; background-color:#35424a; color:#92c83e; cursor:pointer; font-size:16px;"></td></tr></table></center>
    </form>
    </ul>
</div>
<footer>
</footer>
</div>
</body>
</html>
