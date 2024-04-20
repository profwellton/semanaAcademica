<?php
	@session_start;
	$idParticipante = $_GET["idParticipante"];
	$idResumo = $_GET["idResumo"];

	include 'conexao.php';

	mysql_query("DELETE FROM 2016_resumos WHERE id=$idResumo") or die("erro no servidor");
	header("location:painel.php?id=$idParticipante&md5=true#editado");
?>
