<!DOCTYPE html>
<html>
    <head>
        <title>IV Colin Camp 2016</title>

        <!-- FAVICON -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <!-- TAGS -->
        <meta charset="UTF-8">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta http-equiv="content-language" content="pt-br">
        <meta name="generator" content="NetBeans 8.x">
        <meta name="author" content="Marcos Marcolin e Wellton Costa de Oliveira">

        <!-- ESTILOS CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/header.css" rel="stylesheet" type="text/css" />
        <link href="css/footer.css" rel="stylesheet" type="text/css" />
        <link href="css/nivo-slider.css" rel="stylesheet" type="text/css" />

        <!-- ESTILOS CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/header.css" rel="stylesheet" type="text/css" />
        <link href="css/footer.css" rel="stylesheet" type="text/css" />
        <link href="css/nivo-slider.css" rel="stylesheet" type="text/css" />

        <!-- JAVASCRIPT/JQUERY -->
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/script.js" type="text/javascript"></script>
        <script src="js/nivo.slider.js" type="text/javascript"></script>

        <!-- FONTES EXTERNAS -->
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    </head>
<body>
     <!-- CABECALHO -->
  <!-- CABECALHO -->
   <section class="cabecalho">
	<section class="conteudo">
		<section class="logo">
			<a href="painel.php"><img src="img/logo.png" alt="III Colin Camp 2015" title="IV Colin Camp 2016" /></a>
		</section>
		<!-- MENU -->
		<nav class="menu">
		  <ul>
		    <li><a href="painel.php#editado" class="sobre">Ver seus trabalhos</a></li>

		      <a href="painel.php#envia"  class="programacao">Enviar Trabalhos</a></li>
<li><a href="todosresumos.php" target="_blank" class="minicursos">TODOS OS TRABALHOS</a></li>
		<li><a href="logout.php" class="minicursos">Sair</a></li>
	</ul>
	</nav>
	</section>
</section>
	<div class="clear"></div>

  <?php
  	mysql_connect("localhost", "salin", "S@l1n");
	mysql_select_db("salin");
	session_start();
    ?>

    <!-- CORPO -->
    <section class="corpo">
        <section class="conteudo">
            <section class="programacao">
                <!--h2>Programação III WCTI</h2><br--><br>
<center>
               <script>
	function confirmar(idParticipante, idResumo, titulo) {
		var resposta = confirm("Tem certeza em deletar o resumo '"+titulo+"'?")
		if (resposta){
			window.location = "deletarResumo.php?idParticipante="+idParticipante+"&idResumo="+idResumo;
		}
	}


	function gerarLink(hash){
		//prompt();
	}
</script>

<?php
    $tipo = $_SESSION["tipo"];
    //0 - usuário normal, não pode ver essa parte
    //1 - comissão científica - pode ver a lista de trabalhos e download de pdf
    //2 - administrador do sistema - pode ver tudo


    $result = mysql_query("SELECT * FROM 2016_resumos ORDER BY pasta") or die(mysql_error());


    if($tipo==2 || $tipo==3){
      echo "<a target='_BLANK' href='todoslinks.php'>BAIXAR TODOS OS LINKS</a>";

    }


    if($tipo==3){
      echo "<a href='fpdf/todos.php?nome=com'>BAIXAR TODOS COM NOME<img src='img/downloadResumo.png'></a>";
      echo "<a href='fpdf/todos.php?nome=sem'>BAIXAR TODOS SEM NOME<img src='img/downloadResumo.png'><br></a><br>";
      echo "<a href='todosResumos.php?tipo=orais'>VER ORAIS<img src='img/downloadResumo.png'></a>";
      echo "<a href='todosResumos.php?tipo=posteres'>VER POSTERES<img src='img/downloadResumo.png'></a>";
    }

		echo "<table border='1'>";

    if($tipo==2 || $tipo==3){

	echo "<tr> <th></th><th>Link do Grupo de Pesquisa</th><th>Pasta</th> <th>T&iacute;tulo</th><th>Autores</th><th>com nome</th><th>sem nome</th><th>Texto sem nome</th> </tr>";
    }else{
	echo "<tr> <th></th><th>Pasta</th> <th>T&iacute;tulo</th><th>Autores</th><th>com nome</th><th>sem nome</th><th>Texto sem nome</th></tr>";

    }
		$i=1;
		while($row = mysql_fetch_array( $result )) {
			$autores = explode("____", $row['autores']);

if($row['grupo']!='')
      $link = "</td><td><a href='".$row['grupo']."' target='_BLANK'> Clique Aqui </a>";
else{
    $link = "</td><td></a>";
}

			echo "<tr><td>";
			echo $i;
      echo $link;
      echo "</td><td>";
			echo $row['pasta'];
			echo "</td><td>";
			echo $row['titulo'];

			$pegaEmail = mysql_query("SELECT email FROM 2016_participantes WHERE id=".$row['idParticipante']);


			echo "</td><td width=200>";
			for($x=0; $x<100; $x++){
			        if($x==0) $ema = " (".mysql_result($pegaEmail, 0, "email")." )";
			        else $ema="";

				if($autores[$x]!="") echo $autores[$x]  . "$ema<br>";
			}
		?>
		</td>

<?php
    if($tipo==3){
?>
		<td>
	        <a href="editarResumo.php?idParticipante=<?php echo $_SESSION['codigo']; ?>&idResumo=<?php echo $row['id']; ?>">
                <img src='img/editar.png' width=30>
            </a>
	    </td>
		<td>
	        <a href="javascript:confirmar(<?php echo $row['idParticipante']; ?>, <?php echo $row['id']; ?>, '<?php echo $row['titulo']; ?>')">
                <img src='img/excluir.png' width=30>
            </a>
	    </td>
<?php
}
?>


		<td align='center'>
			<a href="fpdf/pdf.php?id=<?php echo $row['id']; ?>&nome=com"><img src='img/downloadResumo.png' width=30></a>
		</td>
		<td align='center'>
			<a href="fpdf/pdf.php?id=<?php echo $row['id']; ?>&nome=sem"><img src='img/downloadResumo.png' width=30></a>
		</td>

<?php
    if($tipo==3){
?>
    <td align='center'>
      <?php
        $certificado = $row["certificado"];
        if($certificado!=""){
          echo "<a href='$certificado'>Download Certificado</a>";
        }
      ?>
    </td>
<?php
}
?>

      <td align='center'>
      <?php
         $trecho=substr($row["titulo"], 0, 25);
	 $md5=$row["md5"];
      ?>
      <a href="vertexto.php?codigo=<?=$md5?>" target="_BLANK"><img src="img/txt.png" width=30></a>
    </td>
	</tr>
	<?php
		$i++;
	}
	echo "</table>";

?>


            </section>
        </section>
        <div class="clear"></div>
    </section>
    <!-- RODAPE -->
    <?php
        include 'footer.php';
    ?>
    <div class="clear"></div>

<div id="boxes">




        </section>
        <div class="clear"></div>
    </section>

    <div class="clear"></div>
</body>
</html>
