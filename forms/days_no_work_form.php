<!doctype html>
<html><head>
<meta charset="utf-8">
<title>Configuración de fechas</title>


  <script src="js/jquery-latest.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        /**
         * Funcion para añadir una nueva columna en la tabla
         */
        $("#add").click(function(){
            // Obtenemos el numero de filas (td) que tiene la primera columna
            // (tr) del id "tabla"
            var tds=$("#tabla tr:first td").length;
            // Obtenemos el total de columnas (tr) del id "tabla"
            var trs=$("#tabla tr").length;
            var nuevaFila="<tr>";
            //for(var i=0;i<tds;i++){
                // añadimos las columnas
                //nuevaFila+="<td>columna "+(i+1)+" Añadida con jquery</td>"; //<------
            //}
            id=0;
            nuevaFila+="<td><input type='text' id='name' value='Nombre de la excepcion'></td><td><input type='date' id='date' value='Seleccione la fecha...'></td><td><input type='date' id='date' value='Seleccione la fecha...'></td>";

            // Añadimos una columna con el numero total de columnas.
            // Añadimos uno al total, ya que cuando cargamos los valores para la
            // columna, todavia no esta añadida
            //nuevaFila+="<td>"+(trs+1)+" columnas"; //<-------
            nuevaFila+="</tr>";
            $("#tabla").append(nuevaFila);
        });
 
        /**
         * Funcion para eliminar la ultima columna de la tabla.
         * Si unicamente queda una columna, esta no sera eliminada
         */
        $("#del").click(function(){
            // Obtenemos el total de columnas (tr) del id "tabla"
            var trs=$("#tabla tr").length;
            if(trs>1)
            {
                // Eliminamos la ultima columna
                $("#tabla tr:last").remove();
            }
        });
    });
    </script>
</head>

<body>

<div id="contenedor">
  <div align="center">
  <!--<h3><strong>Dias no laborables</strong></h3>-->
  <form id="noworks" name="noworks" method="POST" action="querys/nowork.php">

<p>&nbsp;</p>
<p>Seleccione los días que no se trabajara:  </p>
<p>&nbsp;</p>
<table width="401" border='5' id="tabla" align="center">
          <tr>
            <td width="144"><strong>Nombre</strong></td>
            <td width="144"><strong>Fecha de inicio</strong></td>
            <td width="530"><strong>Fecha de fin</strong></td>
          </tr>
          <tr>
            <td><input type="text" id="name" name="name" value="Nombre de la excepcion" onFocus="this.value=''"></td>
            <td><input type="date" id="start_date_noworks" name="start_date_noworks" value="Seleccione la fecha..." onFocus="this.value=''"></td>
            <td><input type="date" id="finish_date_noworks" name="finish_date_noworks" value="Seleccione la fecha..." onFocus="this.value=''"></td>
        
          </tr>

</table>
<p>&nbsp;</p>

<p align="center">
  <!--<a id="add" ><img src='images/add_button.png' height="17" width="17">Agregar otro dia.</a>&nbsp;<a id="del" align="left"><img src='images/delete_button.png' height="17" width="17">Eliminar dia agregado. </a>-->
</p>
<p>&nbsp;</p>

<tr>
  <td><input type="submit" name="enviar" id="enviar" value="Aceptar" />
  <input type="reset" name="borrar" id="borrar" value="Borrar campos" /></td>
</tr>






    </form>
  </div>
 
</div>
</body>
</html>
