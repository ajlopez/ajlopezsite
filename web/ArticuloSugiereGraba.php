<?php
    include_once('Settings.inc.php');

	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Sesion.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Validaciones.inc.php');

	$PaginaTitulo = "Sugiere Art&iacute;culo";

	if (!$IdCategoria)
		$mensaje .= "Debe ingresar Tema<br>";		

	if (!$Descripcion)
		$mensaje .= "Debe ingresar Descripci&oacute;n<br>";

	if (!$Url)
		$mensaje .= "Debe ingresar Enlace<br>";

	if (!$Detalle)
		$mensaje .= "Debe ingresar Detalle<br>";

	if ($mensaje)
		ErrorMuestra($mensaje);	

	Conectar();

	$IdUsuario = UsuarioId() + 0;
	$IdCategoria = $IdCategoria + 0;

	$sql = "Insert articulossugeridos set IdUsuario = $IdUsuario,
		IdCategoria = $IdCategoria,
		FechaHora = Now(),
		Descripcion = '$Descripcion',
		Url = '$Url',
		Detalle = '$Detalle',
		Estado = 0";

	mysql_query($sql);

	if (mysql_errno())
		echo mysql_error();

	$Id = mysql_insert_id();

	include('Inicio.inc.php');
?>

<p>
Su sugerencia ha sido registrada. La procesaremos a la brevedad.
</p>

<?php
	Desconectar();
	require('Final.inc.php');
?>

