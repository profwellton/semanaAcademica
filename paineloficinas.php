<?php

session_start();
include("conexao.php");

$idParticipante = $_SESSION["id"];

$sql = mysqli_query($c,"SELECT pagamento FROM ".$ano."_participantes WHERE id=$idParticipante") or die(mysqli_error($c));
$v = mysqli_fetch_array($sql);
$pagamento = $v["pagamento"];
?>
<center>
    
    <!-- span class="red"> (a possibilidade de alteração de oficinas finalizou)</span></h2><br-->

    <?php 

    $q = mysqli_query($c, "SELECT id, idOficina FROM ".$ano."_participantes_oficinas WHERE idParticipante=$idParticipante ") or die(mysqli_error($c));
    $cont = mysqli_num_rows($q);

    //echo "<h2>Inscrição em Oficinas (Em manutenção)</h2><br>";
    
       if($cont==0){

       echo "<h2>Inscrição em Oficinas</h2><br>";

       echo "<form action='manipulaoficinas.php?tipo=inserir' class='form_resumo' method='POST'>";

       }else{
       
       echo "<h2>Alterar Oficinas</h2><br>";

       echo "<form action='manipulaoficinas.php?tipo=atualizar' class='form_resumo' method='POST'>";
       }

     
    //$q = mysqli_query($c, "SELECT id, idOficina FROM ".$ano."_participantes_oficinas WHERE idParticipante=$idParticipante ") or die(mysqli_error($c));

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
    while($x<2){
	if($x==0){ $dia="22"; $horario='21h20'; $turno="da noite"; }
	//if($x==1){ $dia="23"; $horario='14h00'; $turno="da tarde"; $direcionado="(direcionado ao ensino medio)"; };
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
	    echo "<input type=hidden name=oficinaAnterior$x value=".$ofi[$x].">";
	    echo "<input type=hidden name=id_part_ofi$x value=".$id_part_ofi[$x].">";
	    echo "<br><br>";
	}
	$x++;
	
    }

    if($pagamento==1){

	if($cont==0) echo "<input type='submit' class='btn_enviar' value='Confirmar Oficinas'>";
	else echo "<input type='submit' class='btn_enviar' value='Alterar Oficinas'>";
	//echo "<input type='button' class='btn_enviar' value='EM MANUTENÇÃO'>";
	
	
    }else{

	echo "<input type='button' class='btn_enviar' value='Inscrição será liberada após pagamento ao CASIS'>";

    }

    ?>
	
	
    
	<br><br>
    </form>
</center>
