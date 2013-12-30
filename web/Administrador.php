<?php
    include_once('Settings.inc.php');
	include_once('Usuarios.inc.php');

	AdministradorControla('');

	include_once('Conexion.inc.php');

	Conectar();

	include_once('Campos.inc.php');

	$PaginaTitulo = "Administrador";

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="Usuarios.php">Usuarios</a>
<br>
<a href="EjecutaSqlEx.php?Consulta=<?php echo urlencode("select p.Descripcion, count(*) from usuarios u left join paises p on u.IdPais = p.Id group by p.Descripcion order by 2 desc"); ?>&Titulo=Usuarios+por+Pais">Usuarios por Pais</a>
<br>
<a href="CursosCategorias.php">Categor&iacute;as de Cursos</a>
<br>
<a href="Cursos.php">Cursos</a>
<br>
<a href="Categorias.php">Categor&iacute;as</a>
<br>
<a href="Items.php">Items</a>
<br>
<a href="Articulos.php">Art&iacute;culos</a>
<br>
<a href="Paginas.php">P&aacute;ginas</a>
<br>
<a href="Referencias.php">Referencias</a>
<br>
<a href="Sitios.php">Sitios</a>
<br>
<a href="Eventos.php">Eventos</a>
<br>
<a href="Eventos.php?Tipo=IN">Ingresos</a>
<br>
<a href="Eventos.php?Tipo=RM">Emails</a>
<br>
<a href="Eventos.php?Tipo=RR">Referidos</a>
<br>
<a href="EventosPorFecha.php">Eventos por Fecha</a>
<br>
<a href="Eventos.php?Tipo=RG">Registraciones</a>
<br>
<a href="EjecutaSqlEx.php?Consulta=<?php echo urlencode("select * from contactos order by id desc"); ?>&Titulo=Contactos">Contactos</a>
<br>
<a href="EjecutaSqlEx.php?Consulta=<?php echo urlencode("select * from usuarioscursos where Precio>0"); ?>&Titulo=Cursos+Pagos">Cursos Pagos</a>
<br>
<a href="EjecutaSqlEx.php?Consulta=<?php echo urlencode("select * from pagos"); ?>&Titulo=Pagos">Pagos</a>
<br>
<a href="EjecutaSqlEx.php?Consulta=<?php echo urlencode("select Id, Codigo, Email, Comentarios from usuarios where Comentarios>'' order by Id desc"); ?>&Titulo=Comentarios">Comentarios</a>
<br>
<a href="RankingCategorias.php">Ranking de Categor&iacute;as</a>
<br>
<a href="RankingItems.php">Ranking de Items</a>
<br>
<a href="RankingArticulos.php">Ranking de Art&iacute;culos</a>
<br>
<a href="RankingPaginas.php">Ranking de P&aacute;ginas</a>
<br>
<a href="EjecutaSql.php">Ejecuta SQL</a>
<br>
<a href="EnviarEmail.php">Enviar Email</a>
<br>
<a href="ArchivosDirectorio.php">Archivos</a>
<br>
<a href="ArchivosDirectorio.php?dir=text&padre=.">Textos</a>
<br>
<a href="PhpInfo.php" target="_blank">PhpInfo</a>
<br>
<a href="http://www.ajlopez.net/mysqlcontrol" target="_blank">phpMyAdmin remoto</a>
<br>
<a href="http://localhost/phpMyAdmin/index.php" target="_blank">phpMyAdmin local</a>
<br>
<a href="<a href="http://www.ajlopez.net/siteadmin" target="_blank">Panel de Control Cobalt</a>
<br>

</p>

</center>

<?php
	Desconectar();
	include('Final.inc.php');
?>



