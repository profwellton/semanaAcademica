<div id="participantes"></div>

<script>

 function gravar(hash, tipo){

     var x = document.getElementById(hash).checked;
     var a = new XMLHttpRequest();
     a.open("GET", "gravar_"+tipo+".php?hash="+hash+"&check="+x, false);
     
     a.onreadystatechange = function(){
	 document.getElementById('data_'+tipo+'_'+hash).innerHTML="Carregando...";
	 
	 if (a.readyState==4 && a.status==200){
	     var exibe = a.responseText.split("##");
	     document.getElementById('data_'+tipo+'_'+hash).innerHTML=exibe[0];
	     alert(exibe[1]);
	 }
     }
     a.send( null );
     
 }
 
</script>

<?php

function gen_random($length=8){
    $final_rand='';
    for($i=0;$i< $length;$i++)    {
	$final_rand .= rand(0,9);
    }
    return $final_rand;
}

function gerarValidador() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $palavra = array(); //deve declarar palavra array antes
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 6; $i++) {// aqui você escolhe o tamanho da string
	$n = rand(0, $alphaLength);
	$palavra [] = $alphabet[$n];
    }
    return implode($palavra); //transforma o array numa string
}


?>
<div class="clear"></div>

<!-- CORPO -->
<section class="corpo">
    <section class="conteudo">
	<!-- DOWNLOADS -->
	<section class="downloads">
	    <?php
	    $cont=0;
	    $ensinomedio=0;
	    include("conexao.php");
	    if($_GET["orderby"]=="sorteio"){
		$result=mysqli_query($c, "SELECT * FROM ".$ano."_participantes ORDER BY id") or die(mysqli_error($c));		
	    }else{
		$result=mysqli_query($c, "SELECT * FROM ".$ano."_participantes ORDER BY nome") or die(mysqli_error($c));
	    }
	    
	    $contador = mysqli_num_rows($result);
	    $emailstrabalhos = "";
	    $emailstodos = "";
	    ?>
	    <table border='1'>
		<tr>
		    <th><a href="?orderby=sorteio#participantes"><span style="color:white">Num</span></a></th><th>Crachá</th><th><a href="?orderby=nome#participantes"><span style="color:white">Nome</span></a></th><th>Instituição</th><th>PIX</th><th>CASIS</th>

		    <?php
		    if($_SESSION["tipo"]==1){
		    ?>
			<th>Confirmação</th>
		    <?php
		    }
		    ?>
		</tr>
		<?php
		$i=1;
		$cont=0;
		$virao = 0;
		$naovirao = 0;
		$almoco = 0;
		$naoalmoco=0;
		$pagantes = 0;
		$arrecadado = 0;
		$valor = 25;
		
		$emails = array();
		$naoutfpr= "";
		while($row = mysqli_fetch_array( $result )) {

		    if(@$row["participar"]!="NÃO"){
			$todos2 .= @$row["email"]. ", ";
			//echo $row["email"];
		    }
		    
		    echo "<tr id='".$row["nome"]."'>";

		    #CONTADOR
		    //echo "<td align=center>$i</td>";
		    echo "<td id='participante".$row["id"]."'> " .$row["id"]. "</td>";

		    #Crachás
		    $ra = $row["ra"];
		    echo  "<td>";

		    if($ra==""){
			echo "<span class=vermelho>NAO TEM RA</span>";
			
			$ra = gen_random();//random number with length 10
			
			$sql_ra = mysqli_query($c, "UPDATE ".$ano."_participantes SET ra='$ra' WHERE id=".$row['id']);
			if($sql_ra) echo "OK";
		    }
                    
		    $hash_participante  = $row["hash"];			    
		    echo $row["ra"]. "<br><br><a href='etiquetas.php?hash=$hash_participante'>Crachá</a>";
		    
		    $id_participante = $row['id'];


		    $sql = mysqli_query($c, "SELECT * FROM ".$ano."_presencas WHERE id_participante='$ra'") or die(mysqli_error($c));
		    $carga_horaria = mysqli_num_rows($sql);
		    if($carga_horaria == 1){
			$carga_horaria = "12";
		    }else if($carga_horaria >1){
			$carga_horaria = "24";
		    }
		    
		    mysqli_query($c, "UPDATE ".$ano."_participantes SET carga_horaria='$carga_horaria' WHERE hash='$hash_participante'");		    
		    
		    echo "</td>";              		    
		    
		    #Nome
		    
		    echo "<td>". $row['nome'] ."</td>";
		    

		    #INSTITUICAO		    					
		    //echo "<td>". $row['instituicao'] ."</td>";
		    if($row["instituicao"]==1 || $row["instituicao"]==2  || $row["instituicao"]==3  || $row["instituicao"]==4 || $row["instituicao"]==5){

			$query = mysqli_query($c, "SELECT * FROM ".$ano."_instituicoes WHERE id=".$row["instituicao"]) or die(mysqli_error($c));
			
			
			$ver = mysqli_fetch_array($query);
			echo "<td>".utf8_encode($ver["nome"])."</td>";
			

		    }else{
			echo "<td>".$row["instituicao"]."</td>";
		    }

		    
		    #EMAIL
		    $email = $row['email'];		    
		    //echo "<td>";		    
		    if( @$m==""){$naoutfpr.=@$row["email"].", ";}			    
		    if(@$m=="Campus Curitiba" || @$m=="Reitoria")
			array_push($emails, $row['email']);			    
		    $hash = $row["hash"];
		    //echo "</td>";
		    
		    if($row["pagamento"]==1){
			$emailsoficinas .= $row["email"].", ";
			$cont++;
			if($row["instituicao"]!=1) $ensinomedio++;
		    }
		    
		    #Comprovante de pagamento
		    echo "<td valign=top align=center>";

		    if($row['comprovante']!=''){
			echo "<a href='".$row["comprovante"]."' target='_BLANK'><img src='img/iconpdf.png' width='90%'></a>";
		    }			
		    echo "</td>";

		    #O pagamento foi creditado?????
		    echo "<td valign=top>";

		    
		    if($row["confirmacao"]==1) $checked="checked";
		    else $checked="";

		    if($row['comprovante']!=''){
			echo "<input $checked type='checkbox' id='".$hash."' onclick=\"gravar('$hash', 'confirmacao')\">";
		    }else{
			echo "<input type='checkbox' disabled>";
		    }
		    if($row["comprovante"]!=''){
		    	if($row["confirmacao"]==1){
			    $checked="checked";
			    $dt = $row["data_confirmacao"];
			    $ano = substr($dt, 0, -10);
			    $mes = substr($dt, 4, -8);
			    $dia = substr($dt, 6, -6);
			    $hora= substr($dt, 8, -4);
			    $min = substr($dt, 10, -2);
			    $seg = substr($dt, -2);

			    //echo "<span id='data_confirmacao_$hash'>$dia/$mes/$ano $hora:$min:$seg<br>Posição: ".$row["posicao"]."</span>";
			    echo "<span id='data_confirmacao_$hash'>Comprovante confirmado pela tesouraria em $dia/$mes/$ano $hora:$min:$seg <br>";
			    if($row["pagamento"]==0){
				echo "<span class=vermelho>Aguardando confirmação da coordenação para liberar oficinas</span></span>";
			    }else{
				echo "<span class=verde>Oficinas liberadas pela coordenação.</span></span>";

			    }
			    $arrecadado += $valor;
			    $pagantes++;
		    	}else{
			    echo "<span id='data_confirmacao_$hash'></span>";
		    	}
		    }

		    echo "</td>";
		    




		    if($_SESSION["tipo"]==1){
			#confirmar Pagamento realizado
			echo "<td valign=top>";

			//$tt = mysqli_query($c, "SELECT apoio FROM ".$ano."_participantes WHERE apoio=1 AND hash='$hash'");
			//$numtt = mysqli_fetch_array($tt);			    
			
			if($row["pagamento"]==1) $checked="checked";
			else $checked="";

			echo "<input $checked type='checkbox' id='".$hash."' onclick=\"gravar('$hash', 'pagamento')\">";
			if($row["pagamento"]==1){
			    $checked="checked";
			    $dt = $row["data_pagamento"];
			    $ano = substr($dt, 0, -10);
			    $mes = substr($dt, 4, -8);
			    $dia = substr($dt, 6, -6);
			    $hora= substr($dt, 8, -4);
			    $min = substr($dt, 10, -2);
			    $seg = substr($dt, -2);

			    //echo "<span id='data_pagamento_$hash'>$dia/$mes/$ano $hora:$min:$seg<br>Posição: ".$row["posicao"]."</span>";
			    echo "<span id='data_pagamento_$hash'> Oficinas Liberadas pela coordenação em $dia/$mes/$ano $hora:$min:$seg</span>";

			    $arrecadado += $valor;
			    $pagantes++;
			}else{
			    echo "<span id='data_pagamento_$hash'></span>";
			}


			echo "</td>";
		    }		    
		    
		    echo "</tr><tr><td colspan=10>";


		    
		    $idParticipante = $row["id"];

		    $sql = mysqli_query($c,"SELECT confirmacao FROM ".$ano."_participantes WHERE id=$idParticipante") or die(mysqli_error($c));
		    $v = mysqli_fetch_array($sql);

		    $confirmacao = $v["confirmacao"];

		    if($confirmacao==1) $cont_con++;

		    //echo "QUAL: ". $confirmacao."<br>";


		    
		    $sql = mysqli_query($c, "SELECT * FROM ".$ano."_presencas WHERE id_participante='$ra'") or die(mysqli_error($c));
		    $carga_horaria = mysqli_num_rows($sql);
		    if($carga_horaria == 1){
			$carga_horaria = "12";
		    }else if($carga_horaria >1){
			$carga_horaria = "24";
		    }

		    $carga_horaria = 23;
		    echo "[Carga Horária: $carga_horaria hrs]&nbsp;&nbsp;[<a href='declaracao.php?hash=$hash'>Declaração</a>] - ";
		    echo "$email<br><br>";

		    if( $row["instituicao"]!=1 && $row["instituicao"]!=6 && $_SESSION["tipo"]==1){


			//COMECA

			$idParticipante = $row["id"];

			$sql = mysqli_query($c,"SELECT pagamento FROM ".$ano."_participantes WHERE id=$idParticipante") or die(mysqli_error($c));
			$v = mysqli_fetch_array($sql);

			$confirmacao = $v["confirmacao"];
			$pagamento = $v["pagamento"];

			if($pagamento==1) $cont_pag++;

			
			$q = mysqli_query($c, "SELECT id, idOficina FROM ".$ano."_participantes_oficinas WHERE idParticipante=$idParticipante") or die(mysqli_error($c));
			$cont = mysqli_num_rows($q);

			
			if($cont==0){
			    echo "Inserir oficina da tarde:";
			    echo "<form action='manipulaoficinas.php?tipo=inserir&id_participante=$idParticipante' class='form_resumo' method='POST'>";
			}else{
			    echo "Mudar oficina da tarde:";
			    echo "<form action='manipulaoficinas.php?tipo=update&id_participante=$idParticipante' class='form_resumo' method='POST'>";
			}

			$ofi = array();
			$id_part_ofi = array();
			$se = array();

			$y=0;
			while($m = mysqli_fetch_array($q)){
    			    $ofi[] = $m["idOficina"];
			    $id_part_ofi[] = $m["id"];
			    $se[]="";
			    $y++;
			}

			$x=0;
			while($x<1){
			    if($x==0){ $dia="23"; $horario='14h00'; $turno="da tarde"; }
			    if($x==1){ $dia="23"; $horario='19h15'; $turno="da noite"; $direcionado=""; }

			    echo "<br><strong>Oficinas $turno para o dia $dia/04/$ano $direcionado</strong><br>";
			    
			    $query = mysqli_query($c, "SELECT * FROM ".$ano."_oficinas WHERE dia='$dia' AND horario='$horario' ORDER BY horario") or die(mysqli_error($c));

			    if(mysqli_num_rows($query)!=0){
				
				echo "<select class='pasta' name='oficina$x' id='oficina$x'>";
				echo "   <option value='0'>Nenhuma ...</option>";
				
				while($mostrar = mysqli_fetch_array($query)) {
				    
				    if($mostrar["vagas"]<1){
					$acabou="disabled";
					$mostrar["vagas"]="(Lotada)";
				    }else{
					$acabou= "";
				    }

				    $idOficina=$mostrar["id"];
				    $idOficina = $mostrar["idOficina"];
				    
   				    if($ofi[$x]==$idOficina){
					$se[$x]="selected";
				    }else{
					$se[$x]="";
				    }
				    
				    echo "<option value='$idOficina' $acabou ".$se[$x].">".
					 $mostrar["vagas"]." vagas - " .
					 $mostrar["horario"]. " - ".
					 $mostrar["titulo"] . " - " .
					 $mostrar["ministrante"]." - " .
					 $mostrar["sala"].
					 "</option>";
				}
				
    				echo "</select>";

				echo "<input type=hidden name=oficina1 value=0>";

				echo "<input type=hidden name=oficinaAnterior$x value=".$ofi[$x].">";
				echo "<input type=hidden name=id_part_ofi$x value=".$id_part_ofi[$x].">";
				echo "<br><br>";
			    }
			    $x++;
			    
			}

			if($pagamento==1){

			    if($cont==0) echo "<input type='submit' class='btn_enviar' value='Gravar Oficina'>";
			    else echo "<input type='submit' class='btn_enviar' value='Gravar Oficina'>";
			    //echo "<input type='button' class='btn_enviar' value='EM MANUTENÇÃO'>";
			    
			    
			}else{

			    echo "<input type='button' class='btn_enviar' value='Inscrição será liberada após pagamento ao CASIS'>";

			}
			echo "</form>";

			//TERMINA
			
		    }
		    
		    
		    echo "</td></tr>";

		    $i++;
		}
		$_SESSION["todos2"] = $todos2;
		$total_utfpr = $contador-$ensinomedio;

		$total_utfpr_com = $cont_con;
		$total_utfpr_sem = $total_utfpr - $cont_con;

		?>

		Total de Participantes:  <?=$contador?><br><br>
		Numero de alunos do ensino medio: <?=$ensinomedio?><br><br>
		Numero de alunos da UTFPR: <?=$total_utfpr?><br><br>
		Numero de alunos da UTFPR com pagamento: <?=$total_utfpr_com?><br>
		Numero de alunos da UTFPR sem pagamento: <?=$total_utfpr_sem?><br>
	
		<br>

		
	    </table>                 
            <?php
	    //echo $emailsoficinas."<br><br>";

	    ?>
	</section>
            </section>
	</section>


