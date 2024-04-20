<?php

include("conexao.php");

	$email = $_POST["email"];
	$senha = $_POST["senha"];

$sql = mysqli_query($c, "SELECT * FROM ".$ano."_participantes WHERE email='$email'") or die (mysqli_error($c));

$cont = mysqli_num_rows($sql);
if($cont==0){

    echo $email."<br>";
$cpf = $email; //exemplo de cpf digitado de qualquer geito
$cpf = str_replace('.', '', $cpf); // Retira os pontos
$cpf = str_replace('-', '', $cpf); // Retira os hifens

//Coloca os pontos e o hifem no lugar certo
$cpfcerto = substr($cpf , 0, 3).".".substr($cpf , 3, 3).".".substr($cpf , 6, 3)."-".substr($cpf , 9, 2);
// Exibe o resultado na tela
echo $cpfcerto."<br>";

    $sql = mysqli_query($c, "SELECT * FROM ".$ano."_participantes WHERE cpf='$cpfcerto'") or die (mysqli_error($c));

    $cont = mysqli_num_rows($sql);

    echo $cont."<br>";

}

echo $senha."<br>";
echo  crypt($senha, $mostra["senha"])."<br>";


	$mostra=mysqli_fetch_array($sql);
	$senhadecrypt = crypt($senha, $mostra["senha"]);

echo $mostra["senha"];

if($mostra["senha"]==$senhadecrypt){
		//echo "LOGIN OK";
		session_start();

		$_SESSION['tipo'] = $mostra["tipo"];
		$_SESSION['comprovante'] = $mostra["comprovante"];
		$_SESSION['confirmacao'] = $mostra["confirmacao"];
		$_SESSION['pagamento'] = $mostra["pagamento"];
		$_SESSION['id'] = $mostra["id"];
		$_SESSION['nome']=$mostra["nome"];
		$_SESSION['instituicao']=$mostra["instituicao"];
		$_SESSION['ra']=$mostra["ra"];
		$_SESSION['email']=$mostra["email"];
		$_SESSION['cpf']=$mostra["cpf"];
		$_SESSION['dataInscricao']=$mostra["dataCadastro"];
		$_SESSION['dataCadastro']=$mostra["dataCadastro"];
		$_SESSION['cidade']=$mostra["cidade"];
		$_SESSION['estado']=$mostra["estado"];
		$_SESSION['fone']=$mostra["telefone"];

		$oficina=mysqli_query($c, "SELECT * FROM ".$ano."_participantes_oficinas WHERE idParticipante=".$_SESSION["id"]) or die(mysqli_error($c));
        
        
	$x=1;
	while($of=mysqli_fetch_array($oficina)){
		$mo=mysqli_query($c, "SELECT * FROM ".$ano."_oficinas WHERE idOficina=".$of["idOficina"]) or die(mysqli_error($c));
		$ofi=mysqli_fetch_array($mo);
		$_SESSION["oficina$x"]=$ofi["oficina"];
		$x++;
	}

	if($_GET["pg"]==""){
		header("location:painel.php");
	}else if($_GET["pg"]=="resumos"){
		header("location:painel.php#editado");
	}

	}else{
		//echo "Usuário não existe";
        		header("location: index.php?erro=1&email=".$mostra["email"]."#login");
	}

?>
