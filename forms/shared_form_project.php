<!doctype html>
<html>
<head>
</head>
<meta charset="utf-8">
<title>Compartir Proyecto</title>
<body>

<div id="contenedor">
<h1><strong><br>Compartir Proyecto</br>
</strong></h1>
<div id="cuerpo">
<form id="sharedproject" name="sharedproject" method="post" action="querys/shared_project.php">
<fieldset>
<table width="374">
<tr>
	<td width="262"><label><strong>Email del usuario nuevo </strong></label></td>
  	<td width="100"><input type="email" title="Email del usuario"name="emailnewuser" id="emailnewuser" required></imput></td>
</tr>
<tr>
	<td><input type="submit" name="enviar" id="enviar" value="Aceptar" />
	<a href="querys/edit_project.php"><input type="reset" name="borrar" id="borrar" value="Borrar campos" /></td>
</tr>

</table>
</fieldset>
</form>
</div>
</div>
</body>
</html>
