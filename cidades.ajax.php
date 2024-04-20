<?php
header( 'Cache-Control: no-cache' );
header( 'Content-type: application/json; charset="utf-8"', true );

include("conexao.php");

$cod_estados = $_GET['cod_estados'];

$cidades = array();

$sql = "SELECT cod_cidades, nome
    FROM cidades
    WHERE estados_cod_estados=$cod_estados
    ORDER BY nome";

$res = mysqli_query( $c, $sql );

while ( $row = mysqli_fetch_array( $res ) ) {

    $cidades[] = array('cod_cidades'  => $row['cod_cidades'],'nome'      => utf8_encode($row['nome']),);
}

echo json_encode( $cidades );
