<?php
    include_once('Settings.inc.php');

	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Sesion.inc.php');
	include_once('Validaciones.inc.php');
	include_once('Usuarios.inc.php');

	if (!$Titulo)
		$mensaje .= "Debe ingresar T&iacute;tulo<br>";

	if (!$Resumen && !$Contenido && !$Enlace)
		$mensaje .= "Debe ingresar Resumen o Contenido o Enlace<br>";

	if (FechaBlanco($VigenciaDesdeAnio,$VigenciaDesdeMes,$VigenciaDesdeDia))
		$VigenciaDesde = '';
	elseif (!FechaValida($VigenciaDesdeAnio,$VigenciaDesdeMes,$VigenciaDesdeDia))
		$mensaje .= "Fecha de Vigente Desde inválida<br>";
	else
		$VigenciaDesde = FechaSqlArma($VigenciaDesdeAnio,$VigenciaDesdeMes,$VigenciaDesdeDia);

	if (FechaBlanco($VigenciaHastaAnio,$VigenciaHastaMes,$VigenciaHastaDia))
		$VigenciaHasta = '';
	elseif (!FechaValida($VigenciaHastaAnio,$VigenciaHastaMes,$VigenciaHastaDia))
		$mensaje .= "Fecha de Vigente Hasta inválida<br>";
	else
		$VigenciaHasta = FechaSqlArma($VigenciaHastaAnio,$VigenciaHastaMes,$VigenciaHastaDia);

	if ($mensaje)
		ErrorMuestra($mensaje);	

	Conectar();

	$IdClase += 0;
	$IdIdioma += 0;
	$IdSitio += 0;
	$Prioridad += 0;
	$EsNuevo += 0;
	$EsHTML += 0;


	if (!$Prioridad)
		$Prioridad = 5;

	if (isset($Id))
		$sql = "Update articulos Set FechaHoraModificacion = now(), ";
	else
		$sql = "Insert articulos Set FechaHoraAlta = now(), FechaHoraModificacion = now(), IdUsuario = " . (UsuarioId()+0) . ", ";

	if (!EsAdministrador() && !$Id)
		$sql .= "IdEstado = 1,";

	$sql = $sql .  "Titulo = '$Titulo', 
		IdClase = $IdClase,
		IdIdioma = $IdIdioma,
		IdSitio = $IdSitio,
		Prioridad = $Prioridad,
		Resumen = '$Resumen',
		Copete = '$Copete',
		Contenido = '$Contenido',
		EsHTML = $EsHTML,
		Archivo = '$Archivo',
		Imagen = '$Imagen',
		TextoImagen = '$TextoImagen',
		VigenciaDesde = '$VigenciaDesde',
		VigenciaHasta = '$VigenciaHasta',
		Enlace = '$Enlace',
		EsNuevo = $EsNuevo
		";

	if (isset($Id))
		$sql = $sql . " where Id = $Id";

	mysql_query($sql);

	if (mysql_errno())
		echo mysql_error();

	$IdNuevo = mysql_insert_id();

	if (!$Id && $IdCategoria) {
		$sql = "Insert categoriasarticulos Set IdCategoria = $IdCategoria, IdArticulo = $IdNuevo";
		mysql_query($sql);
	}

	$ArticuloEnlace = SesionToma("ArticuloEnlace");
	SesionSaca("ArticuloEnlace");

	PaginaRedireccionar($ArticuloEnlace, "Articulos.php");
?>