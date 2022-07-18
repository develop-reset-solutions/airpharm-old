<?php session_start();
include("../../login/sesion_start.php");
include("../../login/sesion_start_rrhh.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();?>
<link href="../../css/style.css" rel="stylesheet" type="text/css">

  <div class="tabla_dpo">
    <table width="100%">
        <form action="modify.php" method="post" enctype="multipart/form-data">
      <!--<tr class="titulo_grupo">-->
      <tr class="filas_subtotal_inv">
          <td class="celdas_subtotal_inv"width="60%"><input name="dic_nombre" type="text" class="texto_10" value="Diccionario"/></td>
          <td class="celdas_subtotal_inv"width="10%">Diccionarios</td>
          <td class="celdas_subtotal_inv"width="30%" colspan="4">comportamientos</td>
        
      </tr>
		<!--<tr class="titulo_grupo">-->
       <tr class="filas_subtotal_inv">
          <td class="celdas_subtotal_inv" colspan="2"></td>
          <td class="celdas_subtotal_inv">1</td>
          <td class="celdas_subtotal_inv">2</td>
          <td class="celdas_subtotal_inv">3</td>
          <td class="celdas_subtotal_inv">4</td>
         
      </tr>
      
      
      <tr class="titulo_grupo">
       
        <td  colspan="10" style="text-align:left;"><input name="dic_competencia" type="text" class="texto_10" value="Competencia"/></td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"><input name="dic_actitud" type="text" class="texto_10" value="Actitud"/></td>
        <td class="celdas_subtotal">Grado A</td>
        <td class="celdas_subtotal"><input name="dic_comportamiento1" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento2" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento3" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento4" type="text" class="texto_3" /></td>
        
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"><input name="dic_actitud" type="text" class="texto_10" value="Actitud"/></td>
        <td class="celdas_subtotal">Grado b</td>
        <td class="celdas_subtotal"><input name="dic_comportamiento1" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento2" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento3" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento4" type="text" class="texto_3" /></td>
        
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"><input name="dic_actitud" type="text" class="texto_10" value="Actitud"/></td>
        <td class="celdas_subtotal">Grado c</td>
        <td class="celdas_subtotal"><input name="dic_comportamiento1" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento2" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento3" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento4" type="text" class="texto_3" /></td>
        
      </tr>
       <tr class="titulo_grupo">
       
        <td  colspan="10" style="text-align:left;"><input name="dic_competencia" type="text" class="texto_10" value="Competencia"/></td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"><input name="dic_actitud" type="text" class="texto_10" value="Actitud"/></td>
        <td class="celdas_subtotal">Grado A</td>
        <td class="celdas_subtotal"><input name="dic_comportamiento1" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento2" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento3" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento4" type="text" class="texto_3" /></td>
        
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"><input name="dic_actitud" type="text" class="texto_10" value="Actitud"/></td>
        <td class="celdas_subtotal">Grado b</td>
        <td class="celdas_subtotal"><input name="dic_comportamiento1" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento2" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento3" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento4" type="text" class="texto_3" /></td>
        
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"><input name="dic_actitud" type="text" class="texto_10" value="Actitud"/></td>
        <td class="celdas_subtotal">Grado c</td>
        <td class="celdas_subtotal"><input name="dic_comportamiento1" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento2" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento3" type="text" class="texto_3" /></td>
        <td class="celdas_subtotal"><input name="dic_comportamiento4" type="text" class="texto_3" /></td>
        
      </tr>
      <tr>
        <td colspan="6" class="filas_subtotal" align="center">
          <input type="button" name="Guardar" id="Guardar" value="Guardar"/>
          &nbsp;
          &nbsp;
          <input type="submit" name="Guardar" id="Guardar" value="Guardar y seguir" />
          &nbsp;
          &nbsp;
          <input type="submit" value="Descartar cambios" /></td>
      </tr>
      </form>
    </table>
  </div>
</div>
<footer> </footer>
</body></html>