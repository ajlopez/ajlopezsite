<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Paginas.inc.php');

	Conectar();
	
	if (isset($Id)) {
		$sql = "select * from usuarios where Id = $Id"; 
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		$Codigo = $reg->Codigo;
		$Contrasenia = $reg->Contrasenia;
		$Nombre = $reg->Nombre;
		$Apellido = $reg->Apellido;
		$IdSexo = $reg->IdSexo;
		$Email = $reg->Email;
		$IdPais = $reg->IdPais;
		$EsAdministrador = $reg->EsAdministrador;
		mysql_free_result($rs);
		$PaginaTitulo = "Actualiza Usuario";
		if ($Id == UsuarioId())
			$PaginaTitulo = "Sus Datos";		
		$EsNuevo = 0;
	}	
	else {
		 $PaginaTitulo = "Nuevo Usuario";
		 $EsNuevo = 1;
	}

	$rsPaises = mysql_query("Select id, descripcion from paises order by descripcion");
	echo mysql_error();

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="Usuarios.php">Usuarios</a>

<?php
	if (!$EsNuevo) {
?>
&nbsp;
&nbsp;
<a href="Usuario.php?Id=<?php echo $Id; ?>">Usuario</a>
&nbsp;
&nbsp;
<a href="UsuarioElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
<?php
	}
?>
</p>

<p>

<form action="UsuarioGraba.php" method=post>

<table class="Formulario" width="80%">
<?php
	if ($EsNuevo)
		CampoTextoGenera("Codigo","Código",$Codigo,16);
	else
		CampoEstaticoGenera("Código",$Codigo);

	CampoContraseniaGenera("Contrasenia","Contraseña",$Contrasenia,16);
	CampoContraseniaGenera("Contrasenia2","Reingrese Contraseña",$Contrasenia,16);
	CampoTextoGenera("Nombre","Nombre",$Nombre,40);
	CampoTextoGenera("Apellido","Apellido",$Apellido,40);
	CampoTextoGenera("Email","Email",$Email,50);
	CampoComboRsGenera("IdPais", "Pais", $rsPaises, $IdPais,'id','descripcion',1);
	CampoCheckGenera("EsAdministrador","Es Administrador del Sistema", $EsAdministrador);

	CampoAceptarGenera();
?>
</table>

<?php
	if (!$EsNuevo)
		IdGenera($Id);
?>
</form>

</center>

<?php
	mysql_free_result($rsPaises);
	Desconectar();
	require('Final.inc.php');
?>

