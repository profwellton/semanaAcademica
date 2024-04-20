<?php
	@session_start();

	mysql_connect("localhost", "salin", "S@l1n");
	mysql_select_db("salin");


//$autores = $_POST["autores"];
	            $autores =  $_POST["autor1"] . "____".
				$_POST["autor2"] . "____".
				$_POST["autor3"] . "____".
				$_POST["autor4"] . "____".
				$_POST["autor5"] . "____" .
				$_POST["autor6"] . "____" .
				$_POST["autor7"] . "____" .
				$_POST["autor8"] . "____" .
				$_POST["autor9"] . "____" .
				$_POST["autor10"] ."____" .
				$_POST["autor11"] ."____" .
				$_POST["autor12"] ."____" .
				$_POST["autor13"] ."____" .
				$_POST["autor14"] ."____" .
				$_POST["autor15"] ."____" .
				$_POST["autor16"] ."____" .
				$_POST["autor17"] ."____" .
				$_POST["autor18"] ."____" .
				$_POST["autor19"] ."____" .
				$_POST["autor20"];

	$idParticipante = $_SESSION["id"];

	$pasta = $_POST['pasta'];
	$grupo = $_POST['grupo'];

	$titulo = $_POST['titulo'];
	$resumo = $_POST['resumo'];
	$palavrasChave = $_POST['palavrasChave'];

$titulo = str_replace("'", "\\'", $titulo);
	$resumo = str_replace("'", "\\'", $resumo);


	date_default_timezone_set('America/Sao_Paulo');
	$data = date('Y-m-d H:i');


	$idresumo = $_GET["idresumo"];
if($idresumo==""){



$sqlinsert = "INSERT INTO 2016_resumos (idParticipante, autores, grupo,  pasta, titulo, resumo, palavrasChave,
dataCadastro) VALUES('$idParticipante', '$autores', '$grupo', '$pasta', '$titulo', '$resumo', '$palavrasChave', '$data')";

//	$sqlinsert = "INSERT INTO 2015_resumos (idParticipante, autores, pasta, titulo, resumo, palavrasChave,
//dataCadastro) VALUES(\"$idParticipante\", \"$autores\",\"$pasta\",\"$titulo\", \"$resumo\", \"$palavrasChave\", \"$data\")";
	mysql_query($sqlinsert) or die (mysql_error());
	$hash = md5(mysql_insert_id()."".$data);
	mysql_query("UPDATE 2016_resumos SET md5='$hash' WHERE id='".mysql_insert_id()."'");
	$enviado="ok";
	$titulo = "";
	$resumo = "";
	$palavrasChave = "";
	//include("resumo.php");
	//echo $sqlinsert;

	header("location: painel.php?enviado=ok#editado");

}else{


	$sqlinsert = "UPDATE 2016_resumos SET autores='$autores', grupo='$grupo', pasta='$pasta', titulo='$titulo', resumo='$resumo', palavrasChave='$palavrasChave' WHERE id=$idresumo";
	mysql_query($sqlinsert) or die (mysql_error());
	$enviado="ok";
	$titulo = "";
	$resumo = "";
	$palavrasChave = "";
	//include("resumo.php");
	//echo $sqlinsert;

	header("location: painel.php?idResumo=$idresumo&editado=ok#editado");


}

?>
