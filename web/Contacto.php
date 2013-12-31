<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');
	include_once('Eventos.inc.php');

	Conectar();

	EventoPagina();

	$PaginaTitulo = "Formulario de Contacto";
	
	include('Inicio.inc.php');
?>

<center>

<p>
Si desea hacer una consulta o sugerencia, complete este formulario. En breve, nos comunicaremos con Ud.

</p>

<p>
Los campos marcados con <font color=red>*</font> son obligatorios

</p>

<p>
<form action="ContactoGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?php
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

<?php
	Desconectar();
	include('Final.inc.php');
?>

