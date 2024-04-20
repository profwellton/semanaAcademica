<style> .verde{color: green;} .vermelho{color: red;} </style>

<table border> <tr> <td valign=top> <h1>Presenças Nas Palestras</h1><div class="detalhe"></div><br>
    <?php
    
    include("conexao.php");
    
    $sql_dia1=mysqli_query($c, "SELECT * FROM ".$ano."_presencas where id_atividade=1") or die(mysqli_error($c));
    echo "Número de pessoas presentes no primeiro dia 04/08 (quarta-feira) (palestra): " . mysqli_num_rows($sql_dia1)."<br><br>";    

    $sql_dia1=mysqli_query($c, "SELECT * FROM ".$ano."_presencas where id_atividade=3") or die(mysqli_error($c));
    echo "Número de pessoas presentes no terceiro dia 05/08 (quarta-feira) (palestra): ". mysqli_num_rows($sql_dia1)."<br><br>";

    //$sql_dia1=mysqli_query($c, "SELECT * FROM ".$ano."_presencas where id_atividade=5") or die(mysqli_error($c));
    //echo"Número de pessoas presentes no quinto dia 06/08 (sexta-feira) (palestra): " . mysqli_num_rows($sql_dia1)."<br>";
    
    echo "<br>"; ?> <meta charset="UTF8" />
    
    <!-- FORMULARIO DE CADASTRO DE PRESENCAS -->
    <form method="POST" action="presencas.php#cabecalho">
	<?php echo "Atividades "; ?> <br>
	<select name="atividade" size="1" class="campus">
	    <?php $sql1 = "SELECT * FROM ".$ano."_atividades ORDER BY id"; $resultado = mysqli_query($c, $sql1) or die (mysqli_error($c));
	    while($registro = mysqli_fetch_array($resultado)) {
		$idAtividade = $registro["id"]; if($idAtividade==5){ ?>
		<option value="<?=$idAtividade?>" selected><?=$registro["atividade"]?></option>
	    <?php }else{ ?>
		<option value="<?=$idAtividade?>"><?=$registro["atividade"]?></option>
	    <?php }
	    } ?>
	</select>

	<br>
	
	Registro: <input id="raBusca" name="raBusca"
			 type="number" /> <input type="submit" value=" OK ">
						      </form-->
    
						      <script>
						       document.getElementById("raBusca").value='';
						       setTimeout('document.getElementById("raBusca").select()',100);     
						      </script> <!-- FIM DO FORMULARIO DE CADASTRO DE PRESENCAS -->
						      
						      <!-- PROCESSA PRESENCA -->
						      
						      <?php
						      $idAtividade = $_POST["atividade"];
						      $raBusca = ltrim($_POST["raBusca"], '0');
						      $raBusca = substr($raBusca, 0, -1);	    
						      $sql_participantes = mysqli_query($c, "SELECT id, ra, nome FROM ".$ano."_participantes WHERE ra='$raBusca'") or die (mysqli_error($c));
						      
						      if(mysqli_num_rows($sql_participantes) <= 0){
							  $erro = "sim";
							  echo "<br>";
							  if($raBusca!=""){
							      echo "<b><span class='vermelho'>REGISTRO $raBusca NÃO ENCONTRADO! POR GENTILEZA, REALIZAR A INSCRIÇÃO PRIMEIRO NO SISTEMA.</span><br></b><br>";
							  }
						      }else{
							  $erro = "nao"; echo"<br>";
							  $row = mysqli_fetch_array($sql_participantes);
							  $nome=$row["nome"]; $ra= $row["ra"];
							  
							  $ja_esta = mysqli_query($c, "SELECT * FROM  ".$ano."_presencas WHERE id_participante='$ra' AND                id_atividade=5");

							  $conta_esta = mysqli_num_rows($ja_esta);
							  
							  if($conta_esta>0){
							      
							      echo "<br><b><span class='vermelho'>PARTICIPANTE $raBusca JÁ REGISTRADO PARA HOJE";
							      
							      $ja_esta = mysqli_query($c, "SELECT * FROM ".$ano."_presencas WHERE id_participante='$ra' AND id_atividade=5");

							      $conta_esta = mysqli_num_rows($ja_esta);

							      if($conta_esta>0){
								  //echo " E PARA ONTEM! </span><br></b><br>"; echo "";
							      }else{
								  //echo "APENAS (NÃO ESTEVE PRESENTEONTEM)!</span><br></b><br>"; echo "";
							      }
							      
							  }else{
							      $query = mysqli_query($c, "INSERT INTO ".$ano."_presencas (id_participante, nome, id_atividade) VALUES ('$ra', '$nome', '$idAtividade')") or die (mysqli_error($c));
							      if($query){
								  echo "<br><b><span class='verde'>PARTICIPANTE $raBusca REGISTRADO COM SUCESSO PARA HOJE";

								  $ja_esta = mysqli_query($c, "SELECT * FROM ".$ano."_presencas WHERE id_participante='$ra' AND id_atividade=3");

								  $conta_esta = mysqli_num_rows($ja_esta);

								  if($conta_esta>0){
								      echo " (ESTEVE PRESENTE ONTEM) </span><br></b><br>";
								      echo "";
								  }else{
								      // echo " </span> <span class='vermelho'> (NÃO ESTEVE PRESENTE ONTEM)!</span><br></b><br>"; echo "";
								  }
							      }else{ echo "erro"; }
							      
							      
							  }
						      }
						      
						      $sql_presencas = mysqli_query($c, "SELECT * FROM ".$ano."_presencas inner join ".$ano."_atividades on (".$ano."_atividades.id=".$ano."_presencas.id_atividade) order by ".$ano."_presencas.id DESC") or die (mysqli_error($c));
						      
						      //$sql_presencas = mysqli_query($c, "SELECT * FROM ".$ano."_pesencas");

						      $w=1; $x = 0; $y = 0; $z = 0;
						      echo "<table>";
						      while($rpresenca=mysqli_fetch_array($sql_presencas)){
							  
							  $nome_presenca=ucwords(strtolower($rpresenca["nome"]));
							  
							  $id_aqui= $rpresenca["id"];
							  $id_presenca=intval($rpresenca["id_participante"]);
							  $atividade= $rpresenca["id_atividade"];

							  if($atividade==1){

							      if($x==0){ $sai= "<br><br><h3>PRESENTES NA SEGUNDA-FEIRA (21/10) <h3>"; $x++;}

							      echo "<tr><td colspan=3>$sai</td></tr><tr><td>".$id_presenca."</td><td>".$nome_presenca."</td><td><span class='verde'>presente</span></td></tr>";

							      $sai="";

							  }else if($atividade==3){
							      if($y==0){
								  $sai = "<br><br><h3>PRESENTES NA QUARTA-FEIRA (23/10) <h3>";
								  $y++;
							      }

							      echo "<tr><td colspan=3>$sai</td></tr><tr><td>".$id_presenca."</td><td>".$nome_presenca."</td><td><span class='verde'>presente</span></td></tr>";
							      $sai="";
							  }else if($atividade==5){
							      if($z==0){
								  $sai= "<h3>PRESENTES NA SEXTA-FEIRA (25/10) <h3>";
								  $z++;
							      }

							      echo "<tr><td colspan=3>$sai</td></tr><tr><td>".$id_presenca."</td><td>".$nome_presenca."</td><td><span class='verde'>presente</span></td></tr>". $sai="";

							  }
							  
							  $w++;

						      }
						      echo "</table>";
						      ?>
    
</td> </tr> </table>
