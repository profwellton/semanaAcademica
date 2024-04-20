<?php

	session_start();
	if($_SESSION["nome"]==""){
		header("location:index.php");
	}

?>

<meta charset="utf8" />
<style>
	.linha{
		border: 2px dotted #999;
	}
</style>
<center>
<img src="imagem.png" />

<?php

include("conexao.php");

	$nome 		= $_SESSION['nome'];
	$instituicao 	= $_SESSION['instituicao'];
	$ra 		= $_SESSION['ra'];
	$cidade 	= $_SESSION['cidade'];
	$estado 	= $_SESSION['estado'];
	$cpf 		= $_SESSION['cpf'];
	$email 		= $_SESSION['email'];
	$dataCadastro 	= $_SESSION['dataCadastro'];
	$oficina1	= $_SESSION['oficina1'];
	$oficina2	= $_SESSION['oficina2'];


?>

<div id="texto">

<h1>Comprovante de Inscri&ccedil;&atilde;o</h1>

		<font color="green" size=5><b>PRÉ-INSCRIÇÃO DE <?php echo utf8_decode($nome); ?> NA $rom Semana Acadêmica de Licenciatura em Informática REALIZADA COM SUCESSO!</b></font>

<strong>Local: </strong>UTFPR - Francisco Beltrão<br> Contatos: colin-fb@utfpr.edu.br - Telefone:  +55 (46) 3520-2635
<br /><br />

<table border="1px" width=100% bgcolor="#F3F3F3">

  <tr>
     <td >Nome: <?php echo utf8_decode($nome); ?></td>

     <td>Institui&ccedil;&atilde;o: <?php echo utf8_decode($instituicao); ?></td>
  </tr>

  <tr>
  <td>Cidade: <?php echo $cidade; ?></td>
<td>Estado:<?php echo utf8_decode($estado); ?></td>

</tr>
<tr>
<td>Código do Crachá: <?php echo $ra; ?></td>
 <td>CPF: <?php echo $cpf; ?></td>
</tr>


<?php
	$sql = mysql_query("SELECT * FROM ".$ano."_oficinas WHERE oficina='".$oficina1."'") or die(mysql_error());
	$mostra=mysql_fetch_array($sql);
	echo "<tr><td colspan=2>Curso $x: ".$mostra["dia"]."/11 - ".$mostra["hora"]." - ".$mostra["local"]." - ".utf8_encode($mostra["oficina"])."</td>
	    </tr>";
?>
<!--tr><td><?php echo $oficina1; ?></td></tr-->
<?php } if($oficina2!=""){
$sql = mysql_query("SELECT * FROM 2016_oficinas WHERE oficina='".$oficina2."'") or die(mysql_error());
	$mostra=mysql_fetch_array($sql);
	echo "<tr><td colspan=2>Curso $x: ".$mostra["dia"]."/11 - ".$mostra["hora"]." - ".$mostra["local"]." - ".utf8_encode($mostra["oficina"])."</td>
	    </tr>";
?>
<!--tr><td><?php echo $oficina2; ?></td></tr-->
<?php } if($oficina1==""){


echo "<tr><td colspan=2>Nenhuma Oficina cadastrada</td></tr>";

}?>

<?php
/*
$sql = mysql_query("SELECT * FROM 2015_oficinas WHERE oficina='".$oficina1."'") or die(mysql_error());

if(mysql_num_rows($sql)!=0){
   $x=1;
   while($mostra=mysql_fetch_array($sql)){
      echo "<tr><td colspan=2>Curso $x: ".$mostra["dia"]."/11 - ".$mostra["hora"]." - ".$mostra["local"]." - ".utf8_encode($mostra["oficina"])."</td>
	    </tr>";
      $x++;
   }
}*/

?>

</table>

<table width=100%>
<tr>
<td  align=right>
<br><br>
_________________<br>
RECEBIDO&nbsp;&nbsp;&nbsp;&nbsp;
</td>
</tr>
</table>

<script type="text/javascript">
function printit(){
	document.getElementById("printButton").style.display='none';
	if ((navigator.appName == "Netscape")){
		window.print() ;
	}else{
		var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
		var nCopies = 4; //because i want to print it 4 times
		for(x=0; x<=nCopies;x++){
			document.body.insertAdjacentHTML('beforeEnd', WebBrowser); WebBrowser1.ExecWB(6,-1);
			WebBrowser1.outerHTML = "";
		}
	}
}
</script>


<a href="javascript:void(0)" onClick="printit();" id="printButton"><img border="0" style='border: 0px; padding: 1px' src="http://i254.photobucket.com/albums/hh120/ileitura/printer.png">Imprimir</a>

<!--p><a target="_self" HREF="javaScript:window.print()"><img border="0" style='border: 0px; padding: 1px' src="http://i254.photobucket.com/albums/hh120/ileitura/printer.png">Imprimir</a></p-->

<br><br>
<div class='linha'></div>
<br><br>
(Esta parte é de uso da COLIN)
<br><br><br><br>

<table>
<tr>

<td align=center>
<span class='data'>___/___/_____<br>Data de Recebimento<br><br>
</span>
</td>

<td  align=center>
<span class='responsavel'>__________________________________<br>
Responsável COLIN<br><br>
</span>
</td>

<td  align=center>
<span class='assinatura'>__________________________________<br>
Assinatura do Aluno<br>
<?php echo $nome; ?>
</span>
</td>
</tr>
</table>
