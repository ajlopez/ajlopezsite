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
	
	SesionPone('UsuarioEnlace',PaginaActual());

	UsuarioControla();

	if (!isset($Id))
		$Id = UsuarioId();
        
    $Id += 0;

	if ($Id<>UsuarioId() and !EsAdministrador())
		PaginaSalir();

	$sql = "select Codigo, Contrasenia, Nombre, Apellido, Email, IdSexo, FechaNacimiento, IdPais, Provincia, Ciudad, CodigoPostal, EsAdministrador,
		FechaHoraAlta, FechaHoraModificacion, FechaHoraUltimoIngreso,
		Ingresos, Puntos, PuntosAnteriores, PuntosPendientes, Comentarios, NosConoce, EsAfiliado, EsTutor, Verificado, IdReferente
		 from usuarios where Id = '$Id'";		 
	$res = mysql_query($sql);
	list($Codigo, $Contrasenia, $Nombre, $Apellido, $Email, $IdSexo, $FechaNacimiento, $IdPais, $Provincia, $Ciudad, $CodigoPostal, $EsAdministrador, $FechaHoraAlta,
		$FechaHoraModificacion, $FechaHoraUltimoIngreso,
		$Ingresos, $Puntos, $PuntosAnteriores, $PuntosPendientes, $Comentarios, $NosConoce, $EsAfiliado, $EsTutor, $Verificado, $IdReferente)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "Usuario";

	if ($Id==UsuarioId())
		$PaginaTitulo = "Mis Datos";

 	$rsPais = mysql_query("Select Descripcion from paises where Id = '$IdPais'");
	if ($rsPais && mysql_num_rows($rsPais))
		list($PaisDescripcion) = mysql_fetch_row($rsPais);
	mysql_free_result($rsPais);

	$PuntosCalculados = UsuarioPuntos($Id,$PuntosAnteriores);

	if ($IdReferente) {
		$rsReferente = mysql_query("select Codigo from usuarios where Id = '$IdReferente'");
		list($CodReferente) = mysql_fetch_row($rsReferente);
		mysql_free_result($rsReferente);
	}

	require('Inicio.inc.php');
?>

<center>

<p>
<?php
	if (EsAdministrador()) {
?>
<a href="Usuarios.php">Usuarios</a>
&nbsp;
&nbsp;
<?php
	}
?>
<a href="UsuarioActualiza.php?Id=<?php echo $Id; ?>">Actualiza</a>
<?php
	if (EsAdministrador()) {
?>
&nbsp;
&nbsp;
<a href="UsuarioPuntosDetalleEx.php?Id=<?php echo $Id; ?>">Puntos</a>
&nbsp;
&nbsp;
<a href="UsuarioElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
<?php
	}
?>

<?php
	if (EsAdministrador() && $Puntos<>$PuntosCalculados) {
?>
&nbsp;
&nbsp;
<a href="UsuarioPuntosCalcula.php?Id=<?php echo $Id; ?>">Calcula Puntos</a>
<?php
	}
?>

<?php
	if (EsAdministrador() && !$Verificado) {
?>
&nbsp;
&nbsp;
<a href="UsuarioVerifica.php?Id=<?php echo $Id; ?>">Verifica</a>
<?php
	}
?>
<br>
<a href="Eventos.php?IdUsuario=<?php echo $Id; ?>">Eventos</a>
&nbsp;&nbsp;
<a href="Eventos.php?Tipo=IN&IdUsuario=<?php echo $Id; ?>">Ingresos</a>

</p>
<p>

<table class="Formulario" width="80%" cellspacing=1 cellpadding=2>
<?php
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

<?php
	if (EsAdministrador()) {
		$rsCursos = mysql_query("select uc.*, c.Descripcion from usuarioscursos uc left join cursos c on uc.IdCurso = c.Id where IdUsuario = $Id order by Id desc");

		if (mysql_num_rows($rsCursos)) {
?>
<h2>Cursos</h2>
<?php
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

<?php
	Desconectar();
	require('Final.inc.php');
?>

