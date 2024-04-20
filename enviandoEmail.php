<?php
include("conexao.php");

$email = $_POST["email"];
$sql = mysqli_query($c, "SELECT * FROM ".$ano."_participantes WHERE email='$email'") or die(mysqli_error($c));
$contador = mysqli_num_rows($sql);
if($contador==0){
	header("location: recuperarSenha.php?erro=1&email=$email");
}else{
	$senhanova=geraSenha(6);

    session_start();

    $nome = $_SESSION["nome"];

	$sql = mysqli_query($c, "SELECT id, nome, hash FROM ".$ano."_participantes WHERE email='$email'") or die(mysqli_error($c));
    $mm = mysqli_fetch_array($sql);
	$nome = $mm["nome"];
    $hash = $mm["hash"];

    //header("location: https://wellton.com.br/email.php?evento=colincamp2021&nome=$nome&hash=$hash&email=$email");

}

/**
* Função para gerar senhas aleatórias
*
* @author    Thiago Belem <contato@thiagobelem.net>
*
* @param integer $tamanho Tamanho da senha a ser gerada
* @param boolean $maiusculas Se terá letras maiúsculas
* @param boolean $numeros Se terá números
* @param boolean $simbolos Se terá símbolos
*
* @return string A senha gerada
*/
function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
	$lmin = 'abcdefghijklmnopqrstuvwxyz';
	$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$num = '1234567890';
	$simb = '!@#$%*-';
	$retorno = '';
	$caracteres = '';

	$caracteres .= $lmin;
	if ($maiusculas) $caracteres .= $lmai;
	if ($numeros) $caracteres .= $num;
	if ($simbolos) $caracteres .= $simb;

	$len = strlen($caracteres);
	for ($n = 1; $n <= $tamanho; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
	}
	return $retorno;
}
?>
