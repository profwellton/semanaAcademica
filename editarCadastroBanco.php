<?php
	session_start();
	include 'conexao.php';

	/* Define o limite de tempo do cache em 30 minutos */
	session_cache_expire(120);
	$cache_expire = session_cache_expire();

	if($_POST["senha"]!=$_POST["repitasenha"]){
	    header("location: editarCadastro.php?erro=3");
	}else{
	    
	    $id=$_GET["id"];
	    $nome = $_POST['nome'];
	    $instituicao = $_POST['instituicao'];
	    $curso = $_POST['curso'];
	    
	    $ra = $_POST['ra'];
	    $cidade = $_POST['cod_cidades'];
	    $cpf = $_POST['cpf'];
	    $estado = $_POST['estado'];
	    $email = $_POST['email'];
	    $senha = crypt($_POST['senha']);
	    
	    //$sqlupdate = "UPDATE  ".$ano."_participantes SET nome='$nome', instituicao='$instituicao', curso='$curso', ra='$ra', cidade='$cidade', estado='$estado', cpf='$cpf', email='$email', senha='$senha' WHERE id=$id";
	    
	    $sqlupdate = "UPDATE  ".$ano."_participantes SET nome='$nome', instituicao='$instituicao', curso='$curso', ra='$ra', cidade='$cidade', estado='$estado', cpf='$cpf', email='$email' WHERE id=$id";
	    
	    mysqli_query($c, $sqlupdate) or die(mysqli_error($c));
	    header("location: painel.php?m=ok");
	}
?>
