<?php $limit=150; ?>
<html>
    <head>
	<meta charset="utf8">

	<style>
         html, body, div, span, applet, object, iframe,
         h1, h2, h3, h4, h5, h6, p, blockquote, pre,
         a, abbr, acronym, address, big, cite, code,
         del, dfn, em, font, img, ins, kbd, q, s, samp,
         small, strike, strong, sub, sup, tt, var,
         dl, dt, dd, ol, ul, li,
         fieldset, form, label, legend,
         table, caption, tbody, tfoot, thead, tr, th, td {
             margin: 0;
             padding: 0;
             border: 1;
             outline: 0;
             font-weight: inherit;
             font-style: inherit;
	     font-size: 100%;
             font-family: arial;
             vertical-align: baseline;
         }
         #nome{
             /*            border: 1px solid black;*/
             height: 0px;
             width: 200px;
             position: absolute;
             margin-top:20px;
             margin-left:30px;

             /*            padding-top: 10px;
                padding-bottom: 10px;*/
         }
         #nomeGrande{
             /*            border: 1px solid black;*/
             height: 0px;
             width: 200px;
             position: absolute;
             margin-top:20px;
             margin-left:30px;

             /*            padding-top: 10px;
                padding-bottom: 10px;*/
         }
         #codigoBarra{
             //border: 1px solid black;
             height: 10px;
             width: 200px;
             position: absolute;
             margin-top:150px;
             margin-left:50px;
	     font-size: 23px;
             padding-top: 10px;
             padding-bottom: 10px;
         }
         #codigoBarra2{
             //border: 1px solid black;
             height: 10px;
             width: 200px;
             position: absolute;
             margin-top:0px;
             margin-left:0px;
	     font-size: 23px;
             padding-top: 10px;
             padding-bottom: 10px;
         }

       	 }
         p{
             font-size: 3px;

         }

	</style>
	<head>
            <title>Crachá</title>
            <?php

	    ini_set('display_errors',1);
	    ini_set('display_startup_erros',1);
	    error_reporting(E_ALL);


	    $hash = @$_GET["hash"];
	    include("conexao.php");
	    if($hash==""){
		$consulta = mysqli_query($c, "SELECT * FROM ".$ano."_participantes ORDER BY nome LIMIT $limit") or die('Consulta não realizada.'.  mysqli_error($c));
	    }else{
		$consulta = mysqli_query($c, "SELECT * FROM ".$ano."_participantes WHERE hash='$hash'") or die('Consulta não realizada.'.  mysqli_error($c));
	    }

	    $x=1;
	    $y=1;
	    $z=1;

            while($r = mysqli_fetch_array($consulta)){

	        $cod_participante = $r["id"];
       		$nome = strtoupper($r["nome"]);
		$codigo_barras = $r["ra"];


		$faltam = 11 - strlen($codigo_barras);

		$codigo_barras= str_pad( @$input, $faltam, "0", STR_PAD_LEFT).$codigo_barras;

	    ?>

	</head>

	<body>

            <span id="cracha">

		<?php
		//if($hash != "") $barra = "codigoBarra2";
		//else $barra = "codigoBarra";
		$barra = "codigoBarra";
		?>
		<span id="<?=$barra?>">
		    <?php
		    
		    strtoupper($nome);
		    if((($x-1)%4 == 0) && $x!=1) $br = "<br>";
		    else $br="";
		    $nome=
			"<span id=\"nome\">
                <center>$br<b>$nome</b><br><br><img src='codigo_de_barras.php?codigoBarra=$codigo_barras' width=200></center>
            </span>";
		    echo "$nome";
		    $espaco="";
		    
		    $z++;
		    ?>
		</span>
		<?php //if($hash==""){ ?>
		    <img src="img/cracha.png" width="355">
		<?php  //}  ?>
		<?php if($x%2==0) echo "<br>"; ?>
            </span>
	    <?php 
	    $x++;

	    } ?>

    </body>

</html>
