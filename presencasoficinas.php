<style>
 .verde{color: green;}
 .vermelho{color: red;}
</style>
<script>
 function carrega(id){
     window.location.href="presencasoficinas.php?atividade="+id;
 }
 function excluir(atividade, id){
     window.location.href="presencasoficinas.php?atividade="+atividade+"&ep="+id;
 }
</script>
<table border>
    <tr>
	<td valign=top>
	    <h1>Presenças Nas Oficinas</h1><div class="detalhe"></div><br>
	    <?php
	    include("conexao.php");
	    if($_GET["ep"]!=""){
		$idparticipante = $_GET["ep"];
		$idOficinaParticipante = $_GET["atividade"];

		$query = mysqli_query($c, "UPDATE ".$ano."_participantes_oficinas SET presenca=0 WHERE idParticipante=$idparticipante AND idOficina=$idOficinaParticipante") or die (mysqli_error($c));

		echo "UPDATE ".$ano."_participantes_oficinas SET presenca=0 WHERE idParticipante=$idparticipante AND idOficina=$idOficinaParticipante";
		if($query) echo "<br><font color=red>presença retirada de $idparticipante e oficina $idOficinaParticipante</font><br><br>";

	    }
	    
	    $idAtividade = $_POST["atividade"];
	    if($idAtividade==0)$idAtividade = $_GET["atividade"];
	    ?>

	    <meta charset="UTF8" />

	    <!-- FORMULARIO DE CADASTRO DE PRESENCAS -->
	    <form action="presencasoficinas.php" method="POST">
		<select onclick="carrega(this.value)" name='atividade' size="1" class="campus">
		    <?php
		    echo "<option value='todos'>TODOS</option>";
		    $sql1 = "SELECT * FROM ".$ano."_oficinas ORDER BY idOficina";
		    $resultado = mysqli_query($c, $sql1) or die (mysqli_error($c));
		    while ($registro = mysqli_fetch_array($resultado)) {

			if($registro["idOficina"]==$idAtividade){
			    $mostra="selected";
			    $curso = $registro["titulo"];

			}else $mostra="";
			
		    ?>
		    <option  value="<?php echo $registro["idOficina"] ?>" <?=$mostra?>><?=$registro["titulo"]?></option>
		    <?php
		    
		    }
		    ?>
		</select>
		<br>
		<?php if($idAtividade!="todos"){ ?>		
		    Registro: <input  id="raBusca"  name="raBusca" type="number" /><br>
		    ou Nome: <input name="nomeBusca" />
		    <input type="submit" value=" OK ">
	    </form>
	    <script>
	     document.getElementById("raBusca").select();
	    </script>
		<?php } ?>
		<!-- FIM DO FORMULARIO DE CADASTRO DE PRESENCAS -->

		<!-- PROCESSA PRESENCA -->
		<?php

		if($idAtividade!="todos"){
		    $raBusca = $_POST["raBusca"];
		    echo $raBusca."<br>";
		    if($_POST["raBusca"]=="" && $_POST["nomeBusca"]==""){

			$select = mysqli_query($c, "SELECT * FROM ".$ano."_participantes WHERE idOficina=$idAtividade ORDER BY nome");

		    }else if($_POST["raBusca"]==""){

			echo "busca por nome: " . $_POST["nomeBusca"];
			$nomeBusca = $_POST["nomeBusca"];
			echo "<br><br>";

			$select = mysqli_query($c, "SELECT * FROM ".$ano."_participantes WHERE  (nome LIKE '%".$nomeBusca."%') ORDER BY nome");
			
			while($m = mysqli_fetch_array($select)){
			    echo $m["id"] ." - " . $m["ra"]. " - ". ucfirst($m["nome"])."<br><br>";
			    if(mysqli_num_rows($select)==1){
				$raBusca=intval($m["ra"])."0";
			    }
			    
			}
			
		    }

		    if($_POST["raBusca"]!="" || $_POST["nomeBusca"]!=""){
			
			$raBusca = ltrim($raBusca, '0');
			$raBusca = substr($raBusca, 0, -1);
			
			
			$query = mysqli_query($c, "SELECT * FROM ".$ano."_participantes WHERE ra='$raBusca'");
			
			$m = mysqli_fetch_array($query);
			$idparticipante= $m["id"];
			$nomeparticipante = $m["nome"];
			
			echo "Nome: $nomeparticipante<br>";
			
			$query2 = mysqli_query($c, "SELECT * FROM ".$ano."_participantes_oficinas WHERE idParticipante=$idparticipante");
			while($m2 = mysqli_fetch_array($query2)){		    

			    echo "idAtividade=".$idAtividade."<br>";
			    $idOficinaParticipante = $m2["idOficina"];
			    
			    
			    /*if($idOficinaParticipante==8 || $idOficinaParticipante==0){
			       $query = mysqli_query($c, "UPDATE ".$ano."_participantes_oficinas SET idOficina=$idAtividade WHERE idParticipante=$idparticipante AND idOficina=$idOficinaParticipante") or die (mysqli_error($c));
			       $idOficinaParticipante = $idAtividade;
			       if($query) echo "<br><font color=green>ID ALTERADO</font><br><br>";
			       
			       }*/
			    
			    echo "idOficina=".$idOficinaParticipante;

			    if($idAtividade==$idOficinaParticipante){
				$query = mysqli_query($c, "UPDATE ".$ano."_participantes_oficinas SET presenca=1 WHERE idParticipante=$idparticipante AND idOficina=$idOficinaParticipante") or die (mysqli_error($c));
				if($query) echo "<br><font color=green>Presença Confirmada</font><br><br>";
				
			    }		
			    else echo "<br><font color=red>Não é cadastrado na oficina</font><br><br>";
			}
			
		    }
		    
		    echo "</td><td valign=top>";
		    $sql_presencas = mysqli_query($c, "SELECT * FROM ".$ano."_participantes_oficinas inner join ".$ano."_participantes on (".$ano."_participantes.id=".$ano."_participantes_oficinas.idParticipante)  WHERE ".$ano."_participantes_oficinas.idOficina=$idAtividade	 AND ".$ano."_participantes_oficinas.presenca=1") or die (mysqli_error($c));
		    
		    $part = array();
		    while($m = mysqli_fetch_array($sql_presencas)){
			array_push($part,  ucwords(strtolower($m["nome"]))."##".$m["id"]."##".intval($m["ra"]));
		    }
		    
		    sort($part);

		    echo "<h2>". utf8_encode($curso) ."</h2>";
		    if(sizeof($part)==0){
			echo "<font color=red>Nenhum participante presente</font>";
		    }else{
			
			$x=0;
			echo "<table>";
			while($x<sizeof($part)){
			    $y++;

			    $dados = explode("##", $part[$x]);
			    $id = $dados[1];
			    $ra = $dados[2];
			    $nome = $dados[0];
			    echo "<tr><td>$y -</td><td>$ra &nbsp;&nbsp;</td><td>$nome</td><td><a href='javascript:excluir(".$idAtividade.", ".$id.")'>excluir</a></td></tr>";
			    $x++;
			}
		    }


		?>
		
	</td>
    </tr>
</table>

<?php
}else{
    $z=1;
    while($z<12){
	$resultado = mysqli_query($c, "SELECT * FROM ".$ano."_oficinas WHERE idOficina=$z") or die (mysqli_error($c));
	$registro = mysqli_fetch_array($resultado);
	
	$curso = $registro["data"] . " - " . $registro["titulo"];
	$ido=$registro["idOficina"];
	echo "<h2>". utf8_encode($curso) ."</h2>";


	$y=1;
	$sql_presencas = mysqli_query($c, "SELECT * FROM ".$ano."_participantes_oficinas inner join ".$ano."_participantes on (".$ano."_participantes.id=".$ano."_participantes_oficinas.idParticipante)  WHERE ".$ano."_participantes_oficinas.idOficina=$z AND ".$ano."_participantes_oficinas.presenca=1") or die (mysqli_error($c));

	
	$part = array();
	while($m = mysqli_fetch_array($sql_presencas)){
	    array_push($part,  ucwords(strtolower($m["nome"]))."##".$m["id"]."##".intval($m["ra"]));
	}


	sort($part);

	if(sizeof($part)==0){
	    echo "<font color=red>Nenhum participante presente</font>";
	}else{
	    
	    
	    $x=0;
	    echo "<table>";
	    while($x<sizeof($part)){
		
		$dados = explode("##", $part[$x]);
		$id = $dados[1];
		$ra = $dados[2];
		$nome = $dados[0];
		echo "<tr><td>$y -</td><td>$ra &nbsp;&nbsp;</td><td>$nome</td><td></tr>";
		$x++;
		$y++;
	    }
	    echo "</table>";
	}

	$z++;
	
    }
    
}
