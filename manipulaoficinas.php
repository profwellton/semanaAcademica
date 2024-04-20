<?php

session_start();
include 'conexao.php';

if($_GET["id_participante"]=='') $idParticipante=$_SESSION["id"];
else $idParticipante=$_GET['id_participante'];


if($_GET["tipo"]=="inserir"){

	$idOficina[0] = $_POST["oficina0"];
	$idOficina[1] = $_POST["oficina1"];

	$x=0;

	while($x<2){

		if($x==0) $off=1;
		else if($x==1) $off=2;

		echo "INSERT INTO ".$ano."_participantes_oficinas (idParticipante, idOficina) VALUES ($idParticipante, " . $idOficina[$x].")";    

		$teste = mysqli_query($c, "INSERT INTO ".$ano."_participantes_oficinas (idParticipante, idOficina) VALUES ($idParticipante, " . $idOficina[$x].")") or die(mysqli_error($c));

    		$teste = mysqli_query($c, "UPDATE ".$ano."_participantes SET idoficina$off=".$idOficina[$x]." WHERE id=$idParticipante") or die(mysqli_error($c));


		$getvaga = mysqli_query($c, "SELECT vagas FROM ".$ano."_oficinas WHERE idOficina=".$idOficina[$x]) or die(mysqli_error($x));
		$vagas = mysqli_fetch_array($getvaga);
    		$vagas = $vagas["vagas"];
    		$vagas--;
    		mysqli_query($c, "UPDATE ".$ano."_oficinas SET vagas=$vagas WHERE idOficina=".$idOficina[$x]);


		$x++;
	}

}else{


$idOficina = array();

$idOficina[0] = $_POST["oficina0"];
$idOficina[1] = $_POST["oficina1"];


$idOficinaAnterior = array();

$idOficinaAnterior[0] = $_POST["oficinaAnterior0"];
$idOficinaAnterior[1] = $_POST["oficinaAnterior1"];

$id_part_ofi[0] = $_POST["id_part_ofi0"];
$id_part_ofi[1] = $_POST["id_part_ofi1"];

$x=0;

if($_GET["id_participante"]=='') $ate=2;
else $ate=1;

while($x<$ate){

	    
	echo "<hr>$x<hr>";

echo "UPDATE ".$ano."_participantes_oficinas SET idOficina=".$idOficina[$x]." WHERE id=".$id_part_ofi[$x];

    $teste = mysqli_query($c, "UPDATE ".$ano."_participantes_oficinas SET idOficina=".$idOficina[$x]." WHERE id=".$id_part_ofi[$x]) or die(mysqli_error($c));

    
    //Atualiza a(s) oficina(s) em ".$ano."_participantes
    $of = $x+1;
    echo "<br><br>UPDATE ".$ano."_participantes SET idoficina$of='".$idOficina[$x]."' WHERE id='$idParticipante'<br><br>";
    
    $teste = mysqli_query($c, "UPDATE ".$ano."_participantes SET idoficina$of=".$idOficina[$x]." WHERE id=$idParticipante") or die(mysqli_error($c));

    echo "SELECT vagas FROM ".$ano."_oficinas WHERE idOficina=".$idOficina[$x]."<br><br>";
    //diminui uma vaga na oficina escolhida
    $getvaga = mysqli_query($c, "SELECT vagas FROM ".$ano."_oficinas WHERE idOficina=".$idOficina[$x]) or die(mysqli_error($x));

    $vagas = mysqli_fetch_array($getvaga);
    $vagas = $vagas["vagas"];
    $vagas--;
    mysqli_query($c, "UPDATE ".$ano."_oficinas SET vagas=$vagas WHERE idOficina=".$idOficina[$x]);
	echo "UPDATE ".$ano."_oficinas SET vagas=$vagas WHERE idOficina=".$idOficina[$x]."<br><br>";


    //aumenta uma vaga na oficina que não será mais feita
    //echo "aumenta uma vaga na oficina que não será mais feita<br>";
    $getvaga = mysqli_query($c, "SELECT vagas FROM ".$ano."_oficinas WHERE idOficina=".$idOficinaAnterior[$x]);
    echo "SELECT vagas FROM ".$ano."_oficinas WHERE idOficina=".$idOficinaAnterior[$x]."<br>";
    $vagas = mysqli_fetch_array($getvaga);
    $vagas = $vagas["vagas"];

    $vagas++;
    
    mysqli_query($c, "UPDATE ".$ano."_oficinas SET vagas=$vagas WHERE idOficina=".$idOficinaAnterior[$x]);
echo "UPDATE ".$ano."_oficinas SET vagas=$vagas WHERE idOficina=".$idOficinaAnterior[$x];

    $x++;
}
}
if($_GET["m"]==1) echo"<br><span class='verde'>Oficinas cadastradas com sucesso!<br></span>";
if($_GET["m"]==2) echo"<br><span class='verde'>Oficina(s) alterada(s) com sucesso!<br></span>";
if($_GET["err"]==3) echo"<br><span class='vermelho'>Você deve selecionar pelo menos uma oficina!<br></span>";

$_SESSION["mensagem"] = "<br><span class='verde'>Oficina(s) alterada(s) com sucesso!<br></span><br><br>";

header("location:painel.php#participante$idParticipante");

?>
