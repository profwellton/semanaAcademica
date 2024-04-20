<?php
session_start();
include 'conexao.php';

$sql = mysqli_query($c, "SELECT * FROM  ".$ano."_participantes WHERE id=".$_SESSION['id']) or die(mysqli_error($c));
$mostra = mysqli_fetch_array($sql);
$hash=$mostra["hash"];

$comprovante = $mostra["comprovante"];
$confirmacao = $mostra["confirmacao"];
$pagamento = $mostra["pagamento"];

?>

<table>
    <tr>
	<td>
	    <div id="texto">
		<?php
		//if($_SESSION["inscrito"]!=""){
		//    echo "<h2><span class=verde>PARABÉNS!! SUA INSCRIÇÃO FOI REALIZADA COM SUCESSO.</h2><br>";
		//}

		echo $_SESSION["mensagem"]."<br><br>";

		$_SESSION["mensagem"]="";

		if($mostra["instituicao"]==2 || $mostra["instituicao"]==3 || $mostra["instituicao"]==4 ||  $mostra["instituicao"]==5){
		    echo "<span class=verde>Fique tranquilo, para estudantes da rede estadual, a inscrição é <strong>gratuita</strong>. Aproveite o evento.</span><br><br>";
		}else{
		    
		    if($comprovante=="" && $confirmacao==0 && $pagamento==0)
			echo "<b><span class=vermelho>FASE 1: Para efetivar a inscrição é necessário realizar o pagamento ao CASIS.</span> <br><br> Responsáveis: Caio Vilela da Rocha (‪11 94595‑0710‬); Andréia de Almeida Teixeira (46 99242765).</b><br><br>";

		else if($comprovante!="" && $confirmacao==0 && $pagamento==0)

		    echo "<b><span class='azul'>FASE 2: Comprovante enviado. <a href='$comprovante' target='_BLANK'><span class=azul>Clique aqui para ver seu comprovante</span></a>. Agora, o CASIS irá confirmar o comprovante enviado. Por favor, aguarde!</span> <br><br> Responsáveis: Caio Vilela da Rocha; Andréia de Almeida Teixeira.</b><br><br>";
		
		else if($comprovante!="" && $confirmacao==1 && $pagamento==0)
		    echo "<b><span class='laranjado'>FASE 3: O CASIS confirmou seu pagamento. A coordenação vai analisar e homologar sua inscrição para liberar oficinas. Por favor, aguarde.</span></b><br><br>";

		else if($comprovante!="" && $confirmacao==1 && $pagamento==1)
		    echo "<b><span class=verde>FASE 4: A coordenação homologou sua inscrição. Oficinas liberadas.</span></b><br><br>";
		

		if(($comprovante!="" && $confirmacao==1 && $pagamento==1) || ($comprovante=="" && $confirmacao==0 && $pagamento==1)){}else{
		    //if($comprovante=="" && $confirmacao==0 && $pagamento==1){}else{

		    echo "<h3>VALORES</h3><br>
		R$30,00 para estudantes de Sistemas de Informação e Licenciatura em Informática<br>
		R$35,00 para estudantes de outros cursos<br>
		R$40,00 para pagamento após dia 19/04<br>
		Gratuito para estudantes do ensino médio<br><br>
 
		Para pagamentos em dinheiro, entre em contato com os representantes do CASIS: Caio e Andréia <br><br>";

		?>


<h3>PIX para pagamento</h3>
Chave Pix: crocha.2023@alunos.utfpr.edu.br<br>
<img src='img/chavepix.jpeg' width=20%>

<form action="enviarComprovante.php" method="post" enctype="multipart/form-data">
<span class=vermelho>Depois do pagamento, faça o upload do pdf do comprovante aqui: <input type=file name='comprovante' accept="application/pdf"></span><input type=submit value="enviar">
<br><br><br>
</form>

		<?php }

		}?>
		    
		    <!--h1>Dados de Inscrição</h1><br
		    <strong><?=$rom?> Semana Acadêmica de Informática da UTFPR Francisco Beltrão</strong><br>
		    <strong><?=$data?></strong><br>
		    <strong>Local: </strong>UTFPR - Francisco Beltrão (Anfiteatro do Bloco A e Laboratórios do Bloco Q)<br />
		    <strong>Email: </strong>semanainformatica-fb@utfpr.edu.br<br /><br />-->


	    <?php 
?>
		    <!--strong> <span class="verde">SUA DECLARAÇÃO ESTÁ DISPONÍVEL</span><br><br>Declaração de Participação: </strong><a href='declaracao.php?hash=<?=$hash?>'><span style="font:blue"> CLIQUE AQUI PARA BAIXAR SUA DECLARAÇÃO</span></a><br><br>

		    <span class="vermelho">Declarações de oficinas abaixo</span>
		    <br /><br-->

		    
		    <center>
			<h1>Dados de Inscrição</h1><br>
			<?php if($_GET["m"]=='ok') echo "<span class='verde'>Dados alterados com sucesso!</span>";?>
			<table border="1" bgcolor="#F3F3F3">
			    <tr>
				<td width="130">Nome:</td>
				<td colspan="3"><?php echo $mostra["nome"]; ?></td>
			    </tr>
			    <tr>
				<td>Instituição:</td>
				<td colspan="3">
				    <?php

				    
				    if($mostra["instituicao"]==1 || $mostra["instituicao"]==2  || $mostra["instituicao"]==3  || $mostra["instituicao"]==4 || $mostra["instituicao"]==4 ){

					$query = mysqli_query($c, "SELECT * FROM ".$ano."_instituicoes WHERE id=".$mostra["instituicao"]) or die(mysqli_error($c));
					
					
					$ver = mysqli_fetch_array($query);
					echo utf8_encode($ver["nome"]);
					

				    }else{
					echo utf8_encode($mostra["instituicao"]);
				    }
				    ?>

				</td>
			    </tr>
			    <?php
			    if($mostra["instituicao"]==1){
			    echo "<tr>
				<td>
				    Curso:
				</td>
<td colspan='3'>
".$mostra["curso"]."
</td>
			    </tr>";
				}
			    ?>
			    
			    <tr>
				<td>RA ou siape:</td>
  				<td colspan="3"><?php echo $mostra["ra"]; ?></td>
			    </tr>

			    <tr>

				<td>Cidade:</td>
  				<td><?php

				    $sql = "SELECT nome FROM cidades WHERE cod_cidades=".$mostra["cidade"];

				    $res = mysqli_query( $c, $sql );

				    $row = mysqli_fetch_array( $res );


				    echo mb_convert_case(utf8_encode($row["nome"]), MB_CASE_TITLE, 'UTF-8'); ?></td>
  				<td>Estado:</td>
  				<td width="74">

				    <?php
				    $sql = "SELECT nome FROM estados WHERE cod_estados=".$mostra["estado"];


				    $res = mysqli_query( $c, $sql );

				    $row = mysqli_fetch_array( $res );

				    echo mb_convert_case(utf8_encode($row["nome"]), MB_CASE_TITLE, 'UTF-8'); 
				    ?>
				</td>
			    </tr>

			    
  			    <td>CPF:</td>
  			    <td colspan='3'><?php echo $mostra["cpf"]; ?></td>
    </tr>
    <tr>
  	<td>Email:</td>
  	<td width="216" colspan=3><?php echo $mostra["email"]; ?></td>
    </tr>

    <tr id="minicursos">
  	<td valign="top">Oficinas escolhidas:</td>
  	<td width="500" colspan=3>
	    <?php
	    #$sql = mysqli_query($c, "SELECT * FROM  ".$ano."_participantes  WHERE idParticipante=".$_SESSION['id']) or die(mysqli_error($c));

	    echo "<b>Primeira Oficina<br><br></b>";
	    
	    $oficina = mysqli_query($c, "SELECT * FROM  ".$ano."_oficinas WHERE idOficina=".$mostra["idoficina1"]);



	    $quantas = mysqli_num_rows($oficina);
	    
	    $oficina = mysqli_fetch_array($oficina);
	    
	    if($quantas>0){

		$gerar_declaracao = mysqli_query($c, "SELECT * FROM ".$ano."_participantes_oficinas WHERE idParticipante=".$_SESSION['id']." AND idOficina=".$mostra["idoficina1"]." AND presenca=1") or die (mysqli_error($c));

		$gerar_declaracao =  mysqli_num_rows($gerar_declaracao);
		
		echo "<b>Nome da Oficina: ".$oficina["titulo"]."</b><br>";
		echo "Ministrante: "  . $oficina["ministrante"]."<br>";
		echo "Sala: " . $oficina["sala"]."<br>";
		echo "Data: " . $oficina["data"]."<br>";
		echo "Horário: " . $oficina["horario"]."<br><br>";

		echo "<strong>Declaração: ";
		if($gerar_declaracao == 1){
		    echo "<a href='declaracao.php?idoficina=".$mostra["idoficina1"]."&hash=$hash'><span class=verde>Baixe sua declaração desta oficina</span></a>";
		}else{
		    echo "<span class=vermelho>Não há registro de presença.</span>";
		}
		echo "</strong>";
	    }else{
		echo "<b><span class='vermelho'>Nenhuma escolhida.</span></b>";
	    }
	    echo "<br><br><hr><br>";


	    echo "<b>Segunda Oficina<br><br></b>";
	    
	    $oficina = mysqli_query($c, "SELECT * FROM  ".$ano."_oficinas WHERE idOficina=".$mostra['idoficina2']);

	    $quantas = mysqli_num_rows($oficina);
	    
	    $oficina = mysqli_fetch_array($oficina);
	    
	    if($quantas>0){

		$gerar_declaracao = mysqli_query($c, "SELECT * FROM ".$ano."_participantes_oficinas WHERE idParticipante=".$_SESSION['id']." AND idOficina=".$mostra["idoficina2"]." AND presenca=1") or die (mysqli_error($c));

		$gerar_declaracao =  mysqli_num_rows($gerar_declaracao);

		echo "<b> Nome da Oficina: ".$oficina["titulo"]."</b><br>";
		echo "Ministrante: "  . $oficina["ministrante"]."<br>";
		echo "Sala: " . $oficina["sala"]."<br>";
		echo "Data: " . $oficina["data"]."<br>";
		echo "Horário: " . $oficina["horario"]."<br><br>";

		echo "<strong>Declaração: ";
		if($gerar_declaracao == 1){
		    echo "<a href='declaracao.php?idoficina=".$mostra["idoficina2"]."&hash=$hash'><span class=verde>Baixe sua declaração desta oficina</span></a>";

		}else{
		    echo "<span class=vermelho>Não há registro de presença.</span>";
		}
echo "</strong>";
	    }else{
		echo "<b><span class='vermelho'>Nenhuma escolhida.</span></b>";
	    }
	    echo "<br><br><hr><br>";
	    
	    ?>
        </td>
    </tr>
			</table>
			<a target="_self" href="editarCadastro.php?id=<?php echo $_SESSION["id"];?>"><img border="0" style='border: 0px; padding: 1px' src="img/editar.png">Editar Cadastro</a>
	    </div>
	</td>
</tr>
</table>
