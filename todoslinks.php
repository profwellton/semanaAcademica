<meta charset="utf8">
<?php 
  	mysql_connect("localhost", "salin", "S@l1n");
	mysql_select_db("salin");
	session_start();

	$sql = mysql_query("SELECT * FROM 2016_resumos") or die(mysql_error());
	while($mostrar = mysql_fetch_array($sql)){

	    echo "Área: ".$mostrar["pasta"]." - ".$mostrar["titulo"]."<br><a href=http://salin.fb.utfpr.edu.br/vertexto.php?codigo=".$mostrar["md5"].">http://salin.fb.utfpr.edu.br/vertexto.php?codigo=".$mostrar["md5"]."</a><br><br>";

	}

?>
