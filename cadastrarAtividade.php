<script>
 function ajax(funcao, oficina){
     
     var ajax = new XMLHttpRequest();
     
     if(funcao=='ver'){
	    ajax.open("GET", "inscritosoficinas.php?oficina="+oficina, true);	 
	    document.getElementById('botaoVer'+oficina).innerHTML="<a href='javascript:void(0)' onclick=\"ajax('fechar', "+oficina+")\">[X]</a>";
     }
     
      if(funcao=='fechar'){
        document.getElementById('botaoVer'+oficina).innerHTML="<a href='javascript:void(0)' onclick=\"ajax('ver', "+oficina+")\">Ver</a>";
        document.getElementById('ver'+oficina).innerHTML="";
     }
       
     if(funcao=='editar'){
	    ajax.open("GET", "editarOficina.php?oficina="+oficina, true);	 
     }
     ajax.onreadystatechange = function(){
	 
	    document.getElementById('ver'+oficina).innerHTML="Carregando...";
	 
	    if (ajax.readyState==4 && ajax.status==200){
	        document.getElementById('ver'+oficina).innerHTML=ajax.responseText;
	    }
     }
     ajax.send();
 }
</script>

<?php
session_start();
echo "<h2 id='atividades'>Cadastrar Atividades</h2>";
echo "<h4 style='text-align: center; color:#008F44'>".$_SESSION["mensagem"]."</h4><br />";
$_SESSION["mensagem"]="";
?>
<br>
<span class='inscricoes'>

<form method="POST" action="cadastroAtividade.php" id="formulario" class="formulario">

    <input type="text" name="titulo" class="nome" placeholder="Título da atividade?" required/><br><br>
    <input type="text" name="quem" class="cpf" placeholder="Palestrante?"  required /><br><br>
    <input type="text" name="local" class="email" placeholder="Local" required /><br><br>
    <!--input type="number" name="vagas" class="email" placeholder="Número de vagas" required /><br><br-->
    <!--input type="text" name="dia" class="nome" placeholder="Dia" required/><br><br-->
    <select name="dia" class="pasta" required>
      <option value="" disabled selected hidden>Dia da atividade</option>

        <option value="22">22/04/2024</option>
        <option value="23">23/04/2024</option>
        <option value="23">24/04/2024</option>

    </select><br><br>
    <!--input type="text" name="horario" class="nome" placeholder="Horário" required/><br><br-->
    <select name="horario" class="pasta" required placeholder="Horário da oficina">
      <option value="" disabled selected hidden>Escolha o horário da Oficina</option>

        <option value="21:20">21:20</option>
        <option value="19:15">19:15</option>

    </select><br><br>
    <center><input type="submit" name="btn_cadastrar" class="btn_cadastrar" value="Cadastrar Atividade" /></center><br />
</form>
</span>

<br><br> <hr><br><br> 
<h2>Atividades Cadastradas</h2><br>
<!--a href="inscritosoficinas.php" target="_BLANK">Ver Todos inscritos por oficina</a-->
<?php

include("conexao.php");

$query = mysqli_query($c, "SELECT * FROM ".$ano."_atividades") or die(mysqli_error($c));

echo "<table border><tr><th>Data</th><th>Palestra</th><th>Palestrante</th><th>Lugar</th></tr>";
while($m = mysqli_fetch_array($query)){
?>
    <tr>
        <td>Segunda - <?=$m["data"]?>/04</td>
        <td><?=$m["atividade"]?></td>
        <td><?=$m["palestrante"]?></td>
        <td><?=$m["sala"]?></td>
    </tr>
    <tr>
	<td colspan=8><span id='ver<?=$m["idOficina"]?>'></span></td>
    </tr>
    
<?php 
}
?>
</table>
