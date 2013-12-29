<?
	if (!$PaginaPrefijo)
		$PaginaPrefijo = '../';

	include($PaginaPrefijo.'Campos.inc.php');
	include($PaginaPrefijo.'Conexion.inc.php');
	include($PaginaPrefijo.'Errores.inc.php');
	include($PaginaPrefijo.'Usuarios.inc.php');
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'Eventos.inc.php');

	Conectar();

	EventoPagina();

	$PaginaTitulo = "Contact Form";
	
	require('Header.inc.php');
?>

<center>

<p>

</p>

<p>
The fields marked with <font color=red>*</font> are required

</p>

<p>
<form action="ContactProcess.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	if (UsuarioIdentificado())
		CampoEstaticoGenera ("User", UsuarioCodigo());
	CampoTextoGenera("Email","Email",UsuarioEmail(),50,true);
	CampoTextoGenera("Motivo","Subject",$Motivo,50);
	CampoMemoGenera("Texto","Text",$Texto,5,50,true);
	CampoAceptarGenera();
?>
</table>
</form>

</center>

<?
	Desconectar();
	require('Footer.inc.php');
?>

