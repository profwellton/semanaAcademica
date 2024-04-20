<h3>Escolha suas oficinas abaixo:</h3>
    
<?php

include("conexao.php");

$query = mysqli_query($c, "SELECT * FROM ".$ano."_oficinas ORDER BY titulo") or die(mysqli_error($c));
$cont = mysqli_num_rows($query);
if($cont == 0){

    echo "<select name='oficina' class='oficina'><option value=''>Oficinas serão abertas em breve...</option></select>";

}else{
    $x=0;
    while($x<2){
        if($x==0){$dia=22; $diasemana="terça";}
        if($x==1){$dia=23; $diasemana="quinta";}

        $query = mysqli_query($c, "SELECT * FROM ".$ano."_oficinas WHERE dia=$dia ORDER BY idOficina") or die(mysqli_error($c));

        echo "<select name='oficina[$x]' class='oficina'><option value=''>ESCOLHA SUA OFICINA PARA O DIA $dia/04 - $diasemana-feira</option>";
        while($mostrar = mysqli_fetch_array($query)){
            $idOficina=$mostrar["idOficina"];
            $vagas=$mostrar["vagas"];
		  
            if($vagas>0){
                if($mostrar["idOficina"]==20){
                    echo "<option value='$idOficina#$vagas'> VAGAS ILIMITADAS - " .$mostrar["titulo"] . " - " . $mostrar["ministrante"]." - " . $mostrar["sala"]."</option>";
                }else{
                    echo utf8_encode("<option value='$idOficina#$vagas'> Restam " . $mostrar["vagas"] . " VAGAS - " .$mostrar["titulo"] . " - " . $mostrar["ministrante"]." - " . $mostrar["sala"]."</option>");
                }
            }else{
		echo "<option value='$idOficina#$vagas' disabled> (LOTADO) - " . utf8_encode($mostrar["titulo"]) . " - " . $mostrar["ministrante"]." - " . $mostrar["sala"]."</option>
";
		  
            }	        
        }
        echo "</select>";
        $x++;
    }

}
?>
    <br><br>
