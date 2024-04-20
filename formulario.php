<?php

session_start();
echo "<h4 style='text-align: center; color:#008F44'>".$_SESSION["mensagem"]."</h4><br />";
$_SESSION["mensagem"]="";

?>
<script>

 function carregaOutro(valor){
     if(valor==6){
	 document.getElementById("curso").innerHTML="";
	 document.getElementById("ra").innerHTML="";

	 document.getElementById("outro").innerHTML="<input type='text' name='instituicao' class='nome' placeholder='Qual sua Instituição?' required/><br><br> ";
	 
     }else if(valor==1){
	 document.getElementById("outro").innerHTML="";
	 document.getElementById("ra").innerHTML="<input type='number' name='ra' class='nome' placeholder='Seu RA ou Matricula, caso aluno ou servidor da UTFPR' /><br><br>";
	 document.getElementById("curso").innerHTML="<select name='curso' class='oficina' required> <option value='' disabled selected hidden>Seu Curso...</option> <option value='Licenciatura em Informática'>Licenciatura em Informática</option> <option value='Bacharelado em Sistemas de Informação'>Bacharelado em Sistemas de Informação</option> <option value='Agronomia'>Agronomia</option> <option value='Engenharia Ambiental e Sanitária'>Engenharia Ambiental e Sanitária</option> <option value='Engenharia de Alimentos'>Engenharia de Alimentos</option> <option value='Engenharia Química'>Engenharia Química</option></select>  <br><br> ";
     }else{
	 document.getElementById("outro").innerHTML="";
	 document.getElementById("curso").innerHTML="";
	 document.getElementById("ra").innerHTML="";
     }
 }

 var iguais=true;
 function vsenha(senha, repitasenha){
     if(senha!=repitasenha){
	 document.getElementById("vsenhared").innerHTML="senhas diferentes";
	 document.getElementById("vsenhagreen").innerHTML="";
	 iguais=false;
     }else{
	 document.getElementById("vsenhagreen").innerHTML="SENHAS OK";
	 document.getElementById("vsenhared").innerHTML="";
	  iguais=true;
     }
 }

</script>
<br>
<form method="POST" action="inscricao.php" id="formulario">

    <input type="text" name="nome" class="nome" placeholder="NOME COMPLETO" required/><br><br>

    <?php 
    
    include("conexao.php");

    $query = mysqli_query($c, "SELECT * FROM ".$ano."_instituicoes ORDER BY id") or die(mysqli_error($c));
    
    echo "<select name='instituicao' class='oficina' onchange=\"carregaOutro(this.value)\" required>";
    echo "      <option value='' disabled selected hidden>Sua instituição...</option>";

    while($ver = mysqli_fetch_array($query)){
	echo "<option id='instituicao".$ver["id"]."' value='".$ver["id"]."'>".utf8_encode($ver["nome"])."</option>";
    }

    echo "</select><br><br>";

    ?>
    <!-- input type="text" name="instituicao" class="nome" placeholder="INSTITUIÇÃO"/><br><br -->
    <span id="outro"></span>
    <span id="curso"></span>

    <span id="ra">
	<input type="number" name="ra" class="nome" placeholder="Seu RA ou Matrícula, caso aluno ou servidor da UTFPR"/><br><br>
    </span>
    
    <!-- input type="text" name="cpf" class="cpf" id="cpf" placeholder="CPF" onBlur="if(!ValidarCPF(formulario.cpf)){alert('CPF Inválido!');} clearTimeout()" onKeyPress="mascara_cpf(this, adapta_cpf)" maxlength="14" /><br><br-->
    <input type="text" name="cpf" class="cpf" id="cpf" placeholder="CPF" onKeyPress="mascara_cpf(this, adapta_cpf)" maxlength="14" required/><br><br>
    <!--Ou, caso seja de outra nacionalidade, preencha seu documento aqui:<br>
	 <input type="text" name="cpf" class="cpf" id="documento" placeholder="DOCUMENTO" maxlength="14"  /><br><br><br-->
    <input type="email" name="email" class="email" placeholder="EMAIL" required /><br><br>
    <input  value="" type="password" id="senha" name="senha" class="email" placeholder="Senha..." onkeyup="vsenha(document.getElementById('repitasenha').value, this.value)" required /><br><br>
    <input  value="" type="password" id="repitasenha" name="repitasenha" class="email" placeholder="Repita Senha..." onkeyup="vsenha(document.getElementById('senha').value, this.value)" required  /> <span id='vsenhared' class='vermelho'></span><span id='vsenhagreen' class='verde'></span><br><br>
    <?php
    //include("oficinas.php");
    ?>
    <br>

    <!--center><input onclick="if(cpferrado){ alert('CPF inválido'); return false; }" type="submit" name="btn_cadastrar" class="btn_cadastrar" value="Cadastrar" /></center><br>
    <center><input  type="submit" name="btn_cadastrar" class="btn_cadastrar" value="Cadastrar" /></center><br-->
<input  type="submit" name="btn_cadastrar" class="btn_cadastrar" value="CADASTRAR" /></center><br />
</form>

<br><br>
<br><br>
