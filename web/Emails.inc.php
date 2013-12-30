<?php
if (__Emails_inc == 1)
	return;
define ('__Emails_inc', 1);

	include_once('Usuarios.inc.php');

function EmailEnvia($FROM,$TO,$SUBJECT,$MESSAGE,$REPLYTO='',$TYPE='')
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
		$header .= "boundary=\"----=_todocontenidos_email.ContentBoundary\"\n";
	}
	mail("<" . $TO . ">",$SUBJECT,$MESSAGE,$header) or $error = "\n<br>Error enviando a: $TO";

	if ($error)
		echo $error;
}

function EmailTextoRecomendar()
{
	$rid = UsuarioId()+0;

	return "Hola!\n\n" .
		"Te recomiendo que visites el sitio:\n\n" .
		"http://www.todocontenidos.com/default.php?rid=$rid\n\n" .
		"donde encontraras cursos a distancia, muy accesibles, desde u\$s 30, con temas de informatica, negocios e Internet. " .
		"Puedes consultar el listado de sitios y contenidos en castellano, que estan construyendo, donde puedes " .
		"ingresar tus contenidos favoritos o promocionar gratuitamente tu propio sitio.\n\n" .
		"No dejes de consultar el listado de cursos en:\n\n" .
		"http://www.todocontenidos.com/Cursos.php?rid=$rid\n\n";
}

?>
