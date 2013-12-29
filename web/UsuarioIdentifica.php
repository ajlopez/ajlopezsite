<?
	include('Campos.inc.php');

	$PaginaTitulo = "Identifica Usuario";

	require('Inicio.inc.php');
?>

<center>

<p>
Por favor, ingrese su c&oacute;digo de usuario y su contrase&ntilde;a.
</p>

<p>

<form action="UsuarioValida.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	CampoTextoGenera("Codigo","Código de Usuario",$Codigo,16);
	CampoContraseniaGenera("Contrasenia","Contraseña",$Contrasenia,16);
?>
</table>
<input type="submit" value="Aceptar">
</form>

</p>

<p>
Si no es usuario, puede <a href="UsuarioActualiza.php">registrarse</a> gratuitamente en l&iacute;nea.
</p>

<p>
Si no recuerda su c&oacute;digo o contrase&ntilde;a, <a href="UsuarioRecuerda.php">haga click aqu&iacute;</a>.
</p:

</center>

<?
	require('Final.inc.php');
?>

