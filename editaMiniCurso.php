<?php

include("conexao.php");

$oficina = $_GET["oficina"];
$titulo = $_POST["titulo"];
$ministrante = $_POST["ministrante"];
$sala = $_POST["sala"];
$vagas = $_POST["vagas"];
$dia = $_POST["dia"];
$horario = $_POST["horario"];

$data = "$dia/$mes/$ano";


$query = mysqli_query($c, "UPDATE ".$ano."_oficinas SET titulo='$titulo', ministrante='$ministrante', sala='$sala', data='$data', horario='$horario', dia='$dia' WHERE idOficina=$oficina") or die(mysqli_error($c));

if($query) header("location: painel.php#minicursos");
