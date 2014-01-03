<?php
    include_once('Settings.inc.php');

	include_once('Paginas.inc.php');
	include_once('Items.inc.php');
	include_once('Eventos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Puntos.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Emails.inc.php');
	include_once('Validaciones.inc.php');

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
<a href='<?php echo SesionToma('LeccionEnlace'); ?>'>Continuar la Lección</a>
</center>

<?php
	include('Final.inc.php');
	Desconectar();
?>
