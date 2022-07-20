<?php
  session_start();
  include("../login/sesion_start.php");
  include("../librerias/librerias.php");
  include("../cabecera.php");
?>

<link href="/css/style.css" rel="stylesheet" type="text/css">
  <div id="content">

    <div style="width:100%;">
      <center><table align="center">
          <tr>
            <td class="celda-home"><input type="button" class="boton-principal" value="Replicar objetivos" onClick="document.location.href = '/dpo_creacion/replica_oa.php'"></td>
            <td class="celda-home"><input type="button" class="boton-principal" value="DPO" onClick="document.location.href = '/dpo_creacion'"></td>
          </tr>
          <tr></tr>
        </table>
      </center>
    </div>
    
    <div class="tabla_apartados"></div>
  </div>
<footer>
</footer>
</body></html>
