<?php

$hash = $_GET["hash"];
$check = $_GET["check"];
session_start();
include("conexao.php");

if($check=="true"){
    $data_pagamento = date('YmdHis');

    $quantidade = mysqli_query($c, "SELECT id FROM ".$ano."_participantes WHERE pagamento=1");    
    $quantidade = mysqli_num_rows($quantidade)+1;
    
    $query = mysqli_query($c, "UPDATE ".$ano."_participantes SET pagamento=1, data_pagamento='$data_pagamento', id_quem_fez_confirmacao_pagamento='".$_SESSION['id']."' , posicao=$quantidade WHERE hash='$hash'");

}if($check=="false"){
    $quantidade = mysqli_query($c, "SELECT id FROM ".$ano."_participantes WHERE pagamento=1");    
    $quantidade = mysqli_num_rows($quantidade)-1;

    $query = mysqli_query($c, "UPDATE ".$ano."_participantes SET pagamento=0, data_pagamento='', id_quem_fez_confirmacao_pagamento='' , posicao=0 WHERE hash='$hash'");
}
if($query){

    if($check=="true"){
        $dt = $data_pagamento;
			$ano = substr($dt, 0, -10);
			$mes = substr($dt, 4, -8);
			$dia = substr($dt, 6, -6);
			$hora= substr($dt, 8, -4);
			$min = substr($dt, 10, -2);
			$seg = substr($dt, -2);

            $data_pagamento="$dia/$mes/$ano $hora:$min:$seg";
            //echo "$data_pagamento<br>Posição: $quantidade##pagamento REALIZADO!! Posição $quantidade.";
            echo "$data_pagamento<br>Posição: $quantidade##pagamento REALIZADO!";
            //if($quantidade <= 100){echo " Tem direito ao Kit =) ";}
            //else{echo " Infelizmente, Não tem direito ao kit. =/";}
        
        
    }
    if($check=="false") echo "##pagamento retirado";
    
}else{

    echo "ERRO DE BANCO" . mysqli_error($c);

}
