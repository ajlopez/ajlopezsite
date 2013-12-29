<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Usuarios.inc.php');
	include('Paginas.inc.php');
	include('Eventos.inc.php');

	Conectar();

	EventoPagina();

	$PaginaTitulo = "Cursos a Distancia";

	if (!$Motivo)
		$Motivo = "Cursos a Distancia";
	
	require('Inicio.inc.php');
?>

<center>

<p class="destacado">
Si desea más información sobre <b>Cursos a Distancia</b> de Java, .NET, PHP, y otros (temario,
costos, modalidad), por favor, complete este formulario. En breve, nos comunicaremos con Ud.
</p>

<p>
Los campos marcados con <font color=red>*</font> son obligatorios. Ingrese
correctamente su email, a esa dirección le contestaremos.

</p>

<p>
<form action="ContactoGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	if (UsuarioIdentificado())
		CampoEstaticoGenera ("Usuario", UsuarioCodigo());
	CampoTextoGenera("Email","Email",UsuarioEmail(),50,true);
	CampoTextoGenera("Motivo","Motivo",$Motivo,50);
	CampoMemoGenera("Texto","Consulta",$Texto,5,50,true);
	CampoAceptarGenera();
?>
</table>
</form>

</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

