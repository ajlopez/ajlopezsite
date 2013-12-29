<?
	include('Campos.inc.php');
	include('Paginas.inc.php');
	include('Emails.inc.php');

	$PaginaTitulo = "Recomiende todocontenidos.com";

	$ArchivoJs = 'Utiles.js';

	require('Inicio.inc.php');
?>

<center>

<p>
Ud. puede dar a conocer nuestro sitio <a href="<? echo PaginaPrincipal(); ?>">todocontenidos.com</a>. Rellene este formulario
para recomendarlo a sus amistades.
</p>

<?
	if (UsuarioIdentificado()) {
?>
<p>
Si alguno de sus referidos se registra en nuestro sitio, Ud. comenzar&aacute; a ganar puntos. Consulte <a href="UsuarioPuntos.php">Mis Puntos</a>
para mayor informaci&oacute;n.
</p>
<?
	}
?>

<p>

<script language="javascript">
function ValidaFormulario(thisform)
{
	with (thisform) {
<?
	if (!UsuarioIdentificado()) {
?>
		if (EsBlanco(Email.value)) {
			alert("Debe ingresar su Email");
			Email.focus();
			return false;
		}
<?
	}
?>
		if (!EsBlanco(Email1.value) && !EmailValida(Email1)) {
			alert("El Email de Amigo 1 es inválido");
			Email1.focus();
			return false;
		}
		if (!EsBlanco(Email2.value) && !EmailValida(Email2)) {
			alert("El Email de Amigo 2 es inválido");
			Email2.focus();
			return false;
		}
		if (!EsBlanco(Email3.value) && !EmailValida(Email3)) {
			alert("El Email de Amigo 3 es inválido");
			Email3.focus();
			return false;
		}
		if (!EsBlanco(Email4.value) && !EmailValida(Email4)) {
			alert("El Email de Amigo 4 es inválido");
			Email4.focus();
			return false;
		}
		if (!EsBlanco(Email5.value) && !EmailValida(Email5)) {
			alert("El Email de Amigo 5 es inválido");
			Email5.focus();
			return false;
		}
		if (!EsBlanco(Email6.value) && !EmailValida(Email6)) {
			alert("El Email de Amigo 6 es inválido");
			Email6.focus();
			return false;
		}
	}
}

</script>


<form action="RecomendarGraba.php" method=post onsubmit="return ValidaFormulario(this);">

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	if (UsuarioIdentificado())
		CampoEstaticoGenera("Su Email",UsuarioEmail());
	else
		CampoTextoGenera("Email","Su Email",$Email,40);
	CampoTextoGenera("Email1","Email Amigo 1",$Email1,40);
	CampoTextoGenera("Email2","Email Amigo 2",$Email2,40);
	CampoTextoGenera("Email3","Email Amigo 3",$Email3,40);
	CampoTextoGenera("Email4","Email Amigo 4",$Email4,40);
	CampoTextoGenera("Email5","Email Amigo 5",$Email5,40);
	CampoTextoGenera("Email6","Email Amigo 6",$Email6,40);
	CampoMemoEstaticoGenera("Email<br>a enviar", EmailTextoRecomendar());
?>
</table>
<?
	if (UsuarioIdentificado()) {
?>
<input type="hidden" name="Email" value="<? echo UsuarioEmail(); ?>">
<?
	}
?>
<input type="submit" value="Aceptar">
</form>

</p>

</center>

<?
	require('Final.inc.php');
?>

