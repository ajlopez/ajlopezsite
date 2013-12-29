<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Usuarios.inc.php');
	include('Paginas.inc.php');
	include('Eventos.inc.php');

	$ArchivoJs = 'Utiles.js';

	Conectar();

	if (isset($Id) && $Id <> UsuarioId() && !EsAdministrador()) {
		PaginaRedireccionar();
	}

	if (!UsuarioIdentificado())
		$NoUsuario=1;

	EventoPagina();
	
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
		$Provincia = $reg->Provincia;
		$Ciudad = $reg->Ciudad;
		$CodigoPostal = $reg->CodigoPostal;
		$FechaNacimiento = $reg->FechaNacimiento;
		$IdSexo = $reg->IdSexo;
		$EsAdministrador = $reg->EsAdministrador;
		$NosConoce = $reg->NosConoce;
		$Comentarios = $reg->Comentarios;
		mysql_free_result($rs);
		$PaginaTitulo = "Actualiza Usuario";
		if ($Id == UsuarioId())
			$PaginaTitulo = "Mis Datos";		
		$EsNuevo = 0;
	}	
	else {
		$PaginaTitulo = "Nuevo Usuario";
		$EsNuevo = 1;
		$FechaNacimiento = '1970';
	}

	$rsPaises = mysql_query("Select id, descripcion from paises order by descripcion");
	echo mysql_error();

	require('Inicio.inc.php');
?>

<center>

<?
	if (EsAdministrador()) {
?>
<p>
<a href="Usuarios.php">Usuarios</a>

<?
	if (!$EsNuevo) {
?>
&nbsp;
&nbsp;
<a href="Usuario.php?Id=<? echo $Id; ?>">Usuario</a>
&nbsp;
&nbsp;
<a href="UsuarioElimina.php?Id=<? echo $Id; ?>">Elimina</a>
<?
	}
?>
</p>
<?
	}
?>

<p>

<script language="javascript">
function ValidaFormulario(thisform)
{
	with (thisform) {
<?
	if (!$Id) {
?>
		if (EsBlanco(Codigo.value)) {
			alert("Debe ingresar Código");
			Codigo.focus();
			return false;
		}
<?
	}
?>
		if (EsBlanco(Contrasenia.value)) {
			alert("Debe ingresar Contraseña");
			Contrasenia.focus();
			return false;
		}
		if (Contrasenia.value!=Contrasenia2.value) {
			alert("No coinciden las Contraseñas ingresadas");
			Contrasenia.focus();
			return false;
		}
		if (EsBlanco(Email.value)) {
			alert("Debe ingresar Email");
			Email.focus();
			return false;
		}
		if (!EmailValida(Email)) {
			alert("Email inválido");
			Email.focus();
			return false;
		}
	}
}

</script>

<form action="UsuarioGraba.php" method=post onsubmit="return ValidaFormulario(this);">
<p>

<?
	if ($EsNuevo && !EsAdministrador()) {
?>
Gracias por querer participar de nuestra comunidad. Por favor, complete los datos del siguiente formulario.
Tenga en cuenta que su c&oacute;digo y contrase&ntilde;a le ser&aacute;n requeridos cada vez que quiera
ingresar a las secciones privadas del sitio. Los campos marcados con <font color=red>*</font> son obligatorios. En caso de duda,
consulte nuestra <a href="Privacidad.php">pol&iacute;tica de privacidad</a>.
<?
	}
	else if (!$EsNuevo && !EsAdministrador()) {
		echo UsuarioSexoSufijo("Estimad");
		echo ' ';
		echo UsuarioNombreCompleto();
?>
: con este formulario puede modificar sus datos. Recuerde que los campos marcados con <font color=red>*</font> son obligatorios.
<?
	}
	else {
?>
Los campos marcados con <font color=red>*</font> son obligatorios
<?
	}
?>

</p>

<p>
<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	if ($EsNuevo)
		CampoTextoGenera("Codigo","Código",$Codigo,16,true);
	else
		CampoEstaticoGenera("Código",$Codigo);

	CampoContraseniaGenera("Contrasenia","Contraseña",$Contrasenia,16,true);
	CampoContraseniaGenera("Contrasenia2","Reingrese Contraseña",$Contrasenia,16,true);
	CampoTextoGenera("Nombre","Nombre",$Nombre,40);
	CampoTextoGenera("Apellido","Apellido",$Apellido,40);
	CampoTextoGenera("Email","Email",$Email,50,true);
	CampoComboRsGenera("IdPais", "Pais", $rsPaises, $IdPais,'id','descripcion',1,true);
	CampoTextoGenera("Provincia","Provincia/Estado",$Provincia,30);
	CampoTextoGenera("Ciudad","Ciudad",$Ciudad,40);
	CampoTextoGenera("CodigoPostal","Código Postal",$CodigoPostal,10);
	CampoFechaGenera("FechaNacimiento","Fecha de Nacimiento",$FechaNacimiento, true);
	CampoSexoGenera("IdSexo","Sexo", $IdSexo,true);
	if (EsAdministrador())
		CampoCheckGenera("EsAdministrador","Es Administrador del Sistema", $EsAdministrador);
	if ($EsNuevo || EsAdministrador()) {
		$ArregloNosConoce = array('' => '', 'MA' => 'Por un correo electr&oacute;nico',
			'RE' => 'Recomendaci&oacute;n de un amigo',
			'PU' => 'Publicidad en Internet',
			'NO' => 'Nota de Prensa en Medios',
			'EN' => 'Enlace en Otro Sitio',
			'OT' => 'Otros');
		CampoComboHashGenera("NosConoce","C&oacute;mo conoci&oacute; todocontenidos.com?", $ArregloNosConoce, $NosConoce);
		CampoMemoGenera("Comentarios","Comentarios<br>por favor, ingrese lo que espera del sitio,<br>sugerencias, cr&iacute;ticas, todo nos ayuda<br>a mejorar el servicio", $Comentarios);
	}

	CampoAceptarGenera();
?>
</table>

<?
	if (!$EsNuevo)
		IdGenera($Id);
?>
</form>

<p>
Si Ud. ya es usuario registrado, <a href="UsuarioIdentifica.php">identif&iacute;quese aqu&iacute;</a>.
</p>

</center>

<?
	mysql_free_result($rsPaises);
	Desconectar();
	require('Final.inc.php');
?>

