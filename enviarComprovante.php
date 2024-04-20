<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include("conexao.php");

$target_dir = "comprovantes/";
$target_file = $target_dir .  date("Y-m-d H:i:s") .  basename($_FILES["comprovante"]["name"]);

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$check = $_FILES["comprovante"]["tmp_name"];

if(move_uploaded_file($check, "$target_file")){
	
	mysqli_query($c, "UPDATE ".$ano."_participantes SET comprovante='$target_file' WHERE id=".$_SESSION['id']);

header("location: painel.php");

}else{
	echo "Erro ao enviar. Entre em contato com wcoliveira@utfpr.edu.br e relate o erro, por favor.";
}

?>
