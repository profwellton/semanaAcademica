<meta charset="utf8">
<?php
  	mysql_connect("localhost", "salin", "S@l1n");
	mysql_select_db("salin");
	session_start();

	$codigo=$_GET["codigo"];

	$sql = mysql_query("SELECT * FROM 2016_resumos WHERE md5='$codigo'") or die(mysql_error());
	$mostrar = mysql_fetch_array($sql);

	echo "Área: ".$mostrar["pasta"]."<br><h2>".$mostrar["titulo"]."</h2><br><br>".$mostrar["resumo"]."<br><br>Palavras-chave: ".$mostrar["palavrasChave"];



?>
