<?
	include('Paginas.inc.php');
	include('Items.inc.php');
	include('Eventos.inc.php');
	include('Conexion.inc.php');
	include('Puntos.inc.php');
	include('Usuarios.inc.php');
	include('Emails.inc.php');
	include('Validaciones.inc.php');

	if (!$Id)
		PaginaSalir();

	Conectar();

	UsuarioControla();

	$rs = mysql_query("select Descripcion, ListaCorreo from cursos where Id = $Id");
	list($Descripcion, $ListaCorreo) = mysql_fetch_row($rs);

	$De = UsuarioEmail();
	$Para = $ListaCorreo . "-alta@eListas.net";
	$Titulo = "Alta Usuario " . UsuarioCodigo();
	$Texto = "Pido suscripcion a la lista";
	$IdUsuario = UsuarioId();

	if (!EsLocal())
		EmailEnvia($De,$Para,$Titulo,$Texto);

	mysql_query("insert emails set
		IdUsuario = $IdUsuario,
		De = '$De',
		Para = '$Para',
		Tema = '$Titulo',
		Texto = '$Texto',
		FechaHora = Now(),
		Ip = '$REMOTE_ADDR'");

	if (mysql_errno())
		echo mysql_error();

	$PaginaTitulo = "Subscripción a Lista de Correo de " . $Descripcion;

	include('Inicio.inc.php');
?>
<p>
Estimado usuario: gracias por suscribirse a nuestra lista de correo. En breve le confirmaremos el alta.
</p>

<center>
<a href='<? echo SesionToma('LeccionEnlace'); ?>'>Continuar la Lección</a>
</center>

<?
	include('Final.inc.php');
	Desconectar();
?>
