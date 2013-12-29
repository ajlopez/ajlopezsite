<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Usuarios.inc.php');

	Conectar();
	
	SesionPone('UsuarioEnlace',PaginaActual());

	UsuarioControla();

	if (!isset($Id))
		$Id = UsuarioId();

	if ($Id<>UsuarioId() and !EsAdministrador())
		PaginaSalir();

	$sql = "select Codigo, Contrasenia, Nombre, Apellido, Email, IdSexo, FechaNacimiento, IdPais, Provincia, Ciudad, CodigoPostal, EsAdministrador,
		FechaHoraAlta, FechaHoraModificacion, FechaHoraUltimoIngreso,
		Ingresos, Puntos, PuntosAnteriores, PuntosPendientes, Comentarios, NosConoce, EsAfiliado, EsTutor, Verificado, IdReferente
		 from usuarios where Id = $Id";		 
	$res = mysql_query($sql);
	list($Codigo, $Contrasenia, $Nombre, $Apellido, $Email, $IdSexo, $FechaNacimiento, $IdPais, $Provincia, $Ciudad, $CodigoPostal, $EsAdministrador, $FechaHoraAlta,
		$FechaHoraModificacion, $FechaHoraUltimoIngreso,
		$Ingresos, $Puntos, $PuntosAnteriores, $PuntosPendientes, $Comentarios, $NosConoce, $EsAfiliado, $EsTutor, $Verificado, $IdReferente)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "Usuario";

	if ($Id==UsuarioId())
		$PaginaTitulo = "Mis Datos";

 	$rsPais = mysql_query("Select Descripcion from paises where Id = $IdPais");
	if ($rsPais && mysql_num_rows($rsPais))
		list($PaisDescripcion) = mysql_fetch_row($rsPais);
	mysql_free_result($rsPais);

	$PuntosCalculados = UsuarioPuntos($Id,$PuntosAnteriores);

	if ($IdReferente) {
		$rsReferente = mysql_query("select Codigo from usuarios where Id = $IdReferente");
		list($CodReferente) = mysql_fetch_row($rsReferente);
		mysql_free_result($rsReferente);
	}

	require('Inicio.inc.php');
?>

<center>

<p>
<?
	if (EsAdministrador()) {
?>
<a href="Usuarios.php">Usuarios</a>
&nbsp;
&nbsp;
<?
	}
?>
<a href="UsuarioActualiza.php?Id=<? echo $Id; ?>">Actualiza</a>
<?
	if (EsAdministrador()) {
?>
&nbsp;
&nbsp;
<a href="UsuarioPuntosDetalleEx.php?Id=<? echo $Id; ?>">Puntos</a>
&nbsp;
&nbsp;
<a href="UsuarioElimina.php?Id=<? echo $Id; ?>">Elimina</a>
<?
	}
?>

<?
	if (EsAdministrador() && $Puntos<>$PuntosCalculados) {
?>
&nbsp;
&nbsp;
<a href="UsuarioPuntosCalcula.php?Id=<? echo $Id; ?>">Calcula Puntos</a>
<?
	}
?>

<?
	if (EsAdministrador() && !$Verificado) {
?>
&nbsp;
&nbsp;
<a href="UsuarioVerifica.php?Id=<? echo $Id; ?>">Verifica</a>
<?
	}
?>
<br>
<a href="Eventos.php?IdUsuario=<? echo $Id; ?>">Eventos</a>
&nbsp;&nbsp;
<a href="Eventos.php?Tipo=IN&IdUsuario=<? echo $Id; ?>">Ingresos</a>

</p>
<p>

<table class="Formulario" width="80%" cellspacing=1 cellpadding=2>
<?
	CampoEstaticoGenera("Código",$Codigo);
	CampoEstaticoGenera("Nombre",$Nombre);
	CampoEstaticoGenera("Apellido",$Apellido);
	CampoEstaticoGenera("Email",EnlaceEmail($Email));
	CampoEstaticoGenera("Pais", $PaisDescripcion);
	CampoEstaticoGenera("Provincia/Estado", $Provincia);
	CampoEstaticoGenera("Ciudad", $Ciudad);
	CampoEstaticoGenera("Código Postal", $CodigoPostal);
	CampoEstaticoGenera("Sexo", TextoSexo($IdSexo));
	CampoEstaticoGenera("Fecha de Nacimiento", $FechaNacimiento);
	CampoEstaticoGenera("Fecha/Hora de Alta", $FechaHoraAlta);
	CampoEstaticoGenera("Fecha/Hora de Modificación", $FechaHoraModificacion);
	CampoEstaticoGenera("Fecha/Hora de Ultimo Ingreso", $FechaHoraUltimoIngreso);
	CampoEstaticoGenera("Cantidad de Visitas", $Ingresos);
	if (EsAdministrador()) {
		if ($IdReferente) {
			CampoEstaticoGenera("Referente", "<a href='Usuario.php?Id=$IdReferente'>$CodReferente</a>");
		}
		CampoEstaticoGenera("Puntos", $Puntos);
		CampoEstaticoGenera("Puntos Calculados", $PuntosCalculados);
		CampoEstaticoGenera("Puntos Anteriores", $PuntosAnteriores);
		CampoEstaticoGenera("Puntos Pendientes", $PuntosPendientes);
		CampoEstaticoGenera("Nos Conoce", $NosConoce);
		CampoMemoEstaticoGenera("Comentarios", $Comentarios);
		CampoEstaticoGenera("Es Administrador del Sistema",TextoSiNo($EsAdministrador));
		CampoEstaticoGenera("Es Afiliado", TextoSiNo($EsAfiliado));
		CampoEstaticoGenera("Es Tutor", TextoSiNo($EsTutor));
		CampoEstaticoGenera("Verificado", TextoSiNo($Verificado));
	}
	else {
		CampoEstaticoGenera("Puntos", $PuntosCalculados);
	}
?>
</table>

<?
	if (EsAdministrador()) {
		$rsCursos = mysql_query("select uc.*, c.Descripcion from usuarioscursos uc left join cursos c on uc.IdCurso = c.Id where IdUsuario = $Id order by Id desc");

		if (mysql_num_rows($rsCursos)) {
?>
<h2>Cursos</h2>
<?
			$titulos = array("Descripci&oacute;n", "Fecha/Hora");
			TablaInicio($titulos);	

			while ($reg = mysql_fetch_array($rsCursos)) {
				FilaInicio();
				DatoEnlaceGenera($reg["Descripcion"],"Curso.php?Id=$reg[IdCurso]");
				DatoGenera($reg["FechaHoraInscripcion"]);
				FilaFinal();
			}
			TablaFinal();
		}

		mysql_free_result($rsCursos);
	}
?>

</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

