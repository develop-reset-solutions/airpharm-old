<?php 
session_start();
//include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera-competencias.php");
$conn=db_connect();?>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
          <td colspan="7">Competencias de  Socorro Salguero</td>
        </tr>
        <tr>
          <td class="texto_10"><select name="competencia">
              <option value="Flexibilidad y gestión del cambio">Flexibilidad y gestión del cambio</option>
              <option value="Autoaprendizaje">Autoaprendizaje</option>
              <option value="Comunicación">Comunicación</option>
              <option value="Autonomía y toma de decisiones">Autonomía y toma de decisiones</option>
              <option value="Delegación">Delegación</option>
              <option value="Dirección y desarrollo de personas">Dirección y desarrollo de personas</option>
              <option value="Compromiso y dedicación a la compañia">Compromiso y dedicación a la compañia</option>
              <option value="Dominio de uno mismo. Autoafirmación">Dominio de uno mismo. Autoafirmación.</option>
              <option value="Pensamiento analítico y atención al detalle">Pensamiento analítico y atención al detalle</option>
              <option value="Sensibilidad interpersonal">Sensibilidad interpersonal</option>
              <option value="Iniciativa e innovación">Iniciativa e innovación</option>
              <option value="Liderazgo">Liderazgo</option>
              <option value="Orientación al cliente">Orientación al cliente</option>
              <option value="Persuasión, influencia y negociación">Persuasión, influencia y negociación</option>
              <option value="Liderazgo">Liderazgo</option>
              <option value="Resistencia a la presión">Resistencia a la presión</option>
              <option value="Planificación y organización. Establecimiento de prioridades">Planificación y organización. Establecimiento de prioridades</option>
              <option value="Trabajo en equipo">Trabajo en equipo</option>
              <option value="Visión de negocio">Visión de negocio</option>
              <option value="Orientación a resultados">Orientación a resultados</option>
            </select></td>
          <td class="texto_10"><input type="button" class="texto_10" value="Cambiar competencia"></td>
          <td style="background-color:#999999; width:195px;"></td>
          <td class="texto_10"> Colaborador:
            <select name="dpo_usr_id" id="dpo_usr_id" class="texto_10">
              <option value="<?php echo $dpo_usr_id;?>"><?php echo utf8_encode($row['usr_apellidos'].", ".$row['usr_nombre']);?></option>
              <?php 
					$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 ORDER BY usr_apellidos, usr_nombre ASC";
					$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
					while($row_usr=mysql_fetch_array($result_usr)){
					?>
              <option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$dpo_usr_id){?><?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
              <?php }?>
            </select></td>
          <td><input type="submit" name="filtrar" id="filtrar" value="Filtrar" class="texto_10"/></td>
          <!--            <td><input name="reset" type="submit" id="reset" value="Resetear" class="texto_10" /></td>
--> </tr>
      
      </table>
      </form>
    </div>
  </div>
  <div class="tabla_dpo">
  <form action="modify.php" method="post" enctype="multipart/form-data">
    <table width="100%">
        
      
      <input type="hidden" name="dpo_id" value="<?php echo $row['dpo_id'];?>" />
      <tr>
        <td colspan="2" class="titulo"> ORIENTACIÓN A RESULTADOS </td>
      </tr>
      <tr>
        <td colspan="2" class="filas_subtotal" style="font-size: 15px; padding: 15px 10px;"> Capacidad para adaptarse a nuevas situaciones e impulsar cambios dentro de la Compañia. Incluye flexibilidad tanmto cognitiva (apertura a puntos de vista distintos del suyo) como social y de entorno(capacidad para adpatarse a diferentes tipos de equipos e interlocutores).</td>
      </tr>
      <tr class="filas_total"><td>Observaciones - Compromisos</td>
      <td>Puntuación</td>
      </tr>
      <tr class="filas_subtotal">
        <td><textarea style="height: 90px; resize: none; width: 980px;"></textarea></td>
        <td valign="top"><select>
            <option>A</option>
            <option>B</option>
            <option>C</option>
          </select></td>
      </tr>
      <tr class="titulo_grupo">
        <td colspan="2" style="text-align:left;"> Grado A. Diseña e implanta cambios estrategicos para Airfarm. </td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"> 1. Actua como agente de cambio dentro de la Organización </td>
        <td class="celdas_subtotal"><input type="text"></td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"> 2. Propone, dentro y fuera del equipo, nuevas estrategias o visiones, liderandolas y gestionándolas para que alcancen su viabilidad </td>
        <td class="celdas_subtotal"><input type="text"></td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"> 3. Ante nuevas oportunidades, analiza que la compañia está `reàrad para asumir nuevos retos y los impulsa </td>
        <td class="celdas_subtotal"><input type="text"></td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"> 4. Identifica y elimina las barreras que obstaculizan la implantación de las mejoras en la Organización. </td>
        <td class="celdas_subtotal"><input type="text"></td>
      </tr>
      <tr class="titulo_grupo">
        <td colspan="10" style="text-align:left;"> Grado B. Gestiona y promueve cambios en su area de actuacion. </td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"> 1. Actua como agente de cambio dentro de la Organización </td>
        <td class="celdas_subtotal"><input type="text"></td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"> 2. Propone, dentro y fuera del equipo, nuevas estrategias o visiones, liderandolas y gestionándolas para que alcancen su viabilidad </td>
        <td class="celdas_subtotal"><input type="text"></td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"> 3. Ante nuevas oportunidades, analiza que la compañia está `reàrad para asumir nuevos retos y los impulsa </td>
        <td class="celdas_subtotal"><input type="text"></td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"> 4. Identifica y elimina las barreras que obstaculizan la implantación de las mejoras en la Organización. </td>
        <td class="celdas_subtotal"><input type="text"></td>
      </tr>
      <tr class="titulo_grupo">
        <td colspan="10" style="text-align:left;"> Grado A. Diseña e implanta cambios estrategicos para Airfarm. </td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"> 1. Actua como agente de cambio dentro de la Organización </td>
        <td class="celdas_subtotal"><input type="text"></td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"> 2. Propone, dentro y fuera del equipo, nuevas estrategias o visiones, liderandolas y gestionándolas para que alcancen su viabilidad </td>
        <td class="celdas_subtotal"><input type="text"></td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"> 3. Ante nuevas oportunidades, analiza que la compañia está `reàrad para asumir nuevos retos y los impulsa </td>
        <td class="celdas_subtotal"><input type="text"></td>
      </tr>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"> 4. Identifica y elimina las barreras que obstaculizan la implantación de las mejoras en la Organización. </td>
        <td class="celdas_subtotal"><input type="text"></td>
      </tr>
      <tr>
        <td colspan="2" class="filas_subtotal" align="center">
          <input type="button" name="Guardar" id="Guardar" value="Guardar"/>
          &nbsp;
          &nbsp;
          <input type="submit" name="Guardar" id="Guardar" value="Guardar y seguir" />
          &nbsp;
          &nbsp;
          <input type="submit" value="Descartar cambios" /></td>
      </tr>
    </table>
    
    
    </form>
  </div>
</div>
<footer> </footer>
</body></html>