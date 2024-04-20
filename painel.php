<?php
session_start();
if($_SESSION["id"]=="") header("location:index.php");

include("conexao.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- TÍTULO DA PÁGINA -->
        <title><?=$rom?> Semana Acadêmica de Informática da UTFPR Francisco Beltrão</title>

        <!-- FAVICON -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	
        <!-- TAGS -->
        <meta charset="UTF-8">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta http-equiv="content-language" content="pt-br">
        <meta name="generator" content="NetBeans 8.x">
        <meta name="author" content="Rodrigo Moreira, Marcos Marcolin e Wellton Costa de Oliveira">
	
        <!-- ESTILOS CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/header.css" rel="stylesheet" type="text/css" />
        <link href="css/footer.css" rel="stylesheet" type="text/css" />
        <link href="css/nivo-slider.css" rel="stylesheet" type="text/css" />
	
        <!-- JAVASCRIPT/JQUERY -->
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/script.js" type="text/javascript"></script>
        <script src="js/nivo.slider.js" type="text/javascript"></script>
    	<script src="js/jquery.anchor.js" type="text/javascript"></script>
	
        <!-- FONTES EXTERNAS -->
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
	<!-- CABECALHO -->
	<section class="cabecalho">
            <section class="conteudo">
		<section class="logo" id="topo">
		    <a href="painel.php"><img src="img/banner_f.png" alt="<?=$rom?> Semana Acadêmica de Informática" title="<?=$rom?> Semana Acadêmica de Informática da UTFPR Francisco Beltrão" /></a>
		</section>
		<!-- MENU -->
		<nav class="menu">
		    <ul>
			<li><a href="#meusdados" class="sobre">Meus Dados</a></li>
			<li><a href="#alterarminicursos" class="sobre">Cadastrar-se em Oficinas</a></li>
			<?php
session_start();
if($_SESSION["id"]!="1"){

//echo "É possível apenas no dia do evento.";
}else{
?>

			<li><a href="#presencas" class="sobre">Presenças</a></li>
			<?php } ?>
			<!--li><a href="#envia"  class="programacao">Enviar Resumo</a></li-->
			<?php
    			$tipo = $_SESSION["tipo"];
  			if($tipo=="2" || $tipo=="3")
  		            //echo "<li><a href='todosresumos.php' target='_blank' class='minicursos'>TODOS OS TRABALHOS</a></li>";
			    echo "<li><a href='#cadastrarminicurso' class='minicursos'>Cadastrar Oficina</a></li>";
			?>
			<li><a href="logout.php" class="minicursos">Sair</a></li>
		    </ul>
		</nav>
	    </section>
	</section>
	<!-- CORPO -->
	<section class="corpo">
            <section class="conteudo"  id="meusdados">
		<center> <br> <hr>
		    <?php
	            include 'dados.php';
		    echo "<br><br><hr><br><span id='alterarminicursos'></span>";

		    include 'paineloficinas.php';
		    //echo "<br><br><hr><br>";
		    //include 'meusresumos.php';
		    echo "<br><br><hr><br>";
		    //if($_GET["trabalho"]==""){
		    //include 'enviarresumo.php';
		    // echo "<h3><span class='vermelho'>
		    //SUBMISSÕES DE TRABALHOS ENCERRADAS
		    //</span></h3><br><br><br>";
		    //}else{
		    // $_SESSION["trabalho"]=$_GET["trabalho"];
		    // include 'editarresumo.php';
		    // }
		    
		   	include 'programacao.php';
		   
		 if($_SESSION["tipo"]=="1"){
		    	include("cadastrarAtividade.php");
   			    echo "<br><br><br> <hr> <br><br><br>";
			include("cadastrarOficinas.php");
   			    echo "<br><br><br> <hr> <br><br><br>";
		    }
		    
		    if($_SESSION["tipo"]=="1" || $_SESSION["tipo"]=="2" || $_SESSION["tipo"]==10){
 			    include("ver_inscritos.php");
    		    echo "<br><br><br> <hr> <br><br><br>";
 			}

		    //echo "<br><br><br><br><br><br><br><br><br><br><br><br>";


		    if($_SESSION["tipo"]=="1" || $_SESSION["tipo"]=="2")
 			include("presencas.php");

		    echo "<br><br><br> <hr> <br><br><br>";

		    if($_SESSION["tipo"]=="1" || $_SESSION["tipo"]=="2")
 			include("presencasoficinas.php");

		    //echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
		    ?>

		</center>
	    </section>
	</section>
	<!-- RODAPE -->
	<?php include 'footer.php'; ?>
	<div class="clear"></div>
	</div>
    </body>
</html>
