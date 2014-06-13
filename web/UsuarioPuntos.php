<?php
    include_once('Settings.inc.php');

	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Utiles.inc.php');
	include_once('Usuarios.inc.php');

	Conectar();
	
	if (!UsuarioIdentificado())
		PaginaRedireccionar('UsuarioPuntosNo.php');

	if (!isset($Id))
		$Id = UsuarioId();
        
    $Id += 0;

	if ($Id<>UsuarioId() and !EsAdministrador())
		PaginaSalir();

	SesionPone('UsuarioEnlace',PaginaActual());

	$sql = "select Codigo, Contrasenia, Nombre, Apellido, Email, IdSexo, FechaNacimiento, IdPais, Provincia, Ciudad, CodigoPostal, EsAdministrador,
		FechaHoraAlta, FechaHoraModificacion, FechaHoraUltimoIngreso,
		Ingresos, Puntos, PuntosAnteriores, PuntosPendientes
		 from usuarios where Id = '$Id'";		 
	$res = mysql_query($sql);
	list($Codigo, $Contrasenia, $Nombre, $Apellido, $Email, $IdSexo, $FechaNacimiento, $IdPais, $Provincia, $Ciudad, $CodigoPostal, $EsAdministrador, $FechaHoraAlta,
		$FechaHoraModificacion, $FechaHoraUltimoIngreso,
		$Ingresos, $Puntos, $PuntosAnteriores, $PuntosPendientes)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "Puntos del Usuario";

	if ($Id==UsuarioId())
		$PaginaTitulo = "Mis Puntos";

 	$rsPais = mysql_query("Select Descripcion from paises where Id = '$IdPais'");
	if ($rsPais && mysql_num_rows($rsPais))
		list($PaisDescripcion) = mysql_fetch_row($rsPais);
	mysql_free_result($rsPais);

	require('Inicio.inc.php');
?>

<?php
	if ($Id==UsuarioId()) {
?>
<p>
Gracias a nuestro <b>Sistema de Puntos</b>, Ud. puede ganarlos con diversas actividades, y
aplicarlos como parte de pago en la inscripci&oacute;n a nuestros <a href="CursosMuestra.php">Cursos</a>.
</p>
<?php
	}
?>
<p>
Actualmente posee <b>
<?php
		$UsuarioPuntos = UsuarioPuntos(UsuarioId(),$PuntosAnteriores);
		SesionPone('UsuarioPuntos',$UsuarioPuntos);
		echo $UsuarioPuntos;
?>
 puntos</b>. Pueder ver <a href="UsuarioPuntosDetalle.php">el detalle</a> de los mismos.

<?php
	Desconectar();
	require('Final.inc.php');
?>

