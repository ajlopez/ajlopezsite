<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Usuarios.inc.php');
	include('Paginas.inc.php');
	include('Categorias.inc.php');
	include('Puntos.inc.php');

	Conectar();

	$PaginaTitulo = "Agrega Art&iacute;culo";

	require('Inicio.inc.php');

	if ($IdCategoria)
		CategoriaTraduce($IdCategoria,$CatDescripcion,$CatPadre);
	else {
		$sql = "select id, descripcion from categorias where IdPadre=0 order by descripcion";
		$rsCategorias = mysql_query($sql);
	}
?>

<center>

<p>

<?
	if (UsuarioIdentificado()) {
		echo UsuarioSexoSufijo("Estimad");
		echo ' ';
		echo UsuarioNombreCompleto();
?>
: En <a href='<? echo PaginaPrincipal(); ?>'>todocontenidos</a> siempre buscamos nuevos contenidos para nuestro sitio.
Gracias por colaborar agregando un art&iacute;culo. Por favor, ingrese los datos con precisi&oacute;n.
En caso de aceptar su entrada, le acreditaremos <b><? echo PUNTOS_ARTICULO; ?> puntos</b> (sujeto a la aprobaci&oacute;n de los datos) en su cuenta de usuario, para que pueda aprovecharlos
en nuestras ofertas.

<p>
Los campos marcados con <font color=red>*</font> son obligatorios
<p>

<?
	} else {
?>
En <a href='<? echo PaginaPrincipal(); ?>'>todocontenidos</a> siempre buscamos nuevos contenidos para nuestro sitio.
Gracias por colaborar agregando un art&iacute;culo. Por favor, ingrese los datos con precisi&oacute;n.
<?
	}
?>

<form action="ArticuloSugiereGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	if ($IdCategoria)
		CampoEstaticoGenera("Tema", CategoriasEnlaces($IdCategoria,'Tema.php'));
	else
		CampoComboRsGenera("IdCategoria", "Categor&iacute;a", $rsCategorias, $IdCategoria, 'id', 'descripcion', true, true);

	CampoTextoGenera("Descripcion","Descripci&oacute;n",$Descripcion,50, true);
	CampoTextoGenera("Url", "Enlace", $Url, 50, true);
	CampoMemoGenera("Detalle","Detalle",$Detalle,10,50, true);

	CampoAceptarGenera();
?>
</table>

<?
	if ($IdCategoria) {
?>
<input type="hidden" name="IdCategoria" value="<? echo $IdCategoria; ?>">

<?
	}
?>

</form>

</center>

<?
	if ($rsCategorias)
		mysql_free_result($rsCategorias);

	Desconectar();
	require('Final.inc.php');
?>

