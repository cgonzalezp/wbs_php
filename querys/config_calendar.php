<?php
include ('users/seguridad.php');
session_start();
?>
<?php
include_once ('../db.php');
//OBTENEMOS EL ID DEL PROYECTO ACTIVO.
//include('current_project.php');
$Project_id_project=$_SESSION['id'];
//ALMACENAMOS EL VALOR DEL ID DEL PROYECTO ACTIVO EN LA VARIABLE $IDCALENDAR.
$idcalendar=$Project_id_project;
//ALMACENAMOS LOS DATOS OBTENIDOS DEL FORMULARIO EN LAS SIGUIENTES VARIABLES.
$startweek=$_POST['start_week'];
$startfiscalyear=$_POST['start_fiscalyear'];
$starthours=$_POST['start_hours'];
$endhours=$_POST['end_hours'];
$startworkdayhours=$_POST['start_workday_hours'];
$daysformonth=$_POST['days_for_month'];
$workweek=$_POST['workweek'];
$projectidproject=$Project_id_project;

//SELECIONAMOS TODO DE NUESTRA TABLA CALENDAR MIENTRAS EL ID_CALENDAR SEA IGUAL A NUESTRA VARIABLE $ID_CALENDAR.
$execute=mysql_query("SELECT * FROM calendar WHERE id_calendar=".$idcalendar."");
$row=mysql_fetch_assoc($execute);

//VERIFICAMOS QUE NO ESTE VACIO, SI LO ESTA LO INSERTAMOS EN LA TABLA, SINO SOLO LA MODIFICAMOS.
if($row['id_calendar']==""){
	mysql_query ("INSERT INTO calendar (id_calendar, start_week, start_fiscalyear,start_hours,end_hours,start_workday_hours,days_for_month,workweek,Project_id_project) VALUES (".$idcalendar.",'".$startweek."','".$startfiscalyear."','".$starthours."','".$endhours."','".$startworkdayhours."',".$daysformonth.",".$workweek.",".$projectidproject.")");
}else{
	mysql_query("UPDATE calendar set id_calendar='".$idcalendar."', start_week='".$startweek."', start_fiscalyear='".$startfiscalyear."', start_hours='".$starthours."',end_hours='".$endhours."', start_workday_hours='".$startworkdayhours."',days_for_month='".$daysformonth."', workweek='".$workweek."', Project_id_project='".$projectidproject."' where Project_id_project='".$projectidproject."'");
}
mysql_close($con);
//REDIRECCIONAMOS
header("location:../index2.php?id=$projectidproject");

?>