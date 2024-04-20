<?php

  mysql_connect("localhost", "wcti", "wcti**");
  mysql_select_db("wcti");

  $oficina=$_GET["oficina"];

  // Faz loop pelo array dos numeros
  foreach($_POST["par"] as $numero)
  {

      $numero = explode("##", $numero);

  //    echo "- " . $numero[0] . " - " . $numero[1]. "<BR>";

      $certificado = "http://wcti.fb.utfpr.edu.br/certificados/imprimirCertificado.php?cod_participante=".$numero[1]."&tipo=oficinas&oficina=$oficina";
//echo $certificado;

      if(mysql_query("UPDATE 2015_participantes_minicursos SET presenca=1, certificado='$certificado' WHERE id=".$numero[0])){
        echo "atualizado com sucesso!!<br>";        
      }




  }


  
?>

<a href="presencaoficina.php"><<< VOLTAR  </a>
