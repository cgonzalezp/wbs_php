<!doctype html>
<html>
<head>
</head>
<meta charset="utf-8">
<title>Configuración de fechas</title>
<script>
function search(){
        var arr= {"start_week":$('#start_week').val(),"start_fiscalyear":$('#start_fiscalyear').val(),"start_hours":$('#start_hours').val(),"end_hours":$('end_hours').val(),"start_workday_hours":$('start_workday_hours').val(),"workweek":$('workweek').val(),"days_for_month":$('days_for_month').val()};
        //alert(arr);
        $.ajax({
          url: 'ajax6.php',
          type: 'POST',
          dataType: 'json',
          data: arr,
          success: function(data) {
            
            if(data.start_week != null){
              $('#start_week').val(data.start_week);
              $('#start_fiscalyear').val(data.start_fiscalyear);
              $('#start_hours').val(data.start_hours);
              $('#end_hours').val(data.end_hours);
              $('#start_workday_hours').val(data.start_workday_hours);
              $('#workweek').val(data.workweek);
              $('#days_for_month').val(data.days_for_month);
            }else{
              $('#start_week').val();
              $('#start_fiscalyear').val();
              $('#start_hours').val();
              $('#end_hours').val();
              $('#start_workday_hours').val();
              $('#workweek').val();
              $('#days_for_month').val();
            }

           
          }
        });
}
search();
</script>
<body>


<div id="contenedor">
<h1><strong><br>
  Configuración de fechas</br>
</strong></h1>

<div id="cuerpo">
<form id="formdate" name="formdate" method="post" action="querys/config_calendar.php">
<fieldset>
<table width="374">
<tr>
	<td width="262">
	<label><strong>La semana comienza en: </strong></label>
	</td>
    <td width="100">
	<select name="start_week" id="start_week">
            <option value="" selected="selected"> - Seleccione -</option>
          <option value="Domingo">Domingo</option>
          <option value="Lunes">Lunes</option>
          <option value="Martes">Martes</option>
          <option value="Miercoles">Miercoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sabado">Sabado</option>
        </select>       
	</td>
</tr>
<tr>
	<td>
	 <label><strong>El año fiscal comienza en: </strong> </label>    
	</td>
    <td>
	<select name="start_fiscalyear" id="start_fiscalyear">
            <option value="" selected="selected"> - Seleccione -</option>
          <option value="Enero">Enero</option>
          <option value="febrero">Febrero</option>
          <option value="Marzo">Marzo</option>
          <option value="Abril">Abril</option>
          <option value="Mayo">Mayo</option>
          <option value="Junio">Junio</option>
          <option value="Julio">Julio</option>
            <option value="Agosto">Agosto</option>
            <option value="Septiembre">Septiembre</option>
            <option value="Octubre">Octubre</option>
            <option value="Noviembre">Noviembre</option>
            <option value="Diciembre">Diciembre</option>
        </select>  
	</td>
</tr>
<tr>
	<td>
	<label><strong>Hora de comienzo predeterminada: </strong></label>
	</td>
    <td>
	<select name="start_hours" id="start_hours">
          <option value="9:00" selected="selected">9:00</option>
          <option value="00:00">00:00</option>
          <option value="00:30">00:30</option>
          <option value="1:00">1:00</option>
          <option value="1:30">1:30</option>
          <option value="2:00">2:00</option>
          <option value="2:30">2:30</option>
          <option value="3:00">3:00</option>
          <option value="3:30">3:30</option>
          <option value="4:00">4:00</option>
          <option value="4:30">4:30</option>
          <option value="5:00">5:00</option>
          <option value="5:30">5:30</option>
            <option value="...">...</option>
        </select>  
	</td>
</tr>
<tr>
	<td>
	<label><strong>Hora fin predeterminada: </strong></label>  
	</td>
    <td>
	<select name="end_hours" id="end_hours">
          <option value="19:00" selected="selected">19:00</option>
            <option value="00:00">00:00</option>
            <option value="00:30">00:30</option>
            <option value="1:00">1:00</option>
            <option value="1:30">1:30</option>
            <option value="2:00">2:00</option>
            <option value="2:30">2:30</option>
            <option value="3:00">3:00</option>
            <option value="3:30">3:30</option>
            <option value="4:00">4:00</option>
            <option value="4:30">4:30</option>
            <option value="5:00">5:00</option>
            <option value="5:30">5:30</option>
            <option value="...">...</option>
        </select>  
	</td>
</tr>
<tr>
	<td>
	<label><strong>Jornada Laboral</strong></label>
	</td>
    <td>
	<select name="start_workday_hours" id="start_workday_hours">
            <option value="8" selected="selected">8 hrs</option>
            <option value="1">1 hrs</option>
            <option value="2">2 hrs</option>
            <option value="3">3 hrs</option>
            <option value="4">4 hrs</option>
            <option value="5">5 hrs</option>
            <option value="6">6 hrs</option>
            <option value="7">7 hrs</option>
            <option value="8">8 hrs</option>
            <option value="9">9 hrs</option>
            <option value="10">10 hrs</option>
        </select> 
	</td>
</tr>
<tr>
	<td>
	<label><strong>Semana Laboral: </strong></label>
	</td>
    <td>
	<select name="workweek" id="workweek">
          <option value="40" selected="selected">40</option>
          <option value="8">8</option>
          <option value="16">16</option>
          <option value="24">24</option>
          <option value="32">32</option>
          <option value="40">40</option>
          <option value="48">48</option>
          <option value="56">56</option>
          <option value="64">64</option>
          <option value="72">72</option>
          <option value="80">80</option>
        </select>  
	</td>
</tr>
<tr>
	<td>
	<label><strong>Días por mes: </strong></label>
	</td>
    <td>
	<select name="days_for_month" id="days_for_month">
          <option value="20" selected="selected">20</option>
          <option value="5">8</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="20">20</option>
          <option value="25">25</option>
          <option value="30">30</option>
          <option value="...">...</option>
    </select>  
	</td>
</tr>
<tr>
	<td>
	<input type="submit" name="enviar" id="enviar" value="Aceptar" /><a href="../querys/config_calendar.php">
    <input type="reset" name="borrar" id="borrar" value="Borrar campos" />
	</td>
</tr>

<!--<tr>
  <td><input type="submit" name="enviar" id="enviar" value="Aceptar" />
  <a href="../querys/config_calendar.php"><input type="reset" name="borrar" id="borrar" value="Borrar campos" /></td>
</tr>-->
</table>
</fieldset>
</form>
</div>
</div>
</body>
</html>
