<section class="enviarresumo" id="editarresumo">
   <h2>Editando Resumo</h2><br>(<a href="painel.php#envia">Clique aqui caso queira enviar outro resumo</a>)<br><br>
   <?php
	  session_start();
    mysql_connect("localhost", "salin", "S@l1n");
	  mysql_select_db("salin");
	  $codigoResumo = $_SESSION["trabalho"];

	  $sql = mysql_query("SELECT * FROM 2016_resumos WHERE id=$codigoResumo");
	  $idpart  = mysql_result($sql, 0, "idParticipante");

	  //if($_SESSION["id"]==$idpart || $_SESSION["tipo"]==2){
		  include("editarresumocontinuacao.php");
	  //}else{
	  //   echo "<h2><b>Operação NãoPermitida...<br>VOLTE PARA SUA SESSÃO</b></h2>
	  //   <br><br><a href='index.php?l=verResumos&id=".$_SESSION['codigo']."'>";
	  //}
	?>
	</section>
</section>
<script>countit();</script>
