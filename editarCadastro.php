<!DOCTYPE html>
<html>
    <head>
    <?php include("conexao.php"); ?>
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
        <meta name="author" content="Marcos Marcolin, Rodrigo de Morais e Wellton Costa de Oliveira">

        <!-- ESTILOS CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/header.css" rel="stylesheet" type="text/css" />
        <link href="css/footer.css" rel="stylesheet" type="text/css" />
        <link href="css/nivo-slider.css" rel="stylesheet" type="text/css" />

        <!-- JAVASCRIPT/JQUERY -->
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/script.js" type="text/javascript"></script>
        <!-- script src="js/nivo.slider.js" type="text/javascript"></script-->
        <script>


 function carregaOutro(valor){
     if(valor==6){
	     document.getElementById("curso").innerHTML="";
	     document.getElementById("outro").innerHTML="<input type='text' name='instituicao' class='nome' placeholder='Qual sua Instituição?' required/><br><br> ";
	 }else if(valor==1){
	     document.getElementById("outro").innerHTML="";
	     document.getElementById("curso").innerHTML="<select name='curso' class='oficina' required> <option value='' disabled selected hidden>Seu Curso...</option> <option value='Licenciatura em Informática'>Licenciatura em Informática</option> <option value='Bacharelado em Sistemas de Informação'>Bacharelado em Sistemas de Informação</option> <option value='Agronomia'>Agronomia</option> <option value='Engenharia Ambiental e Sanitária'>Engenharia Ambiental e Sanitária</option> <option value='Engenharia de Alimentos'>Engenharia de Alimentos</option> <option value='Engenharia Química'>Engenharia Química</option></select>  <br><br> ";
         }else{
	     document.getElementById("outro").innerHTML="";
	     document.getElementById("curso").innerHTML="";
	 }
	     
	     
	 }
	 
	 
         var iguais=true;
         function vsenha(senha, repitasenha){
        	if(senha!=repitasenha){
        		document.getElementById("vsenhared").innerHTML="senhas diferentes";
        		document.getElementById("vsenhagreen").innerHTML="";
        		iguais=false;
        	}else{
            if(senha=='' && repitasenha==''){
               document.getElementById("vsenhagreen").innerHTML="";
               document.getElementById("vsenhared").innerHTML="";
            }else{
        		   document.getElementById("vsenhagreen").innerHTML="SENHAS OK";
        		   document.getElementById("vsenhared").innerHTML="";
        		   iguais=true;
            }
        	}

        }

        </script>

        <!-- FONTES EXTERNAS -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>


    </head>
    <body>

    <!-- CABECALHO -->
    <section class="cabecalho">
	     <section class="conteudo">
		      <section class="logo">
			  <a href="painel.php"><img src="img/semana.png" alt="<?=$rom?> Semana Acadêmica de Informática da UTFPR Francisco Beltrão" title="<?=$rom?> Semana Acadêmica de Informática da UTFPR Francisco Beltrão"/></a>
		      </section>

		      <!-- MENU -->
		      <nav class="menu">
			  <ul>
			      <li><a href="painel.php" class="sobre">Meus Dados</a></li>
			      <li><a href="#alterarminicursos" class="sobre">Alterar Oficinas</a></li>
			      <!--li><a href="#editado" class="sobre">Ver Meus Resumos</a></li-->
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

    <section class="corpo">
        <section class="conteudo" id="sobre">
        	<!-- DADOS DO EVENTO -->

          <section class="conteudo" >
            <!-- INSCRIÇÕES -->
		        <section class="inscricoes" id="inscricoes">
                <h2>Editar Dados</h2><br>
                <section class="formulario">
                    <span class='vermelho'>
                      <?php
                         include 'conexao.php';
                         echo $_SESSION["m"];
                         $_SESSION["m"]="";
                         session_start();
		                     $sql = mysqli_query($c, "SELECT * FROM  ".$ano."_participantes WHERE id=".$_SESSION['id']) or die(mysqli_error($c));
		                     $mostra = mysqli_fetch_array($sql);
                      if($_GET["erro"]==3) echo "<div class='mVermelho'>Senhas diferentes. Devem ser iguais.</div>";
		                     if($_GET["m"]=="ok") echo "<span id='vsenhagreen'>Seus dados foram atualizados com sucesso</span>";
                      ?>
			<!--form method="POST" onsubmit="if(iguais){return true;}else{alert('SENHAS DIFERENTES');return false;}" action="editarCadastroBanco.php?id=<?php echo $_SESSION['id']; ?>"><br><br-->

			<form method="POST"  action="editarCadastroBanco.php?id=<?php echo $_SESSION['id']; ?>"><br><br>
			    
			    <input  value="<?php echo $mostra['nome']; ?>" type="text" id="nome" name="nome" class="nome" placeholder="Nome completo..." required  /><br><br>
                            <input  value="<?php echo $mostra['ra']; ?>" type="text" id="ra" name="ra" class="ra" placeholder="Código do Crachá (para Servidores e Alunos da UTFPR)"  /><br><br>
                            <input  value="<?php echo $mostra['cpf']; ?>" type="text" id="cpf" name="cpf" class="cpf" placeholder="CPF..." required /><br><br>
                            <input  value="<?php echo $mostra['email']; ?>" type="email" id="email" name="email" class="email" placeholder="Email..." required/><br><br>
                            <!-- input  value="" type="password" id="senha" name="senha" class="senha" placeholder="Senha..." onkeyup="vsenha(document.getElementById('repitasenha').value, this.value)"/>
				 <input  value="" type="password" id="repitasenha" name="repitasenha" class="senha" placeholder="Repita Senha..." onkeyup="vsenha(document.getElementById('senha').value, this.value)"  /> <span id='vsenhared' class='vermelho'></span><span id='vsenhagreen' class='verde'></span>
				 <br><br-->

                            <!-- input  value="<?php echo $mostra['instituicao']; ?>" type="text" id="instituicao" name="instituicao" class="instituicao" placeholder="Instituição..."  /-->
			    <?php 
			    $query = mysqli_query($c, "SELECT * FROM ".$ano."_instituicoes ORDER BY id") or die(mysqli_error($c));
			    
			    echo "<select name='instituicao' class='oficina' onchange=\"carregaOutro(this.value)\">";
				echo "      <option value='' disabled selected hidden>Sua instituição...</option>";
				while($ver = mysqli_fetch_array($query)){

				if($mostra['instituicao']==$ver["id"]) $selected="selected";
				else $selected="";
				
				echo "<option id='instituicao".$ver["id"]."'   value='".$ver["id"]."' $selected>".utf8_encode($ver["nome"])."</option>";
				}

				echo "</select><br><br>";

			    ?>
			    <!-- input type="text" name="instituicao" class="nome" placeholder="INSTITUIÇÃO"/><br><br -->
			    <span id="outro">
				<?php
				if($mostra["instituicao"]==1){
				    $curso = $mostra["curso"];
				    if($curso=="Licenciatura em Informática"){ $s1 = "selected"; $s2=""; $s3=""; $s4=""; $s5 = "";$s6="";
				    }else
 				    if($curso=="Bacharelado em Sistemas de Informação"){ $s1 = ""; $s2="selected"; $s3=""; $s4=""; $s5 = "";$s6="";
				    }else
 				    if($curso=="Agronomia"){ $s1 = ""; $s2=""; $s3="selected"; $s4=""; $s5 = "";
				    }else
 				    if($curso=="Engenharia Ambiental e Sanitária"){ $s1 = ""; $s2=""; $s3=""; $s4="selected"; $s5 = "";$s6="";
				    }else
 				    if($curso=="Engenharia de Alimentos"){ $s1 = ""; $s2=""; $s3=""; $s4=""; $s5 = "selected"; $s6="";
				    }else
 				    if($curso=="Engenharia Química"){ $s1 = ""; $s2=""; $s3=""; $s4=""; $s5 = ""; $s5="";$s6="selected";
				    }
				    
				?>
				<select name='curso' class='oficina' required> <option value='' disabled selected hidden>Seu Curso...</option> <option value='Licenciatura em Informática' <?=$s1?>>Licenciatura em Informática</option> <option value='Bacharelado em Sistemas de Informação' <?=$s2?>>Bacharelado em Sistemas de Informação</option> <option value='Agronomia' <?=$s3?>>Agronomia</option> <option value='Engenharia Ambiental e Sanitária' <?=$s4?>>Engenharia Ambiental e Sanitária</option> <option value='Engenharia de Alimentos' <?=$s5?>>Engenharia de Alimentos</option> <option value='Engenharia Química' <?=$s6?>>Engenharia Química</option></select>  <br><br> 
		<?php 		} ?></span>
			    <span id="curso"></span>                        
                         
<select name="estado" id="cod_estados" class="estado"  placeholder="Estado">
    <option value="">Estado...</option>
    <?php
    $sql = "SELECT cod_estados, nome, sigla
        FROM estados
        ORDER BY sigla";
    $res = mysqli_query( $c, $sql );
    while ( $row = mysqli_fetch_array( $res ) ) {

	
      	if($mostra['estado']==$row["cod_estados"]) $selected="selected";
	else $selected="";
	
	echo "<option value='".$row['cod_estados']."' $selected>".utf8_encode($row['nome'])."</option>";
    }
    ?>
  </option>
</select><br><br>
<?php  if($mostra['cidade']==''){ ?>
<select name="cod_cidades" id="cod_cidades" class="estado">
    <option value="">-- Escolha um estado --</option>
</select>
<?php

}else {


    $cod_estados = $mostra['estado'];

    $sql = "SELECT cod_cidades, nome
    FROM cidades
    WHERE estados_cod_estados=$cod_estados
    ORDER BY nome";

    $res = mysqli_query( $c, $sql );

    echo "<select name='cod_cidades' id='cod_cidades' class='estado'>
    <option value='' disabled selected hidden>Escolha sua cidade...</option>";
    while ( $row = mysqli_fetch_array( $res ) ) {

	if($mostra['cidade']==$row["cod_cidades"]) $selected="selected";
	else $selected="";

	echo "<option value='".$row['cod_cidades']."' $selected>".utf8_encode($row['nome'])."</option>";
    }
    echo "</select>";

}

?>
    
                       <!--input type="text" name="cidade" class="cidade" placeholder="Cidade" value="<?php echo $mostra['cidade']; ?>"/-->
                       
                       <br><br>
<center><input type="submit" class="btn_enviar" value="Editar meus dados" />
                  </center>
		              </form>
                </section>
            </section>
        </section>
        <div class="clear"></div>
    </section>
    <!-- RODAPE -->
    <?php
        include 'footer.php';
    ?>
    <div class="clear"></div>
    </div>
</body>

</html>
