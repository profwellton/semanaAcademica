<?php

session_start();

$nome=$_POST['nome'];
$ra=$_POST['ra'];
$cpf=$_POST['cpf'];
$email=$_POST['email'];
$senha=crypt($_POST['senha']);
$instituicao=$_POST['instituicao'];
$curso=$_POST['curso'];

$cidade=$_POST['cidade'];
$estado=$_POST['estado'];

echo $_POST['oficina'];

$oficinavagas1=$_POST['oficina'][0];
$oficinavagas2=$_POST['oficina'][1];
$partes = explode("#", $oficinavagas1);
$hash =  md5($ra.$nome.$cpf);

$oficina1=$partes[0];
$vagas1=$partes[1];

$partes = explode("#", $oficinavagas2);
$oficina2=$partes[0];
$vagas2=$partes[1];

include("conexao.php");

//verifica se existe
$sql = mysqli_query($c, "SELECT * FROM ".$ano."_participantes WHERE cpf='$cpf' OR email='$email'") or die(mysqli_error($c));
$existe = mysqli_num_rows($sql);
if($existe>0){
    $_SESSION["mensagem"]="<div class='vermelho'>Você já se inscreveu anteriormente na $rom Semana Acadêmica de informática.</div>";
    header("location: index.php#inscricoes");

}else{

    if($oficina1 == '') $oficina1=0;
    if($oficina2 == '') $oficina2=0;
    
    $sql = mysqli_query($c, "INSERT INTO ".$ano."_participantes(hash, nome,ra, cpf, email, senha, tipo, instituicao, curso, cidade, estado, idoficina1, idoficina2) VALUES('$hash', '$nome','$ra', '$cpf', '$email', '$senha', 0, '$instituicao','$curso', '', '', '$oficina1', '$oficina2')") or die(mysqli_error($c));
    
    $idParticipante = mysqli_insert_id($c);

    $vagas1--;
    mysqli_query($c, "UPDATE ".$ano."_oficinas SET vagas=$vagas1 WHERE idOficina='$oficina1'");

    $vagas2--;
    mysqli_query($c, "UPDATE ".$ano."_oficinas SET vagas=$vagas2 WHERE idOficina='$oficina2'");

    
    
    $sql = mysqli_query($c, "INSERT INTO ".$ano."_participantes_oficinas(idParticipante, idOficina, presenca, certificado) VALUES('$idParticipante', $oficina1, 0, ''), ('$idParticipante', $oficina2, 0, '') ") or die(mysqli_error($c));

    if($sql)
        $_SESSION["mensagem"]="<div class='verde'>Seu cadastro na $rom semana acadêmica de informática foi realizada com sucesso!!!</div>";
    else
        $_SESSION["mensagem"]="<div class='vermelho'>Cadastro não efetuado. Tente novamente</div>";


     $sql = mysqli_query($c, "SELECT * FROM ".$ano."_participantes WHERE email='$email'") or die (mysqli_error($c));
    $mostra=mysqli_fetch_array($sql);

    //echo "LOGIN OK";
    session_start();

    $_SESSION['tipo'] = $mostra["tipo"];
    $_SESSION['id'] = $mostra["id"];
    $_SESSION['nome']=$mostra["nome"];
    $_SESSION['instituicao']=$mostra["instituicao"];
    $_SESSION['curso']=$mostra["curso"];
    $_SESSION['ra']=$mostra["ra"];
    $_SESSION['email']=$mostra["email"];
    $_SESSION['cpf']=$mostra["cpf"];
    $_SESSION['dataInscricao']=$mostra["dataCadastro"];
    $_SESSION['dataCadastro']=$mostra["dataCadastro"];
    $_SESSION['cidade']=$mostra["cidade"];
    $_SESSION['estado']=$mostra["estado"];
    $_SESSION['fone']=$mostra["telefone"];

    header("location:painel.php");

}

?>
