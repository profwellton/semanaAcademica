<?php


#$nome = $_GET['nome'];
#$horas = $_GET['horas'];

$hash = $_GET["hash"];


include("conexao.php");
$query = mysqli_query($c, "SELECT * FROM ".$ano."_atividades WHERE hash='$hash'") or die(mysqli_error($c));
$resultSet = mysqli_fetch_array($query);


$encoding = mb_internal_encoding();

$palestrante = mb_strtoupper(utf8_encode($resultSet['palestrante']), $encoding);
$atividade = mb_strtoupper(utf8_encode($resultSet['atividade']), $encoding);
$id = $resultSet['id'];
$tipo = $resultSet['tipo'];
$singular_plural = $resultSet['singular_plural'];


$validador = $result = substr($hash, 0, 5);

if($tipo!="palestra" || $tipo!="oficina"){

    $oq="realizou";
    $tipo="apresentação cultural";

    
}else{
    if($singular_plural=="singular" && $tipo == "palestra") $oq = "proferiu";
    else if($singular_plural=="plural" && $tipo == "palestra") $oq = "proferiram";
    else if($singular_plural=="singular" && $tipo == "oficina") $oq = "ministrou";
    else if($singular_plural=="plural" && $tipo == "oficina") $oq = "ministraram";
}

if($id=="8"){$cargahoraria="2h30";}
else if($id=="14"){$cargahoraria="2h30";}
else if($id=="16"){$cargahoraria="2h00";}
else {$cargahoraria="1h30";}

$html = "<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF8'>
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
            font:Tahoma;
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
            /*border: 1px solid black;*/
            height: 70px;
            width: 280px;
            position: absolute;
            margin-top:390px;
            margin-left:510px;
    }
    #codigoValidacao{
            /*border: 1px solid black;*/
     height: 70px;
     width: 800px;
     position: absolute;
     margin-top:640px;
     margin-left:180px;
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
<center>

<h2>DECLARAÇÃO</h2>
<br>
Declaramos que <b>".$palestrante."</b>, $oq a <b>$tipo</b> intitulada <b>$atividade</b> na VIII Semana Acadêmica de Licenciatura em Informática (2021), realizada pela Universidade Tecnológica Federal do Paraná, Campus Francisco Beltrão, nos dias 04, 05, 06 e 07 de Agosto de 2021, com carga horária de $cargahoraria horas.
                </center>
            </div>
        </div>
<div id='coordenacaoEsquerda'><br><br><br><br>
            <center>
            ______________________________<br />
            <b>Mayara Cristina Pereira Yamanoe</b><br />
						Coordenadora do Curso de Licenciatura em Informática
            </center>
        </div>
        <div id='coordenacaoDireita'><br><br><br><br>
            <center>
                ______________________________<br />
								<b>Wellton Costa de Oliveira</b><br />
                Coordenador da VIII Semana Acadêmica de Licenciatura em Informática (2021)
            </center>
        </div>

        <div id='codigoValidacao'><br><br><br>
	  Para verificar validade desta declara&ccedil;&atilde;o, acesse https://salin.fb.utfpr.edu.br/vc/ e use o código: $validador
	</div>

    </body>
</html>
";
?>
<?php

require_once("./dompdf/dompdf_config.inc.php");

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper('letter', 'landscape');
$dompdf->render();
$dompdf->stream("$palestrante.pdf");
?>
