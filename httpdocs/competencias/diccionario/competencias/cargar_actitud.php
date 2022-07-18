<?php 
session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
//include("../../../cabecera-competencias.php");
$conn=db_connect();

$actitud=$_REQUEST['actitud'];
$j=$_REQUEST['j'];

$i = 0;
while ($i < 4){
	$i++;

?>
    <table>
        <tr>
            <td> <?php echo $i;?>. 
                <select class="select_largo" name="comp_<?php echo $j;?>_<?php echo $i;?>" id="comp_<?php echo $j;?>_<?php echo $i;?>" >
                    <?php 
                    $query_comp="SELECT * FROM com_comportamientos WHERE comp_act_id=".$actitud;
                    $result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
					$k=0;
                    while($row_comp=mysql_fetch_array($result_comp)){
						$k++;
                       ?>
                       <option value="<?php echo $row_comp['comp_id']?>"  <?php if ($i==$k){echo "selected";}?>><?php echo utf8_encode($row_comp['comp_nombre'])?></option> 
                    <?php }?>
                </select>
            </td>
        </tr>	
    </table>
<?php }?>