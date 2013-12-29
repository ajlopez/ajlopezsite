<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Usuarios.inc.php');
	include('Paginas.inc.php');
	include('Categorias.inc.php');

	Conectar();

	$PaginaTitulo = "Sugiere Tema";

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
Gracias por colaborar sugiriendo un nuevo tema para nuestra clasificaci&oacute;n. Por favor, ingrese los datos con precisi&oacute;n.

<p>
Los campos marcados con <font color=red>*</font> son obligatorios
<p>

<?
	} else {
?>
En <a href='<? echo PaginaPrincipal(); ?>'>todocontenidos</a> siempre buscamos nuevos contenidos para nuestro sitio.
Gracias por colaborar sugiriendo un nuevo tema para nuestra clasificaci&oacute;n. Por favor, ingrese los datos con precisi&oacute;n.
<?
	}
?>

<form action="TemaSugiereGraba.php" method=post>

<table class="Formulario" width="80%">
<?
	if ($IdCategoria)
		CampoEstaticoGenera("Es Tema de", CategoriasEnlaces($IdCategoria));
	else
		CampoComboRsGenera("IdCategoria", "Es Tema de", $rsCategorias, $IdCategoria, 'id', 'descripcion', true, true);

	CampoTextoGenera("Descripcion","Descripci&oacute;n",$Descripcion,50, true);
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

