<?php
include("conexao.php");
session_start();

$senha = $_POST["senha"];
$r_senha = $_POST["r_senha"];
$email = $_POST["email"];
$hash = $_POST["hash"];

if($senha == $r_senha){
    $senha = crypt($senha, $senha);
    if( mysqli_query($c, "UPDATE ".$ano."_participantes SET senha='$senha' WHERE hash='$hash'")){
	$_SESSION["mensagem"]="Senha alterada com sucesso!";
	$_SESSION["m"]="Senha alterada com sucesso!";
	header("location: https://salin.fb.utfpr.edu.br/#login");
    }else{
	echo "Erro no servidor =(. Tente novamente.";
    }
}
