<?
	if (!$PaginaPrefijo)
		$PaginaPrefijo = '../';

	include($PaginaPrefijo.'Errores.inc.php');
	include($PaginaPrefijo.'Sesion.inc.php');
	include($PaginaPrefijo.'Usuarios.inc.php');
	include($PaginaPrefijo.'Validaciones.inc.php');
	include($PaginaPrefijo.'Conexion.inc.php');

	$PaginaTitulo = "Contact Form";

function SendMail($FROM,$TO,$SUBJECT,$MESSAGE,$REPLYTO='',$TYPE='')
{
        $error = "";
	$header = "From: <" . $FROM . ">\n";
	if($REPLYTO)
	{ $header .= "Reply-To: <" . $REPLYTO . ">\n"; }
	if($TYPE == "text")
	{ $header .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n"; }
	elseif($TYPE == "html")
	{
		$header .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
		$header .= "Content-Transfer-Encoding: quoted-printable\n";
		$header .= "Content-Disposition: inline\n";
	}
	elseif($TYPE == "multi")
	{
		$header .= "Content-Type: multipart/alternative; ";
		$header .= "boundary=\"----=_Ciao_EmailList_Manager.ContentBoundary\"\n";
	}
	mail("<" . $TO . ">",$SUBJECT,$MESSAGE,$header) or $error = "\n<br>Error enviando a: $TO";

	if ($error)
		echo $error;
}

	if (!$Email)
		$mensaje .= "Email required<br>";

	if (!$Motivo)
		$mensaje .= "Subject required<br>";

	if (!$Texto)
		$mensaje .= "Text required<br>";

	if ($mensaje)
		ErrorMuestra($mensaje);	

	Conectar();

	$IdUsuario = UsuarioId() + 0;

	$sql = "Insert contactos set IdUsuario = $IdUsuario,
		FechaHora = Now(),
		Email = '$Email',
		Motivo = '$Motivo',
		Texto = '$Texto'";

	mysql_query($sql);

	if (mysql_errno())
		echo mysql_error();

	if ($Email && $Texto) {
		SendMail($Email,"webmaster@ajlopez.com","[ajlopez.net] $Motivo",$Texto);
	}

	$Id = mysql_insert_id();

	require('Header.inc.php');
?>

<p>
Your message has been sent and recorded. I'll contact ASAP.
</p>

<?
	Desconectar();
	require('Footer.inc.php');
?>

