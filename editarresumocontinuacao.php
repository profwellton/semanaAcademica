<script type="text/javascript">
function adicionarAutor() {
  var ni = document.getElementById('myDiv');
  var numi = document.getElementById('theValue');
  var num = (document.getElementById('theValue').value -1)+ 2;
  numi.value = num;
  var newdiv = document.createElement('div');
  var cont = num+1;
  var divIdName = 'tor'+cont;
  newdiv.setAttribute('id',divIdName);

  newdiv.innerHTML = 'Autor '+ cont +': <input  onfocus="this.select()" size="30" maxlength="50" id=\"au'+divIdName+'\" name=\"au'+divIdName+'\"><a href=\'javascript:void(0)\' onclick=\'if(!confirm("Tem certeza?")) return false; else deletarAutor(\"'+divIdName+'\")\'><img border=0 src=\"img/trash.png\">';
  ni.appendChild(newdiv);

  divIdName.focus();
}

function deletarAutor(divNum) {
  var d = document.getElementById('myDiv');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}

var cont=501;
var restante=0;
var restanteExibe=0;
function countit(){
   var formcontent=document.getElementById("resumo").value;
   formcontent=formcontent.split(" ");
   restante = cont- formcontent.length;

   restanteExibe=restante;
   if(restante<21 && restante>10) restanteExibe = "<font color='#5C0002'>"+restante+"</font>";
   if(restante<=10) restanteExibe = "<font color='#D40D12'>"+restante+"</font>";

   document.getElementById("contador").innerHTML=restanteExibe;
   document.getElementById("contador2").innerHTML=restanteExibe;
}
</script>

<?php
  $pasta  = mysql_result($sql, 0, "pasta");
  $grupo  = mysql_result($sql, 0, "grupo");
  $titulo  = mysql_result($sql, 0, "titulo");
  $autores = mysql_result($sql, 0, "autores");
  $resumo  = mysql_result($sql, 0, "resumo");
  $palavrasChave = mysql_result($sql, 0, "palavrasChave");
  $numPalavras = sizeof(explode(" ", $resumo));
  $total=502;
  $resultado = $total-$numPalavras;
  if($resultado<21 && $resultado>10) $resultado = "<font color='#5C0002'>$resultado</font>";
  if($resultado<=10) $resultado = "<font color='#D40D12'>$resultado</font>";
?>

<center>
	<?php if($_GET["editado"]=="ok")echo "<h3><span class='verde'>Resumo atualizado com sucesso</span></h3>";?>

	<form action="resumoBanco.php?idresumo=<?php echo $codigoResumo; ?>" name="form" class="form_resumo" method="POST" onsubmit="if(restante<0){alert('Limite de 500 palavras excedido'); return false;}else{return checkForm();}">
	   <table width="100%" border="0" >
	      <tr>
		       <td width="13%"><span class="campo">Autores</span></td>
		       <td colspan="2" align="center">
		          <div id="myDiv">
		             <?php
		               $numero=0;
		               $autores = explode("__", $autores);
		               for($x=0; $x<sizeof($autores); $x++)
		               {
			                if($autores[$x]!="")
			                {
			                   $numero++;
			                   echo "<div id='tor$numero'>";
			                   echo "Autor $numero:<input  name='autor$numero' id='autor$numero' size='30' maxlength='200' value='".$autores[$x]."' />";

			                   if($x==0)
			                   {
				                    echo "<span class='vermelho'>*</span>";
			                    }else
                          {
			                      echo "<a href='javascript:void(0)' onclick=\"if(!confirm('Tem certeza?')){ return false; }else{ deletarAutor('tor$numero');}\"><img border='0' src='img/trash.png'></a>";
			                    }
			                    echo "<br /></div>";
			                }
		               }
		               $nauto=$numero-1;
		             ?>
		          </div>
              <br>
		       </td>
		       <td>
		          <input type="hidden" value="<?php echo $nauto; ?>" id="theValue" />
		          <input type="button" onmousedown="adicionarAutor();" value="Adicionar autor" class="bot3" />
		       </td>
	      </tr>
        <tr>
          <td><span class="campo">Link do Grupo<br> de Pesquisa: </span></td>
          <td><input  value="<?php echo $grupo; ?>" type="text" size="50" class="" name="grupo" /></td>
        </tr>
        <tr>
		      <td width="13%"><span class="campo">Área: </span></td>
		      <td colspan="3">
		         <select name="pasta" id="pasta" class="pasta" required>
		           <option></option>
			         <?php
			           $sql=mysql_query("SELECT * FROM 2016_pastas") or die(mysql_error());
			           while($mostrar=mysql_fetch_array($sql)){
			              if(utf8_encode($mostrar["pasta"])==$pasta) $s = "selected";
			              else $s="";
			              echo "<option value='".utf8_encode($mostrar["pasta"])."' $s>".utf8_encode($mostrar["pasta"])."</option>";
			           }
			         ?>
		         </select>
		         <span class='vermelho'>*</span>
		      </td>
	      </tr>
	      <tr>
		       <td width="13%"><span class="campo">T&iacute;tulo</span></td>
		       <td colspan="3">
		          <input value='<?php echo $titulo; ?>' name="titulo" type="text" id="titulo" size="50" maxlength="200" />
		          <span class='vermelho'>*</span>
		       </td>
	      </tr>
	      <tr>
		       <td><span class="campo">Resumo</span></td>
		       <td width="37%" colspan=4>
		          <!--span id='cont'><font color=black size=4>Faltam <span id=contador>500</span> palavras </FORM></font></span-->
		          <textarea onkeyup=countit() name="resumo" id="resumo" rows=20 cols=50><?php echo $resumo; ?></textarea>*<br>
		          <span id='cont'><font color=black size=4>Faltam <span id=contador2>500</span> palavras </FORM></font></span>
		       </td>
	      </tr>
	      <tr>
		       <td><span class="campo">Palavras-chave</span></td>
		       <td colspan="3">
		          <input value="<?php echo $palavrasChave; ?>" type="text" name="palavrasChave" id="palavraschave" size=50 />
		          <span class='vermelho'>*</span>
		       </td>
	      </tr>
	      <tr class="bg1">
		       <td colspan="4"><center><br>
		           <button name="enviarresumo" class="btn_resumo" value="Enviar Resumo">Finalizar e Enviar Modificações do Resumo</button><br>
		           <a href="painel.php">Cancelar e Voltar para Painel</a>
		       </td>
	      </tr>
	   </table>
	   <span class='vermelho'>*</span> Campos Obrigat&oacute;rios <br />
	</form>
	</center>
