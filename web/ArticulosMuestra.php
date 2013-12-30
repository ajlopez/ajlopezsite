<?php
    include_once('Settings.inc.php');

	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Paginas.inc.php');
	include_once('Usuarios.inc.php');

	$PaginaTitulo = "Artículos";

	Conectar();
	
	$sql = "select a.Id, a.Codigo, a.Descripcion, ac.Descripcion as CatDescripcion from Articulos a left join ArticulosCategorias ac on a.IdCategoria = ac.Id where a.IdCategoria = $IdCategoria order by ac.Descripcion, a.Codigo";		 
	$rs = mysql_query($sql);

	$titulos = array("Código", "Descripción");

	if ($IdCategoria) {
		$rsCategoria = mysql_query("select Descripcion from ArticulosCategorias where Id = $IdCategoria");
		list($CatDescripcion) = mysql_fetch_row($rsCategoria);
		$PaginaTitulo = $CatDescripcion;
	}

	include('Inicio.inc.php');
?>

<center>

<script type="text/javascript"><!--
google_ad_client = "pub-8624135492444658";
//728x90, created 12/12/07
google_ad_slot = "1011191902";
google_ad_width = 728;
google_ad_height = 90;
//--></script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

</center>

<center>

<?php
function MuestraRegistro($reg) {
	FilaInicio();
	DatoEnlaceGenera($reg["Codigo"], "ArticuloMuestra.php?Id=".$reg["Id"]);
	DatoGenera($reg["Descripcion"]);
	FilaFinal();
}

	TablaInicio($titulos);

	while ($reg=mysql_fetch_array($rs)) 
		MuestraRegistro($reg);
				
	TablaFinal();
?>

</center>

<?php
	mysql_free_result($rs);
	include('Final.inc.php');

	Desconectar();
?>

