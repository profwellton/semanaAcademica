<center>
<div id="editado"></div>
	<h4><a target="_BLANK" href='https://www.evernote.com/shard/s3/sh/97e26710-7c3e-44ce-9483-af91d8ebff7a/4575f183c3db8b8c'>CLIQUE AQUI VER INSTRUÇÕES AOS AUTORES SOBRE ENVIO DE RESUMO</a></h4><br>
  <?php
	  if($_GET["editado"]=="ok")
		{
		  $id=$_GET["idResumo"];
		  echo "<div class='verde'>Resumo #$id Editado com sucesso</div>";
		}
	 ?>
   <br>
   <?php
		  if($_GET["enviado"]=="ok")
		  echo "<span class='verde'>Resumo enviado com sucesso</span>";
	 ?>
	 <br>
	 <h2>MEUS RESUMOS </h2><br><br>
	 <?php
		   if($_GET["md5"]=="true") echo "<h3><span class='verde'>Resumo deletado com sucesso</span></h3>";
			 $result = mysql_query("SELECT * FROM 2016_resumos WHERE idParticipante=".$_SESSION["id"]) or die(mysql_error());
		   if(mysql_num_rows($result)==0) echo "Você não enviou nenhum resumo. Mande um Resumo abaixo.";
		   else{
		      echo "   <table border='1'>";
	    	  echo "      <tr>";
	//        echo "         <th></th><th>#id</th><th>Título</th><th>Área</th><th>Autores</th><th>Editar</th><th>Excluir</th><th>pdf</th>";
                echo "         <th></th><th>#id</th><th>Título</th><th>Área</th><th>Autores</th><th>Excluir</th><th>pdf</th>";
        
        	echo "      </tr>";
		      $i=1;
		      while($row = mysql_fetch_array( $result )) {
			       echo "   <tr>";
			       echo "     <td>$i</td>";
			       echo "     <td>".$row['id']."</td>";
			       echo "     <td width=300>".$row['titulo']."</td>";
			       echo "     <td width=200>".$row['pasta']."</td>";
			       echo "     <td width=200>";
  	       			           $autores = explode("____", $row['autores']);
				                   for($x=0; $x<100; $x++) if($autores[$x]!="") echo $autores[$x] . "<br>";
			   		 echo "     </td>";
			       //echo "     <td> <a href='painel.php?trabalho=".$row['id']."#editarresumo'><img src='img/editar.png' width=30></a> </td>";
			       
			       echo "     <td>  <h4><span class='vermelho'>ENCERRADO</span></h4> </td>";

						            $idx=$_SESSION['id'];
			                  $idxx=$row['id'];
			                  $titulox=str_replace("\"", "", $row['titulo']);
	        	 //echo "     <td><a href='javascript:confirmar($idx, $idxx, \"$titulox\")'><img src='img/excluir.png' width=30></a></td>";
             echo "   <td><a href='fpdf/pdf.php?id=".$row['id']."&nome=com'><img src='img/downloadResumo.png' width=30></a></td>";
        		 echo " </tr>";

			   $i++;
		      }
		      echo "</table>";
		    }
		?>
<br><br>
