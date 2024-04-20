<?php
	session_start();
	if($_SESSION['id']==""){
	  header("location:login.php");
	}
	mysql_connect("localhost", "salin", "S@l1n");
	mysql_select_db("salin");
?>

<section class="enviarresumo">
	<div id=envia></div>

	<h2>Enviar Resumo</h2><br>

      <form action="resumoBanco.php" name="form" class="form_resumo" method="POST" onsubmit="if(restante<0){alert('Limite de 500 palavras excedido'); return false;}else{return checkForm();}">
        <table width="100%" border="0" >
          <tr>
            <td width="13%" valign="top"><span class="campo">Autores</span></td>
            <td colspan="2" align="left">
		Autor 1: <input name="autor1" type="text" id="autor1" size="30" maxlength="200" value="<?php echo $_SESSION['nome']; ?>">
		<img border=0 src='img/vazio.png'><br>
		<div id="adicionar"> </div><br>
	    </td>
    	    <td  valign="top">
		<input type="hidden" value="0" id="theValue" />
		<input type="button" onmousedown="adicionarAutor();" value="Adicionar autor" class="bot3" />
	    </td>
          </tr>

					<tr>
					  <td><span class="campo">Link do Grupo<br> de Pesquisa: </span></td>
					  <td><input type="text" size="50" class="" name="grupo" />
					</tr>


	  <tr>
            <td width="13%"><span class="campo">Área: </span></td>
            <td colspan="3">

		<select name="pasta" id="pasta" class="pasta" required>
			<option></option>


			<?php
				$sql=mysql_query("SELECT * FROM 2015_pastas") or die(mysql_error());
				while($row = mysql_fetch_array( $sql )){
					$pasta = utf8_encode($row["pasta"]);
					echo "<option value='$pasta'>$pasta</option>";
				}
			?>


		</select>

            <font color="#FF0000">*</font></td>
          </tr>


          <tr>
            <td width="13%"><span class="campo">T&iacute;tulo</span></td>
            <td colspan="3"><input value="<?php echo $titulo; ?>" name="titulo" type="text" id="titulo" size="50" maxlength="200"  />
            <font color="#FF0000">*</font></td>
          </tr>
          <tr>
            <td><span class="campo">Resumo </span></td>
            <td width="37%" colspan=4>
		<!--span id='cont'><font color=black size=4>Faltam <span id=contador>500</span> palavras </FORM></font></span-->
		<textarea onkeyup=countit() name="resumo" id="resumotxt" maxlength="5000" rows=20 cols=50><?php echo $resumo; ?></textarea>*
		<br>
		<span id='cont'><font color=black size=4>Faltam <span id=contador2>500</span> palavras </FORM></font></span>
	    </td>
          </tr>

          <tr>
            <td><span class="campo">Palavras<br>-chave</span></td>
            <td colspan="3"><input value="<?php echo $palavrasChave; ?>" type="text" name="palavrasChave" id="palavraschave" size=50 required />
            <font color="#FF0000">*</font></td>
          </tr>

            <tr class="bg1">
              <td colspan="4"><center><br>
		<button name="enviarresumo" class="btn_resumo" value="Enviar Resumo">
			Finalizar e Enviar Resumo
		</button>
	      </td>
            </tr>
        </table>
        <font color="#FF0000">*</font> Campos Obrigat&oacute;rios <br />
      </form>

    </center>
<script>
	//document.getElementById('autor1').focus();
</script>
</section>
