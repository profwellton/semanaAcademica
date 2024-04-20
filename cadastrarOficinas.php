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
echo "<h2>Cadastrar Nova Oficina</h2>";
echo "<h4 style='text-align: center; color:#008F44'>".$_SESSION["mensagem"]."</h4><br />";
$_SESSION["mensagem"]="";

?>
<br>
<span class='inscricoes'>
<form method="POST" action="cadastroOficina.php" id="formulario" class="formulario">
    <input type="text" name="titulo" class="nome" placeholder="Título da oficina?" required/><br><br>
    <input type="text" name="quem" class="cpf" placeholder="Ministrante?"  required /><br><br>
    <input type="text" name="local" class="email" placeholder="Local" required /><br><br>
    <input type="number" name="vagas" class="email" placeholder="Número de vagas" required /><br><br>
    <!--input type="text" name="dia" class="nome" placeholder="Dia" required/><br><br-->
    <select name="dia" class="pasta" required>
      <option value="" disabled selected hidden>Escolha o dia da oficina</option>

        <option value="22">22/04/2024</option>
        <option value="23">23/04/2024</option>
    </select><br><br>
    <input type="text" name="horario" class="nome" placeholder="Horário" required/><br><br>
    <select name="horario" class="pasta" required placeholder="Horário da oficina">
      <option value="" disabled selected hidden>Escolha o horário da Oficina</option>

        <option value="21:20">21:20</option>
        <option value="19:15">19:15</option>
<option value="14:00">14h</option>
    </select><br><br>
    <center><input type="submit" name="btn_cadastrar" class="btn_cadastrar" value="Cadastrar Oficina" /></center><br />
</form>
</span>
<br><br> <hr><br><br> 
<h2>Participantes inscritos por Oficina</h2><br>
<a href="inscritosoficinas.php" target="_BLANK">Ver Todos inscritos por oficina</a>
<?php

include("conexao.php");

$query = mysqli_query($c, "SELECT * FROM ".$ano."_oficinas order by dia");
echo "<table border><tr><th colspan=3 align=center>Funções</th><th>Oficina</th><th>Ministrante</th><th>Sala</th><th>Vagas</th><th>Data</th></tr>";
while($m = mysqli_fetch_array($query)){

    echo "<tr>
            <td id='botaoVer".$m["idOficina"]."'><a href='javascript:void(0)' onclick=\"ajax('ver', ".$m["idOficina"].")\">Ver</a></td>
            <td><a href='javascript:void(0)' onclick=\"ajax('editar', ".$m["idOficina"].")\">Editar</a></td>
            <td><a href='inscritosoficinas.php?oficina=".$m["idOficina"]."' target='_BLANK'>Imprimir</a></td>

            <td><a href='javascript:void(0)' onclick=\"ajax('ver', ".$m["idOficina"].")\">".$m["titulo"]."</a></td>
            <td>".$m["ministrante"]."</td>
            <td>".$m["sala"]."</td>
            <td>".$m["vagas"]."</td>
            <td>".$m["data"]."</td>
         </tr>
<tr>
<td colspan=8><span id='ver".$m["idOficina"]."'></span></td>
</tr>";

}
echo "</table><br><br>";

?>
