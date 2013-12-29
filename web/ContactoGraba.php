<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Validaciones.inc.php');

	$PaginaTitulo = "Cont&aacute;ctenos";

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
		$mensaje .= "Debe ingresar Email<br>";

	if (!$Motivo)
		$mensaje .= "Debe ingresar Motivo<br>";

	if (!$Texto)
		$mensaje .= "Debe ingresar el Texto de la Consulta<br>";

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

	require('Inicio.inc.php');
?>

<p>
Su consulta ha sido registrada. Le contestaremos a la brevedad.
</p>

<?
	Desconectar();
	require('Final.inc.php');
?>

