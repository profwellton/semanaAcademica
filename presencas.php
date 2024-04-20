<?php
session_start();
if($_SESSION["tipo"]!="1"){ echo "NÃO AUTORIZADO! APENAS NO DIA DO EVENTO.";
}else{
?>

<style> .verde{color: green;} .vermelho{color: red;} </style>

<table border  id="presencas"> <tr> <td valign=top align=center> <h2>SISTEMA DE PRESENÇAS</h2><div class="detalhe"></div><br>
    <?php
    
    include("conexao.php");
    
    $sql_dia1=mysqli_query($c, "SELECT * FROM ".$ano."_presencas where id_atividade=1") or die(mysqli_error($c));
    echo "Número de pessoas presentes no primeiro dia 22/04 (segunda-feira) (palestra): " . mysqli_num_rows($sql_dia1)."<br><br>";    

    $sql_dia1=mysqli_query($c, "SELECT * FROM ".$ano."_presencas where id_atividade=2") or die(mysqli_error($c));
    echo "Número de pessoas presentes na palestra do terceiro dia 23/04 (quarta-feira) (palestra): ". mysqli_num_rows($sql_dia1)."<br><br>";

    $sql_dia1=mysqli_query($c, "SELECT * FROM ".$ano."_presencas where id_atividade=3") or die(mysqli_error($c));
    echo "Número de pessoas presentes no terceiro dia 13/04 (quinta-feira) (palestra): ". mysqli_num_rows($sql_dia1)."<br><br>";

    ?>

    <meta charset="UTF8" />
    
    <!-- FORMULARIO DE CADASTRO DE PRESENCAS -->

    <form method="POST" action="painel.php#presencas" >

	Escolha a atividade: 

	<select name="atividade" size="1" class="pasta">
	    <?php

	    $sql1 = "SELECT * FROM ".$ano."_atividades ORDER BY id";

	    $resultado = mysqli_query($c, $sql1) or die (mysqli_error($c));

	    while($registro = mysqli_fetch_array($resultado)) {
		
	    	$idAtividade = $registro["id"];

		echo "<option value='$idAtividade'>";

		    echo $registro["data"]." - ". $registro["atividade"];

		echo "</option>";
		
	     }

	     ?>
		
	</select>
	
	<br><br>
	
	Número do código de barra (via leitor): <input id="raBusca" name="raBusca" type="text" class="codigoCracha" /> <input type="submit" value=" OK " class="codigoCracha">
    </form>
    
    <script>
     document.getElementById("raBusca").value='';
     setTimeout('document.getElementById("raBusca").select()',100);     
    </script> <!-- FIM DO FORMULARIO DE CADASTRO DE PRESENCAS -->
    
    <!-- PROCESSA PRESENCA -->
    
    <?php
    $idAtividade = $_POST["atividade"];
    $raBusca = ltrim($_POST["raBusca"], '0');
    $raBusca = substr($raBusca, 0, -1);	    

    $sql_participantes = mysqli_query($c, "SELECT id, ra FROM ".$ano."_participantes WHERE ra='$raBusca'") or die (mysqli_error($c));

    $row = mysqli_fetch_array($sql_participantes);
    //$nome=$row["nome"];
    //$ra= $row["ra"];
    $id_participante = $row["id"];
    
    if(mysqli_num_rows($sql_participantes) <= 0){
	$erro = "sim";
	echo "<br>";
	if($raBusca!=""){
	    echo "<b><span class='vermelho'>Código $raBusca não encontrado. Por favor, verifique se a inscrição foi realizada no site da semana acadêmica.</span><br></b><br>";
	}
    }else{
	$erro = "nao";
	echo "<br>";
	
	$ja_esta = mysqli_query($c, "SELECT * FROM  ".$ano."_presencas WHERE id_participante='$id_participante' AND id_atividade=$idAtividade");
	
	$conta_esta = mysqli_num_rows($ja_esta);
	
	if($conta_esta>0){
	    
	    echo "<br><b><span class='vermelho'>PARTICIPANTE $raBusca JÁ REGISTRADO PARA HOJE";
	    
	    $ja_esta = mysqli_query($c, "SELECT * FROM ".$ano."_presencas WHERE id_participante='$id_participante'");
	    
	    $conta_esta = mysqli_num_rows($ja_esta);
	    
	    if($conta_esta>0){
		//echo " E PARA ONTEM! </span><br></b><br>"; echo "";
	    }else{
		//echo "APENAS (NÃO ESTEVE PRESENTEONTEM)!</span><br></b><br>"; echo "";
	    }
	    
	}else{
	    
	    $data_hora = date('d/m/Y H:i:s');
	    
	    $query = mysqli_query($c, "INSERT INTO ".$ano."_presencas (id_participante, id_atividade, data_hora) VALUES ('$id_participante', '$idAtividade', '$data_hora')") or die (mysqli_error($c));

	    echo $query;
	    
	    if($query){
		echo "<br><b><span class='verde'>PARTICIPANTE $raBusca REGISTRADO COM SUCESSO PARA HOJE";
		
		/*$ja_esta = mysqli_query($c, "SELECT * FROM ".$ano."_presencas WHERE id_participante='$id_participante' AND id_atividade=1");
		
		$conta_esta = mysqli_num_rows($ja_esta);
		
		if($conta_esta>0){
		    echo " (ESTEVE PRESENTE ONTEM) </span><br></b><br>";
		    echo "";
		}else{
		    // echo " </span> <span class='vermelho'> (NÃO ESTEVE PRESENTE ONTEM)!</span><br></b><br>"; echo "";
		}
		*/
	    }else{ echo "erro. Chama o Wellton: 46991057348"; }
	    
	}
    }
    
    //$sql_presencas = mysqli_query($c, "SELECT * FROM ".$ano."_presencas inner join ".$ano."_atividades on (".$ano."_atividades.id=".$ano."_presencas.id_atividade) order by ".$ano."_presencas.id DESC") or die (mysqli_error($c));
    
    $sql_presencas = mysqli_query($c, "SELECT * FROM ".$ano."_presencas") or die(mysqli_error());
    
    $w=1; $x = 0; $y = 0; $z = 0;
    $caetano = 1;
    $cont1=1;
    $cont2=1;
    $cont3=1;

    echo "<table>";
    
    while($p=mysqli_fetch_array($sql_presencas)){
	
	//$nome_presenca=ucwords(strtolower($rpresenca["nome"]));
	
	/*$id_aqui= $rpresenca["id"];
	$id_presenca=intval($rpresenca["id_participante"]);
	$id_atividade= $rpresenca["id_atividade"];
	$data_hora = $rpresenca["data_hora"];	
	 */

	$id_participante = $p["id_participante"];
	$id_atividade = $p["id_atividade"];
	$data_hora = $p["data_hora"];

	
	//if($id_atividade==1){
	    
	//if($cont1 == 1) $cont=1;
	
	    if($x==0){ $sai= "<br><br><h3>PRESENTES NA TERÇA-FEIRA (11/04) <h3>"; $x++;}
	    
	    echo "<tr><td colspan=3>$sai</td></tr><tr><td>$cont1</td><td>$id_atividade</td><td>$id_participante</td><td><span class='verde'>presente</span></td><td>Registrado em $data_hora</td></tr>";
	    
	    $sai="";
	    
	    $cont1++;
	/*}else if($id_atividade==2){

	    if($cont2 == 1) $cont=1;
	    
	    if($y==0){
		$sai = "<br><br><h3>PRESENTES NA QUARTA-FEIRA (12/04) <h3>";
		$y++;
	    }
	    
	    echo "<tr><td colspan=3>$sai</td></tr><tr><td>$cont2</td><td>".$id_presenca."</td><td>".$nome_presenca."</td><td><span class='verde'>presente</span></td><td>Registrado em $data_hora</td></tr>";
	    $cont2++;
	    $sai="";
	}else if($id_atividade==3){

	    if($cont3 == 1) $cont=1;
	    
	    if($z==0){
		$sai= "<h3>PRESENTES NA QUINTA-FEIRA (13/04) <h3>";
		$z++;
	    }
	    
	    echo "<tr><td colspan=3>$sai</td></tr><tr><td>$w</td><td>".$id_presenca."</td><td>".$nome_presenca."</td><td><span class='verde'>presente</span></td><td>Registrado em $data_hora</td></tr>";
	    
	    //echo "<tr><td colspan=3>$sai</td></tr><tr><td>".$id_presenca."</td><td>".$nome_presenca."</td><td><span class='verde'>presente</span></td></tr>".
	    $cont3++;
	    $sai="";
	    
	}
    */
	
	$w++;
	
    }
    echo "</table>";
    ?>
    
</td>
</tr>
</table>

<?php
}
?>
