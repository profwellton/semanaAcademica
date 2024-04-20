<?php

session_start();
if($_SESSION["id"]=="") header("location:index.php");

include("conexao.php");

if($_GET["oficina"]==""){
    $codigooficinas = mysqli_query($c, "SELECT * FROM ".$ano."_oficinas ORDER BY dia ASC") or die(mysqli_error($c));   
    echo "<h1>Inscritos nas oficinas da $rom Semana Acadêmica de Informática da UTFPR Francisco Beltrão</h1>";
}else{
    $codigooficinas = mysqli_query($c, "SELECT * FROM ".$ano."_oficinas WHERE idOficina=".$_GET["oficina"]." ORDER BY dia ASC") or die(mysqli_error($c));

    echo "<h1>Inscritos nas oficinas da $rom Semana Acadêmica de Informática da UTFPR Francisco Beltrão</h1>";
}
echo "<table>";
while($mostraoficinas=mysqli_fetch_array($codigooficinas)){

    $inscritos=array();
    
    echo "<tr><td colspan=2><br><br><b>".$mostraoficinas["dia"]."/04 às ".$mostraoficinas["horario"]." - ".$mostraoficinas["titulo"]." - ".$mostraoficinas["sala"]."<br>Ministrante(s): ".$mostraoficinas["ministrante"]."</b><br><br></td></tr>";

    
    $codigoinscritos=mysqli_query($c, "SELECT * FROM ".$ano."_participantes_oficinas WHERE idOficina=".$mostraoficinas["idOficina"]);


    while($mostrainscritos=mysqli_fetch_array($codigoinscritos)){		
        
        $codigoparticipantes=mysqli_query($c, "SELECT * FROM ".$ano."_participantes WHERE id=".$mostrainscritos["idParticipante"]);
        $mostraparticipantes=mysqli_fetch_array($codigoparticipantes);


        $cod_participante = $mostraparticipantes["id"];
        $nome = strtoupper($mostraparticipantes["nome"]);
		$codigo_barras = $mostraparticipantes["ra"];
        $faltam = 11 - strlen($codigo_barras);
		$codigo_barras= str_pad( @$input, $faltam, "0", STR_PAD_LEFT).$codigo_barras;


        $inscrito = ucwords(strtolower($mostraparticipantes["nome"] )) . " - " . ucwords(strtolower($mostraparticipantes["email"] )) . " - " . $codigo_barras;
        //$inscrito = ucwords(strtolower($mostraparticipantes["nome"] ));
        
        array_push($inscritos, $inscrito);


    }
    
    sort($inscritos);
    $x=1;
    foreach ($inscritos as $chave => $inscrito) {
	
	
	if(@$_GET["email"]!=0)
	    echo explode(" - ", $inscrito)[1] . ", ";

    $barra = "<img src='codigo_de_barras.php?codigoBarra=". explode(" - ", $inscrito)[2] ."' width=150></center>";
	echo "<td><pre>$barra ".$x . " - ".explode(" - ", $inscrito)[0]."</pre></td><td>______________________________________</td></tr>";
	$x++;

    }

    
        
}

echo "</table>"	;
?>
