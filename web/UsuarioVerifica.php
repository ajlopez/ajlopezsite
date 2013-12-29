<?
	include('Paginas.inc.php');
	include('Items.inc.php');
	include('Eventos.inc.php');
	include('Conexion.inc.php');
	include('Puntos.inc.php');
	include('Usuarios.inc.php');

	AdministradorControla();

	if (!$Id)
		PaginaSalir();

	Conectar();

	$rsUsuario = mysql_query("select PuntosAnteriores, IdReferente from usuarios where Id = $Id");
	list($Anteriores,$IdReferente) = mysql_fetch_row($rsUsuario);
	mysql_free_result($rsUsuario);

	$Puntos = UsuarioPuntos($Id,$Anteriores);

	mysql_query("update usuarios set Puntos = $Puntos, Verificado=1 where Id = $Id");

	if ($IdReferente)
		PuntosReferidoGana($IdReferente,$Anteriores,$Puntos);

	PaginaRedireccionar("Usuario.php?Id=$Id");
?>
