<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Usuarios.inc.php');

	Conectar();
	
	if (!UsuarioIdentificado())
		PaginaRedireccionar('UsuarioPuntosNo.php');

	if (!isset($Id))
		$Id = UsuarioId();

	if ($Id<>UsuarioId() and !EsAdministrador())
		PaginaSalir();

	SesionPone('UsuarioEnlace',PaginaActual());

	$sql = "select Codigo, Contrasenia, Nombre, Apellido, Email, IdSexo, FechaNacimiento, IdPais, Provincia, Ciudad, CodigoPostal, EsAdministrador,
		FechaHoraAlta, FechaHoraModificacion, FechaHoraUltimoIngreso,
		Ingresos, Puntos, PuntosAnteriores, PuntosPendientes
		 from usuarios where Id = $Id";		 
	$res = mysql_query($sql);
	list($Codigo, $Contrasenia, $Nombre, $Apellido, $Email, $IdSexo, $FechaNacimiento, $IdPais, $Provincia, $Ciudad, $CodigoPostal, $EsAdministrador, $FechaHoraAlta,
		$FechaHoraModificacion, $FechaHoraUltimoIngreso,
		$Ingresos, $Puntos, $PuntosAnteriores, $PuntosPendientes)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "Favoritos del Usuario";

	if ($Id==UsuarioId())
		$PaginaTitulo = "Mis Favoritos";

 	$rsPais = mysql_query("Select Descripcion from paises where Id = $IdPais");
	if ($rsPais && mysql_num_rows($rsPais))
		list($PaisDescripcion) = mysql_fetch_row($rsPais);
	mysql_free_result($rsPais);

	require('Inicio.inc.php');
?>

<?
	Desconectar();
	require('Final.inc.php');
?>

