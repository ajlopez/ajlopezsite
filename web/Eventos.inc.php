<?php
	if (__Eventos_inc == 1)
		return;
	define ('__Eventos_inc', 1);

	include_once($PaginaPrefijo.'Conexion.inc.php');
	include_once($PaginaPrefijo.'Usuarios.inc.php');
	include_once($PaginaPrefijo.'Paginas.inc.php');

function EventoGraba($parametro,$tipo='PG',$idpar=0) {
	if (EsAdministrador())
		return;

	global $REMOTE_ADDR;

	$p = strpos($parametro,"?");

	if ($p>0) {
		$subparametro = substr($parametro,$p+1);
		$parametro = substr($parametro,0,$p);
	}

	Conectar();

	$UsuarioId = UsuarioId()+0;

	$sql = "insert eventos set
		parametro = '$parametro',
		subparametro = '$subparametro',
		tipo = '$tipo',
		fechahora = now(),
		ip = '$REMOTE_ADDR',
		idparametro = $idpar,
		idusuario = $UsuarioId";

	if (!mysql_query($sql))
//		mailerror(__LINE__, __FILE__, "Ejecutando $sql\r\nError: " . mysql_error());
		echo mysql_error();

	Desconectar();
}

function EventoPagina($idpar=0, $espagina='') {
	global $mid;
	global $rid;
	global $aid;

	if (!$espagina)
		$pagina = PaginaActual();
	else
		$pagina = $espagina;

	$subpagina = strrchr($pagina,'/');

	if ($subpagina)
		$pagina = substr($subpagina,1);

	EventoGraba($pagina,'PG',$idpar);

	if ($mid)
		EventoMail($mid,$pagina);
	if ($rid)
		EventoReferente($rid,$pagina);
	if ($aid)
		EventoAfiliado($aid,$pagina);
}

function EventoMail($id,$pagina='')
{
	Conectar();
	$mid = SesionToma("MailId");

	if ($id<>$mid) {
		setcookie("CkMid",$mid);
		SesionPone("MailId",$id);
		EventoGraba($pagina,'RM',$id);
	}
		
	Desconectar();
}

function EventoReferente($id,$pagina='')
{
	Conectar();
	$mid = SesionToma("ReferenteId");

	if ($id<>$mid) {
		setcookie("CkRid",$mid);
		SesionPone("ReferenteId",$id);
		EventoGraba($pagina,'RR',$id);
	}
		
	Desconectar();
}

function EventoAfiliado($id,$pagina='')
{
	Conectar();
	$mid = SesionToma("AfiliadoId");

	if ($id<>$mid) {
		setcookie("CkAid",$mid);
		SesionPone("AfiliadoId",$id);
		EventoGraba($pagina,'RA',$id);
	}
		
	Desconectar();
}

function EventoIngreso() {
	EventoGraba(UsuarioCodigo(),'IN');
}

function EventoRegistracion() {
	EventoGraba(UsuarioCodigo(),'RG');
}

function EventoVisitaItem($iditem) {
	EventoGraba('','IT',$iditem);
}

function EventoVisitaArticulo($idarticulo) {
	EventoGraba('','AR',$idarticulo);
}

function EventoVisitaLeccion($idleccion) {
	EventoGraba('','LC',$idleccion);
}

function EventoVisitaPagina($idpagina) {
	EventoGraba('','PA',$idpagina);
}

function EventoVisitaReferencia($idref) {
	EventoGraba('','RE',$idref);
}

function EventoVotoItem($iditem) {
	EventoGraba('','VI',$iditem);
}

function EventoVotoArticulo($iditem) {
	EventoGraba('','VA',$iditem);
}

function EventoReferer() {
	global $HTTP_REFERER;
	global $HTTP_HOST;

	if (!$HTTP_REFERER || !$HTTP_HOST)
		return;

	if (strstr($HTTP_REFERER, $HTTP_HOST))
		return;

	EventoGraba($HTTP_REFERER,'RF');
}

?>