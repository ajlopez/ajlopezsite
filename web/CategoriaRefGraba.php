<?php
    include_once('Settings.inc.php');
    
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Sesion.inc.php');
	include_once('Validaciones.inc.php');
	include_once('Usuarios.inc.php');

	Conectar();

	UsuarioControla();

	$IdCategoria += 0;
	$IdReferente += 0;

	$sql = "Update categorias Set IdReferencia = $IdCategoria where Id = $IdReferente";

	mysql_query($sql);


	if ($IdCategoria) {
		$sql = "Update categorias Set IdPadre = $IdCategoria where IdPadre = $IdReferente";

		mysql_query($sql);

		$sql = "Update categoriasarticulos Set IdCategoria = $IdCategoria where IdCategoria = $IdReferente";

		mysql_query($sql);

		$sql = "Update categoriasitems Set IdCategoria = $IdCategoria where IdCategoria = $IdReferente";

		mysql_query($sql);
	}

	$CategoriaEnlace = SesionToma("CategoriaEnlace");
	SesionSaca("CategoriaEnlace");

	PaginaRedireccionar($CategoriaEnlace,"Categorias.php");
?>