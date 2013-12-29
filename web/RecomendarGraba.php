<?
	include('Paginas.inc.php');
	include('Items.inc.php');
	include('Eventos.inc.php');
	include('Conexion.inc.php');
	include('Puntos.inc.php');
	include('Usuarios.inc.php');
	include('Emails.inc.php');
	include('Validaciones.inc.php');

	if (!$Email)
		PaginaSalir();

	Conectar();

function EnviaUno($De,$Para,$Titulo,$Texto)
{
	global $REMOTE_ADDR;

	if (!De || !$Para)
		return;

	$IdUsuario = UsuarioId()+0;

	$rsRecomendado = mysql_query("select * from recomendados where Para = '$Para'");
	if ($rsRecomendado && mysql_num_rows($rsRecomendado)) {
		mysql_free_result($rsRecomendado);
		return;
	}

	mysql_free_result($rsRecomendado);

	if (!EmailValida($De) || !EmailValida($Para) || !UsuarioVerificado()) {
		mysql_query("insert recomendados set De = '$De', Para='$Para', IdUsuario = $IdUsuario, FechaHora = Now(), Ip = '$REMOTE_ADDR'");
		return;
	}

	EmailEnvia($De,$Para,$Titulo,$Texto);

	mysql_query("insert recomendados set De = '$De', Para='$Para', IdUsuario = $IdUsuario, FechaHora = Now(), Ip = '$REMOTE_ADDR', Enviado=1");			
}

	$Texto = EmailTextoRecomendar();
	$Titulo = "Visita www.todocontenidos.com";

	EnviaUno($Email,$Email1,$Titulo,$Texto);
	EnviaUno($Email,$Email2,$Titulo,$Texto);
	EnviaUno($Email,$Email3,$Titulo,$Texto);
	EnviaUno($Email,$Email4,$Titulo,$Texto);
	EnviaUno($Email,$Email5,$Titulo,$Texto);
	EnviaUno($Email,$Email6,$Titulo,$Texto);

	$PaginaTitulo = "Gracias por Recomendarnos";

	include('Inicio.inc.php');
?>

<p>
Estimado usuario: gracias por recomendar nuestro sitio. Esperemos poderle brindar buen servicio a Ud. y a sus
referidos.
</p>

<?
	include('Final.inc.php');
	Desconectar();
?>
