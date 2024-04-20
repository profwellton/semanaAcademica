<?php

$hash = $_GET["hash"];
$check = $_GET["check"];

include("conexao.php");
session_start();
if($check=="true"){
    $data_confirmacao = date('YmdHis');

    $quantidade = mysqli_query($c, "SELECT id FROM ".$ano."_participantes WHERE confirmacao=1");    
    $quantidade = mysqli_num_rows($quantidade)+1;
    
    $query = mysqli_query($c, "UPDATE ".$ano."_participantes SET confirmacao=1, data_confirmacao='$data_confirmacao', id_quem_fez_comprovante_aceito='".$_SESSION['id']."' , posicao=$quantidade WHERE hash='$hash'");

}if($check=="false"){
    $quantidade = mysqli_query($c, "SELECT id FROM ".$ano."_participantes WHERE confirmacao=1");    
    $quantidade = mysqli_num_rows($quantidade)-1;

    $query = mysqli_query($c, "UPDATE ".$ano."_participantes SET confirmacao=0, data_confirmacao='', id_quem_fez_comprovante_aceito='',  posicao=0 WHERE hash='$hash'");
}
if($query){

    if($check=="true"){
        $dt = $data_confirmacao;
			$ano = substr($dt, 0, -10);
			$mes = substr($dt, 4, -8);
			$dia = substr($dt, 6, -6);
			$hora= substr($dt, 8, -4);
			$min = substr($dt, 10, -2);
			$seg = substr($dt, -2);

            $data_confirmacao="$dia/$mes/$ano $hora:$min:$seg";
            //echo "$data_confirmacao<br>Posição: $quantidade##confirmacao REALIZADO!! Posição $quantidade.";
            echo "$data_confirmacao<br>Posição: $quantidade##confirmação REALIZADA!";
            //if($quantidade <= 100){echo " Tem direito ao Kit =) ";}
            //else{echo " Infelizmente, Não tem direito ao kit. =/";}
        
        
    }
    if($check=="false") echo "##confirmação retirada";
    
}else{

    echo "ERRO DE BANCO" . mysqli_error($c);

}
