<meta charset="utf8">
<h1>PRESENÇAS NOS MINICURSOS (terça e quinta)</h1>
<?php
include("conexao.php");

$z=1;
    while($z<12){
	$resultado = mysqli_query($c, "SELECT * FROM 2019_oficinas WHERE idOficina=$z") or die (mysqli_error($c));
	$registro = mysqli_fetch_array($resultado);
	
	$curso = $registro["data"] . " - " . $registro["titulo"];
	$ido=$registro["idOficina"];
	echo "<h2>$curso</h2>";


	$y=1;
    if($z!=10){
    $sql_presencas = mysqli_query($c, "SELECT * FROM 2019_participantes_oficinas inner join 2019_participantes on (2019_participantes.id=2019_participantes_oficinas.idParticipante)  WHERE 2019_participantes_oficinas.idOficina=$z AND 2019_participantes_oficinas.presenca=1") or die (mysqli_error($c));
    }else{
$sql_presencas = mysqli_query($c, "SELECT * FROM 2019_participantes_oficinas inner join 2019_participantes on (2019_participantes.id=2019_participantes_oficinas.idParticipante)  WHERE 2019_participantes_oficinas.idOficina=10 AND 2019_participantes_oficinas.presenca=0") or die (mysqli_error($c));
    }
	
	$part = array();
	while($m = mysqli_fetch_array($sql_presencas)){
	    array_push($part,  ucwords(strtolower($m["nome"]))."##".$m["id"]."##".intval($m["ra"]));
	}


	sort($part);

	if(sizeof($part)==0){
	    echo "<font color=red>Nenhum participante presente</font>";
	}else{
	    
	    
	    $x=0;
	    echo "<table>";
	    while($x<sizeof($part)){
		
		$dados = explode("##", $part[$x]);
		$id = $dados[1];
		$ra = $dados[2];
		$nome = $dados[0];
		echo "<tr><td>$y -</td><td>$ra &nbsp;&nbsp;</td><td>$nome</td><td></tr>";
		$x++;
		$y++;
	    }
	    echo "</table>";
	}

	$z++;
	
    }
