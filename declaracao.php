<?php

session_start();

$hash = $_GET["hash"];

include("conexao.php");

$query = mysqli_query($c, "SELECT nome, cpf, carga_horaria FROM ".$ano."_participantes WHERE hash='$hash'") or die(mysqli_error($c));
$resultSet = mysqli_fetch_array($query);

$encoding = mb_internal_encoding();

$nome = mb_strtoupper($resultSet['nome'], $encoding);

$cpf = mb_strtoupper($resultSet['cpf'], $encoding);

$validador = $result = substr($hash, 0, 5);
$cargahoraria = $resultSet['carga_horaria'];

//$nome = mb_strtoupper("Cledson Lodi");
//$validador = "ufjdfau";

$html = "<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html;'>
            <title>Certificado</title>
    <style>

    #certificado{
            /*border: 1px solid black;*/
            height: 100px;

            position: absolute;
            margin-top:200px;

    }
    #texto{
            position:absolute;
	font-family: Verdana, Geneva, sans-serif;
            font-size: 20px;
    }
    #coordenacaoEsquerda{
           /* border: 1px solid black;*/
            height: 70px;
            width: 280px;
            position: absolute;
            margin-top:390px;
            margin-left:150px;
    }
    #coordenacaoDireita{
	font-family: Verdana, Geneva, sans-serif;
            /*border: 1px solid black;*/
            height: 70px;
            width: 450px;
            position: absolute;
            margin-top:420px;
            margin-left:260px;
    }
    #codigoValidacao{
	font-family: Verdana, Geneva, sans-serif;
            /*border: 1px solid black;*/
color: white;
     height: 70px;
     width: 750px;
     position: absolute;
     margin-top:640px;
     margin-left:410px;
    }

    p{
            font-size: 35px;
    }
    </style>
    </head>
    <body>
        <div style= 'position:absolute;'>
        <center>
            <img src='modelo.png'>
        </center>
        </div>
        <div id='certificado'>
            <div id='texto'>
                <center><h2>DECLARAÇÃO</h2>
";

if($_GET["idoficina"]==""){
    $html = $html. "               Declaramos que <b>".$nome."</b>, CPF $cpf, participou da I Semana Acadêmica de Informática, realizada pela Universidade Tecnológica Federal do Paraná Campus Francisco Beltrão que ocorreu dia 11, 12 e 13 de abril de 2023.";

}else if($_GET["idoficina"]!=""){

    $oficina = mysqli_query($c, "SELECT * FROM  ".$ano."_oficinas WHERE idOficina=".$_GET["idoficina"]);
    
    $quantas = mysqli_num_rows($oficina);
    
    $oficina = mysqli_fetch_array($oficina);
    
    if($quantas>0){

	$gerar_declaracao = mysqli_query($c, "SELECT * FROM ".$ano."_participantes_oficinas WHERE idParticipante=".$_SESSION['id']." AND idOficina=".$_GET["idoficina"]." AND presenca=1") or die (mysqli_error($c));

	$gerar_declaracao =  mysqli_num_rows($gerar_declaracao);
	
	//	echo utf8_encode("<b>Nome da Oficina: ".$oficina["titulo"]."</b><br>");
	//	echo utf8_encode("Ministrante: "  . $oficina["ministrante"]."<br>");
	//	echo "Sala: " . $oficina["sala"]."<br>";
	//	echo "Data: " . $oficina["data"]."<br>";
	//	echo utf8_encode("Hor&aacute;rio: " . $oficina["horario"]."<br><br>");
	
	
	$html = $html . "               Declaramos que <b>".$nome."</b>, CPF $cpf, participou da oficina intitulada <b>".utf8_encode($oficina['titulo'])."</b> com carga horária de ".$oficina["cargahoraria"].", na I Semana Acadêmica de Informática, realizada pela Universidade Tecnológica Federal do Paraná Campus Francisco Beltrão que ocorreu dia 11, 12 e 13 de abril de 2023.";

    }
}
$html= $html. "									   </center>
            </div>
        </div>
        <div id='coordenacaoDireita'><br><br><br><br>
            <center>
                ______________________________<br />
								<b>Prof. Dr. Wellton Costa de Oliveira</b><br />
                Presidente da Comissão organizadora da  I Semana Acadêmica de Informática da UTFPR Francisco Beltrão.
            </center>
        </div>

        <div id='codigoValidacao'><br><br><br>
	  Verificador: acesse https://salin.fb.utfpr.edu.br/vc/ e use o código: $validador
	</div>

    </body>
</html>
";
?>


<?php
require_once("./dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(utf8_decode($html));
$dompdf->set_paper('letter', 'landscape');
$dompdf->render();
$dompdf->stream("$nome.pdf");
?>
