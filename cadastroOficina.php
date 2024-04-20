<?php

include("conexao.php");

$titulo = $_POST["titulo"];
$quem = $_POST["quem"];
$local = $_POST["local"];
$vagas = $_POST["vagas"];
$dia = $_POST["dia"];
$horario = $_POST["horario"];

$data = "$dia/04/2024";


$query = mysqli_query($c, "INSERT INTO ".$ano."_oficinas (titulo, ministrante, sala, vagas, data, horario, dia) VALUES ('$titulo', '$quem', '$local', '$vagas', '$data', '$horario', '$dia')") or die(mysqli_error($c));

if($query) header("location: painel.php#inscricoes");
