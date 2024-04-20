<?php
session_start();
	if($_SESSION['id']!=""){
	  header("location:painel.php");
	}

?>
<!DOCTYPE html>
<html>
    <head>
        <!-- TÍTULO DA PÁGINA -->
        <title>Nova Senha</title>

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

        <!-- JAVASCRIPT/JQUERY -->
        <script src="js/script.js" type="text/javascript"></script>

        <!-- FONTES EXTERNAS -->
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    </head>
<body>
    <!-- CABECALHO -->
    <?php
        include 'header.php';

	$pg = $_GET['pg'];

    ?>

    <!-- CORPO -->
    <section class="corpo">
        <section class="conteudo">
            <section class="programacao">
                            <h2>Alterar Senha</h2><br>



                    <!-- FORM LOGIN -->
                    <section class="form_login">
			<script>
			 var iguais=true;
			 function vsenha(senha, r_senha){
			     
			     if(senha!=r_senha){
				 document.getElementById("vsenhared").innerHTML="Senhas diferentes";
				 document.getElementById("vsenhagreen").innerHTML="";
				 iguais=false;
			     }else{
				 document.getElementById("vsenhagreen").innerHTML="Senhas iguais";
				 document.getElementById("vsenhared").innerHTML="";
				 iguais=true;
			     }
			 }
			</script>

			<section class="inscricoes">

			    <section class="formulario" id="inscricoes">

				<form action="alterando_senha.php" method="POST">
                                         <input type="hidden" name="hash" value="<?=$_GET['hash']?>">
                                                                               <input type="hidden" name="email" value="<?=$_GET['email']?>">
                                                                                                                      <input type="password" name="senha" placeholder="Nova Senha..." id="senha" onkeyup="vsenha(document.getElementById('r_senha').value, this.value)" size="30"  /><br><br>
                                                                                                                                                                                                                                                                            
                            <input type="password"  name="r_senha" placeholder="Repita a Senha..." id="r_senha" onkeyup="vsenha(document.getElementById('senha').value, this.value)" size="30"/>
			    <br>
			    <span id='vsenhared' class='vermelho'></span>
			    <span id='vsenhagreen' class='verde'></span>
			    <br>
			    <input type="submit" onclick="if(!iguais){ alert('Senhas diferentes');return false;}" name="btn_cad" class="btn btn-cad" value="Alterar Senha" />
			</form>
			    </section>
			</section>
                    <center>
                <section class="box-inscricao">
                    <a href="index.php#inscricoes">Inscreve-se na Semana Acadêmica de Informática da UTFPR/FB</a>
                </section>
            </section>
                </aside>
            </aside>
        </div>

        </section>
        <div class="clear"></div>
    </section>
    <!-- RODAPE -->
    <?php
        include 'footer.php';
    ?>
    <div class="clear"></div>
</body>
</html>


      
