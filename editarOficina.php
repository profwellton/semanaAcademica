<?php

include("conexao.php");
$oficina = $_GET["oficina"];

$query = mysqli_query($c, "SELECT * FROM ".$ano."_oficinas WHERE idOficina=$oficina");
$m = mysqli_fetch_array($query);
$titulo = $m["titulo"];
$ministrante = $m["ministrante"];
$dia = $m["dia"];
$vagas = $m["vagas"];
$sala = $m["sala"];
$horario = $m["horario"];

?>
<span class="inscricoes">
<form method="POST" action="editaMiniCurso.php?oficina=<?=$oficina?>" id="formulario" class="formulario">
    <input type="text" name="titulo" class="nome" placeholder="Título" value="<?=$titulo?>" required/><br>
    <input type="text" name="ministrante" class="cpf" placeholder="Quem" value="<?=$ministrante?>"  required /><br>
    <input type="text" name="sala" class="email" placeholder="Local" value="<?=$sala?>" required /><br>
    <input type="number" name="vagas" class="ra" placeholder="Vagas" value="<?=$vagas?>" required /><br>
    <input type="text" name="dia" class="ra" placeholder="Dia" value="<?=$dia?>" required/><br>
    <input type="text" name="horario" class="ra" placeholder="Horário" value="<?=$horario?>" required/><br>
    <input type="submit" name="btn_cadastrar" class="btn_cadastrar" value="Editar Oficina" />
</form>
</span>
