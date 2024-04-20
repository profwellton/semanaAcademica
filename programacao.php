<?php
include("conexao.php");

?>

<!-- center><h2>PROGRAMAÇÃO</h2></center><br><br-->
<br>

<table border>
    <tr>
 <th width=125>Data</th><th width=200>22/04/2024 (Segunda)</th><th width=500>Quem</th><th>Local</th><th width="1" align="center">Vagas</th></tr>
    <tr><td>18h40</td><td>Credenciamento</td><td>CASIS e Voluntários</td><td>Hall de entrada<br>(Bloco A)</td><td></td></tr>
    
    
    <tr><td>19h</td><td>Abertura da Semana Acadêmica</td><td>Orquestra da UTFPR</td><td>Anfiteatro<br>(Bloco A)</td><td>150</td></tr>
   
<tr><td>19h15 - 19:25</td><td><b>Metodologia Montessori e seu impacto na computação atual<b></td><td><b>Professora Anikeli Rios</><br> Especialista na Metodologia Montessori e co-fundadora da Escola Montessori em Francisco Belrão</td><td>Anfiteatro<br>(Bloco A)</td><td>150</td></tr>
  
    
    <tr><td>19h25 - 20h55</td><td><b>Palestra: Como programar um computador quântico <br>
 <!-- a href="declaracao_palestrante.php?hash=d7a7fe906522b86a778a4b2193681865">Baixar declaração aqui</a-->
    </td> 
    
    <td><b>Evandro C. R. da Rosa</b> <br> Co-fundador da Quantuloop, start-up brasileira de computação quântica, e membro do Grupo de Computação Quântica da UFSC (GCQ-UFSC) </td>
    
    <td>Anfiteatro<br>(Bloco A)</td><td>150</td>
    </tr>
    
    <tr>
 <td>20h55 às 21h10</td><td  colspan="4"><i>Coffee Break - Hall de entrada Bloco A</i></td>
    </tr>
    
    <tr><td rowspan="7">21h20 às 23h </td><td rowspan="7">Oficinas</td>
 
 <?php
 $sql = mysqli_query($c, "SELECT * FROM ".$ano."_oficinas WHERE dia=22") or die(mysqli_error($c));
 while($m = mysqli_fetch_array($sql)){
 ?>
     
     <td><strong><?=$m["titulo"]?></strong><br><?=$m["ministrante"]?> </td>
     <td> <?=$m["sala"]?> </td>
     <td> <?=$m["vagas"]?> </td>
    </tr>
    <tr>
 
 <?php 
 }
 ?>
    </tr>
       
</table>
<br>
<br>

<table border>
    <tr><th width="70">Data</th><th width=190>23/04/2024 (Terça)</th><th>Descrição</th><th>Local</th><th width="1" align="center">Vagas</th></tr>     
    <tr><td rowspan="4">14h - 16h</td>
 <td rowspan="4">Oficinas direcionadas aos estudantes do Técnico em Desenvolvimento de Sistemas </td>
 <td><strong> Introdução à redes cabeadas e sem fio </strong><br> Mateus Vitale </td>
  <td> Q202 </td>
 <td> 25 </td>
    </tr>
    <td><strong> Introdução a Algoritmos usando Python </strong><br> Caetano Biss </td>
    <td> Q204 </td>
    <td> 25 </td>
    </tr>
    <tr>
 <td><strong> Projeto Transformar: Transformando TVBox em computadores </strong><br> Eric Endres, Igor Kussumoto, Manuela B. Cannizza </td>
  <td> Q207 </td>
 <td> 25 </td>
    </tr>
    <tr>
 <td><strong> Introdução ao Blender </strong><br> Manu Cima e Ana Carolina </td>
  <td> Q208 </td>
 <td> 25 </td>
    </tr>
    
    </tr>
    
</table>
<br>
<br>


<table border>
    <tr><th width="125">Data</th><th width=200>23/04/2024 (Terça)</th><th width=500>Descrição</th><th>Local</th><th width="1" align="center">Vagas</th></tr>     
    
    <tr><td rowspan="7">19h15 às 20h40 </td><td rowspan="7">Oficinas</td>
 
 <?php
 $sql = mysqli_query($c, "SELECT * FROM ".$ano."_oficinas WHERE dia=23 limit 7") or die(mysqli_error($c));
 while($m = mysqli_fetch_array($sql)){
 ?>
     
     <td><strong><?=$m["titulo"]?></strong><br><?=$m["ministrante"]?> </td>
     <td> <?=$m["sala"]?> </td>
     <td> <?=$m["vagas"]?> </td>
    </tr>
    <tr>
 
 <?php 
 }
 ?>
    </tr>
    
    <tr>
 <td>20:45 às 21:10</td><td  colspan="4"><i>Coffee Break - Centro de Convivência</i></td>
    </tr>
    
    <tr><td>20h45 - 23h</td><td><b>Feira de Profissões</b></td><td>Encontro com empresas de Francisco Beltrão <br><strong> Megasult, Nubetec, Ampernet, entre outras</strong></td>
 
 <td >Centro de Convivência</td><td >200</td>
    </td></tr>
    
</table>
<br>
<br>

<table border>
    <tr><th width="110">Data</th><th width=190>24/04/2024 (Quarta)</th><th>Quem</th><th>Local</th><th width="1" align="center">Vagas</th></tr>

<tr><td>19h15 - 20h45</td><td><b>Palestra: Carreira na área de TI e experiência no Parque Tecnológico de Itaipu (PTI) </b> </td><td><b>Felipe Theodoro Guimarães</b><br> Analista de Sistemas na Fundação do PTI no Centro de Tecnologias Abertas (TA.DT), trabalhando com Análise de Dados, Desenvolvimento Back-end e adequação de projetos com a LGPD. Licenciado em Informática (UTFPR) e Especialista em Informática Instrumental e Lei Geral de Proteção de Dados Pessoais. </td>
 <td>Anfiteatro<br>(Bloco A)</td>
 <td>150</td>
    </tr>
    
    <tr>
 <td>20:45 às 21:10</td><td  colspan="4"><i>Coffee Break - Centro de Convivência </i></td>
    </tr>
    <tr>
 <td>20:45 - 23h</td>
 <td><b>Momento Cultural</b></td>
 <td>Campeonato de Xadrez<br>Campeonato de Quake (FPS) e FIFA<br>Jogos com VR <br>Tênis de Mesa<br><br>Instrumentos musicais liberados para quem quiser tocar (bateria, guitarra, baixo, teclado, tocar junto com playback...). Aberto para bandas também.</td>
 <td>Centro de Convivência</td><td>200</td>
    </tr>
         <!--
   
   <?php
   $sql = mysqli_query($c, "SELECT * FROM 2022_oficinas WHERE idOficina>6") or die(mysqli_error($c));
   while($m = mysqli_fetch_array($sql)){
   ?>
   
   <tr><td><?=utf8_encode($m["horario"])?></td><td><b>Oficina <?=$m["idOficina"]?></b>: <?=utf8_encode($m["titulo"])?>
   <td><?=$m["ministrante"]?></td>
   
   <td><?=$m["sala"]?></td>
   <td><?=$m["vagas"]?></td>
   </td></tr>
   
   
   <?php 
   }
   ?>
     -->
    
</table>
<br>


<!-- table border>
     <tr><th width="125">Data</th><th width=400>06/08/2021 (Sexta-Feira)</th><th>Quem</th><th>Local</th><th  width="1" align="center">Vagas</th></tr>
     <tr><td>19h30 - 19h50</td><td>Abertura da Sala e Encaminhamentos</td><td>CA / COLIN</td><td rowspan="3">Online</td><td  rowspan="3"> Ilimitada</td></tr>     
     <tr><td>20h00 - 21h00</td><td><b>Talk 5: Experiências fora do País e informática: Amazon (AWS) e Debian</b><br><br>
         <a href="declaracao_palestrante.php?hash=efa5edec421066095ad4c7269c08838c">Baixar declaração aqui</a>
     </td><td>Samuel Henrique (Amazon)

     </td></tr>
     <tr><td>21h00 - 22h00</td><td><b>Talk 6: Road com Egressos de Licenciatura em Informática</b><br><br>

         <?php
     /*    include("conexao.php");
         
         
         $dr = mysqli_query($c, "SELECT * FROM " . $ano . "_atividades WHERE id>59 ORDER BY palestrante");
         while($mostra = mysqli_fetch_array($dr)){

      echo "<br><a href='declaracao_palestrante.php?hash=".$mostra["hash"]."'>" .$mostra["palestrante"] . " - Baixar declaração aqui</a><br><br>";

         */
         ?>

     </td><td>Egressos de Licenciatura em Informática UTFPR/FB</td></tr>
     <tr><td><b><span class="vermelho">GRAVAÇÃO:</span></b></td><td  colspan="4"><a href="https://youtu.be/7hd2aWuD4QM"><span class="vermelho">https://youtu.be/7hd2aWuD4QM</span> </a> </td></tr>

     </tr>
        </table-->
