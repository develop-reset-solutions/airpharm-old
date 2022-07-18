<?php session_start();
/*include("login/sesion_start.php");
*/include("../librerias/librerias.php");
include("../cabecera.php");

?>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
        <td colspan="5">Administración</td>
        </tr>
        </table>
      </form>
    </div>
  </div>
  <div class="tabla_apartados">
    <table width="100%" style="text-align:center;">
   	  <tr class="filas_subtotal">
        <td width="20%"><a href="unidades/">Unidades</a></td>
        <td width="20%"><a href="centros/">Centros</a></td>
        <td width="20%"><a href="usuarios/">Usuarios</a></td>
        <td width="20%"><a href="departamentos/">Departamentos</a></td>
        <td width="20%"><a href="objetivos_estrategicos/">Objetivos estratégicos</a></td>
      </tr>

 	    </table>
  </div>
</div>
<footer> </footer>
</body></html>