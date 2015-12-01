<?php
include_once "../db.php";
// Con esta sentencia SQL obtendremos el ID_WBS.

$consulta1="select * from activity";
//$consulta2="select sum(cost) from activity where id_wbs=12 or parent_id=12";
$consulta3="CALL calculo_saldo(12)";
//ejecutamos la consulta.
$execute1=mysql_query($consulta1);
//$execute2=mysql_query($consulta2);
$execute3=  mysql_query($consulta3);
while($row1 = mysql_fetch_array($execute1)) {
   echo "id_wbs=".$row1['id_wbs']." ";
   $idwbs= $row1['id_wbs'];
   $consulta2="select sum(cost) from activity where id_wbs=$idwbs or parent_id=$idwbs";
   $execute2=mysql_query($consulta2);
    while($row3 = mysql_fetch_array($execute2)){ 
        echo $row3['sum(cost)']." "; 
       
    } 

}
//cerramos la conexion.
mysql_close($con);
?>
