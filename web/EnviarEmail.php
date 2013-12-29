<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Usuarios.inc.php');
	include('Sesion.inc.php');

	AdministradorControla();

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

	$PaginaTitulo = "Envía Email";

	if ($De && $Para) {
		SendMail($De,$Para,$Titulo,$Texto);
	}

	Conectar();

	require('Inicio.inc.php');
?>
<center>

<p>
<form method=post>
<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	CampoTextoGenera("De","De",$De,40);
	CampoTextoGenera("Para","Para",$Para,40);
	CampoTextoGenera("Titulo","T&iacute;tulo",$Titulo,60);
	CampoMemoGenera("Texto","Texto",$Texto);
	CampoAceptarGenera();
?>
</table>
</form>
</p>
</center>

<?
	require('Final.inc.php');

	Desconectar();
?>




