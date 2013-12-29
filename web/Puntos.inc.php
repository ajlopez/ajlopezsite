<?php
	if (__Puntos_inc == 1)
		return;
	define ('__Puntos_inc', 1);

	define ('PUNTOS_TIPO_INSCRIPCION',1);	// Inscripcion de Usuario
	define ('PUNTOS_TIPO_SITIO',2);		// Aceptacion de Sitio
	define ('PUNTOS_TIPO_ARTICULO',3);	// Aceptacion de Articulo
	define ('PUNTOS_TIPO_INGRESO',4);	// Ingreso de Usuario
	define ('PUNTOS_TIPO_VOTO',5);		// Voto de Sitio o Articulo
	define ('PUNTOS_TIPO_VISITA',6);	// Visita a Sitio
	define ('PUNTOS_TIPO_LECTURA',7);	// Lectura de Articulo
	define ('PUNTOS_TIPO_REFERIDO',8);	// Puntos por Referido
	define ('PUNTOS_TIPO_REFERIDOGANA',9);	// Puntos ganados por Referido
	define ('PUNTOS_TIPO_CURSO',10);		// Puntos aplicados a Curso

	define ('PUNTOS_INSCRIPCION',1000);
	define ('PUNTOS_SITIO', 300);
	define ('PUNTOS_ARTICULO', 200);
	define ('PUNTOS_INGRESO', 50);
	define ('PUNTOS_VOTO', 10);
	define ('PUNTOS_VISITA', 5);
	define ('PUNTOS_LECTURA', 5);
	define ('PUNTOS_REFERIDO', 300);

	$PuntosTipos = array (PUNTOS_TIPO_INSCRIPCION => "Inscripción",
		PUNTOS_TIPO_SITIO => "Agregado de Sitio",
		PUNTOS_TIPO_ARTICULO => "Agregado de Articulo",
		PUNTOS_TIPO_INGRESO => "Ingreso al Sitio",
		PUNTOS_TIPO_VOTO => "Voto a Sitio/Artículo",
		PUNTOS_TIPO_VISITA => "Visita a Sitio",
		PUNTOS_TIPO_LECTURA => "Lectura de Artículo",
		PUNTOS_TIPO_REFERIDO => "Usuario Referido",
		PUNTOS_TIPO_REFERIDOGANA => "Puntos ganados por Referido",
		PUNTOS_TIPO_CURSO => "Puntos aplicados a Curso");

	include_once($PaginaPrefijo.'Conexion.inc.php');
	include_once($PaginaPrefijo.'Usuarios.inc.php');
	include_once($PaginaPrefijo.'Paginas.inc.php');

function PuntosReferidoGana($IdReferente,$Puntos,$PuntosNuevos,$Divisor=10)
{
	if (!$IdReferente)
		return;

	$p = (integer) ($Puntos / $Divisor);
	$pn = (integer) ($PuntosNuevos / $Divisor);

	if ($pn<=$p)
		return;

	PuntosGraba(PUNTOS_TIPO_REFERIDOGANA,$pn-$p,$IdReferente,$Divisor*2);
}

function PuntosGraba($tipo,$puntos,$idusuario=0,$divisor=10)
{
	if (!$puntos)
		return;

	Conectar();

	if (!$idusuario)
		$idusuario = UsuarioId()+0;

	if (!$idusuario) {
		Desconectar();
		return;
	}

	$UsuarioPuntos = SesionToma('UsuarioPuntos');

	$sql = "insert puntos set
		IdUsuario = $idusuario,
		Puntos = $puntos,
		Tipo = $tipo,
		FechaHora = Now(),
		Cantidad = 1";
	mysql_query($sql);

	if (mysql_errno())
		echo mysql_error();

	if ($idusuario == UsuarioId())
		SesionPone('UsuarioPuntos', $UsuarioPuntos + $puntos);

	$rsUsuario = mysql_query("select Puntos, PuntosAnteriores, Verificado, IdReferente from usuarios where Id = $idusuario");
	list($Verificado,$UsuPuntos,$UsuAnteriores,$IdReferente) = mysql_fetch_row($rsUsuario);
	mysql_free_result($rsUsuario);

	mysql_query("update usuarios set Puntos = Puntos + $puntos where Id = $idusuario");

	$UsuPuntos = $UsuPuntos + $UsuAnteriores;
	$UsuPuntosNuevo = $UsuPuntos + $puntos;

	if ($Verificado && $IdReferente && $UsuPuntosNuevo > $UsuPuntos)
		PuntosReferidoGana($IdReferente,$UsuPuntos,$UsuPuntosNuevo,$divisor);

	Desconectar();
}

function PuntosInscripcion($id=0) {
	PuntosGraba(PUNTOS_TIPO_INSCRIPCION,PUNTOS_INSCRIPCION,$id);
}

function PuntosIngreso() {
	PuntosGraba(PUNTOS_TIPO_INGRESO,PUNTOS_INGRESO);
}

function PuntosVisita() {
	PuntosGraba(PUNTOS_TIPO_VISITA,PUNTOS_VISITA);
}

function PuntosVoto() {
	PuntosGraba(PUNTOS_TIPO_VOTO,PUNTOS_VOTO);
}

function PuntosCurso($puntos) {
	PuntosGraba(PUNTOS_TIPO_CURSO,-$puntos);
}

function PuntosTipoTraduce($tipo) {
	global $PuntosTipos;

	if ($PuntosTipos[$tipo])
		return $PuntosTipos[$tipo];
	return $tipo;
}

?>