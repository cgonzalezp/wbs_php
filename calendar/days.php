<?php
include_once ("../db.php");
$id_project=2;
$query="SELECT * FROM calendar WHERE id_calendar=$id_project";
$execute=mysql_query($query);
$row=mysql_fetch_array($execute);

/*
echo $id_calendar=$row['id_calendar'];
echo "<br>";
echo "la semana comienza en: ".$start_week=$row['start_week'];
echo "<br>";
echo "El ano comienza en: ".$start_fiscalyear=$row['start_fiscalyear'];
echo "<br>";
echo "Hora de comienzo predeterminada: ".$start_hours=$row['start_hours'];
echo "<br>";
echo "Hora de fin predeterminada: ".$end_hours=$row['end_hours'];
echo "<br>";
echo "Jornada laboral: ".$start_workday_hours=$row['start_workday_hours'];
echo "<br>";
echo "Semana laboral: ".$workweek=$row['workweek'];
echo "<br>";
echo "Dias por mes: ".$days_for_month=$row['days_for_month'];
echo "<br>";
echo $Project_id_project=$row['Project_id_project'];
echo "<br>";
echo "<br>";
*/


$dia=date("l");

if ($dia=="Monday") $dia="Lunes";
if ($dia=="Tuesday") $dia="Martes";
if ($dia=="Wednesday") $dia="Miércoles";
if ($dia=="Thursday") $dia="Jueves";
if ($dia=="Friday") $dia="Viernes";
if ($dia=="Saturday") $dia="Sabado";
if ($dia=="Sunday") $dia="Domingo";

$mes=date("F");

if ($mes=="January") $mes="Enero";
if ($mes=="February") $mes="Febrero";
if ($mes=="March") $mes="Marzo";
if ($mes=="April") $mes="Abril";
if ($mes=="May") $mes="Mayo";
if ($mes=="June") $mes="Junio";
if ($mes=="July") $mes="Julio";
if ($mes=="August") $mes="Agosto";
if ($mes=="September") $mes="Setiembre";
if ($mes=="October") $mes="Octubre";
if ($mes=="November") $mes="Noviembre";
if ($mes=="December") $mes="Diciembre";

$ano=date("Y");
$dia2=date("d");

echo "$dia, $dia2 de $mes de $ano";



?>