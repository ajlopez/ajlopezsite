<?
    include_once('Settings.inc.php');
    
	include_once('GetParameters.inc.php');
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');

	AdministradorControla('');

	Conectar();
	
	if (isset($Id)) {
        $Id += 0;
		$sql = "select * from referencias where Id = '$Id'"; 
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		$Titulo = $reg->Titulo;
		$Detalle = $reg->Detalle;
		$Enlace = $reg->Enlace;
		$IdItem = $reg->IdItem;
		$IdArticulo = $reg->IdArticulo;
		$IdPagina = $reg->IdPagina;
		$IdCategoria = $reg->IdCategoria;
		$CodigoPagina = $reg->CodigoPagina;
		$Prioridad = $reg->Prioridad;
		$Visitas = $reg->Visitas;
		mysql_free_result($rs);
		$PaginaTitulo = "Actualiza Referencia";
	}	
	else {
		$PaginaTitulo = "Nueva Referencia";
	}

	$Detalle=stripSlashes($Detalle);

	include('Inicio.inc.php');
?>

<center>

<p>
<?php
	if ($Id) {
?>
&nbsp;
&nbsp;
<a href="Referencia.php?Id=<?php echo $Id; ?>">Referencia</a>
&nbsp;
&nbsp;
<a href="ReferenciaElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
<?php
	}
?>
</p>

<p>

<form action="ReferenciaGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?php
	if ($Id)
		CampoEstaticoGenera("Id",$Id);

	CampoTextoGenera("Titulo","T&iacute;tulo",$Titulo,50);
	CampoMemoGenera("Detalle","Detalle",$Detalle,10,50);
	CampoTextoGenera("IdItem","Id Item",$IdItem,5);
	CampoTextoGenera("IdArticulo","Id Art&iacute;culo",$IdArticulo,5);
	CampoTextoGenera("IdCategoria", "Id Categor&iacute;a", $IdCategoria, 5);
	CampoTextoGenera("IdPagina", "Id P&aacute;gina", $IdPagina, 5);
	CampoTextoGenera("CodigoPagina", "C&oacute;digo de P&aacute;gina", $CodigoPagina, 20);
	CampoTextoGenera("Enlace", "Enlace", $Enlace, 40);
	CampoTextoGenera("Prioridad","Prioridad",$Prioridad,3);

	CampoAceptarGenera();
?>
</table>

<?php
	if ($Id)
		IdGenera($Id);
?>

</form>

</center>

<?php
	Desconectar();
	include('Final.inc.php');
?>

