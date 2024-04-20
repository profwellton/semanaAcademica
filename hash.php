<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include("conexao.php");

$q = mysqli_query($c, "SELECT ra, id, nome, cpf FROM 2019_participantes") or die(mysqli_error($c));

while ($m = mysqli_fetch_array($q)){

    $hash = md5($m["ra"].$m["id"].$m["nome"].$m["cpf"]);

    mysqli_query($c, "UPDATE 2019_participantes SET hash='$hash' WHERE id=".$m["id"]) or die (mysqli_error($c));
    
}
