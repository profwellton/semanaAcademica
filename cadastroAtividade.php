<?php

include("conexao.php");

$titulo = $_POST["titulo"];
$tipo = "Palestra";
$quem = $_POST["quem"];
$local = $_POST["local"];
$vagas = $_POST["vagas"];
$dia = $_POST["dia"];
$horario = $_POST["horario"];

$data = "$dia/04/2024";


$query = mysqli_query($c, "INSERT INTO ".$ano."_atividades (atividade, tipo, palestrante, sala, vagas, data, horario) VALUES ('$titulo', '$tipo', '$quem', '$local', '$vagas', '$dia', '$horario')") or die(mysqli_error($c));

if($query) header("location: painel.php#atividades");
