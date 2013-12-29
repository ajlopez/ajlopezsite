<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Validaciones.inc.php');

	$PaginaTitulo = "Pago Western Union";

	$Importe = $Importe+0;
	$IdUsuario = UsuarioId();
	$IdCurso = $IdCurso+0;

	if (!$Importe)
		$mensaje .= "Debe ingresar Importe<br>";

	if (!$Divisa)
		$mensaje .= "Debe ingresar Divisa<br>";

	if (!$Apellido)
		$mensaje .= "Debe ingresar Apellido del Remitente<br>";

	if (!$Nombre)
		$mensaje .= "Debe ingresar Nombre del Remitente<br>";

	if (!FechaValida($FechaAnio,$FechaMes,$FechaDia))
		$mensaje .= "Fecha de Transferencia inválida<br>";
	else
		$Fecha = FechaSqlArma($FechaAnio,$FechaMes,$FechaDia);

	if ($mensaje)
		ErrorMuestra($mensaje);	

	Conectar();


	$sql = "Insert pagos set IdUsuario = $IdUsuario,
		IdCurso = $IdCurso,
		FechaHora = Now(),
		Fecha = '$Fecha',
		Apellido = '$Apellido',
		Nombre = '$Nombre',
		Importe = $Importe,
		Divisa = '$Divisa',
		Observaciones = '$Observaciones',
		Comprobante = '$Comprobante',
		Tipo = 'WU'";

	mysql_query($sql);

	if (mysql_errno())
		echo mysql_error();

	$Id = mysql_insert_id();

	require('Inicio.inc.php');
?>

<p>
Su pago ha sido registrado. En cuanto confirmemos sus datos, quedar&aacute; habilitado a ingresar en el curso.
</p>

<?
	Desconectar();
	require('Final.inc.php');
?>

