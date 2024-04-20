<?php
	session_start();
	session_destroy();
	$_SESSION['tipo'] = "";
	$_SESSION['id'] = "";
	$_SESSION['nome'] = "";
	$_SESSION['instituicao'] = "";
	$_SESSION['cidade'] = "";
	$_SESSION['estado'] = "";
	$_SESSION['cpf'] = "";
	$_SESSION['telefone'] = "";
	$_SESSION['email'] = "";
	$_SESSION['senha'] = "";
	header("location:index.php");
?>
