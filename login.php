<div  id="login">
        <aside class="c_login">
        <aside class="login">
        <form method="POST" action="validalogin.php">
        <h1>Login</h1>
<?php
        //        echo "<div class='verde'>".$_GET["m"]."</div>";
$email=@$_GET["email"];
if($_GET["erro"]==1)	echo "<span class='vermelho'>Senha Incorreta ou Usuário inexistente</span>";
if($_GET["erro"]==2)	echo "<span class='vermelho'>Tempo expirado. Se logue novamente.</span>";
if($_GET["i"]==1)	echo "<span class='verde'>Sua nova senha foi enviada para o email.</span>";


    			$erro = $_SESSION["erro"];
			$email = @$_GET["email"];
   			if($erro==1)
			    echo "<span class='vermelho'>Email inválido ou Senha Incorreta.</span><br>";
   			if($erro==2)
			    echo "<span class='vermelho'>Tempo expirado. Se logue novamente.</span>";
   			
			if($_SESSION["m"]!=""){
			    echo "<span class='verde'>Sua nova senha foi alterada com sucesso.</span>";
			    $_SESSION["m"]="";
			}
			if($_GET["m"]=="email_senha_enviado"){
			    echo "<span class='verde'>Uma mensagem será enviado para você. Acesse seu email, clique no link enviado e altere sua senha. Procure também na caixa de SPAM</span><br>";
			}
			$_SESSION["erro"]="";
			$link = $_GET["link"];

			if($_SESSION["m"]!=""){
			    echo "<span class='verde'>".$_SESSION['mensagem']."</strong></span>";
			    $_SESSION["mensagem"]="";
			}

			echo $_SESSION["mensagem"];
?>   	
    <br />
        <input type="text" id="email" name="email" class="login_email" required placeholder="Email ou CPF" value="<?php echo $email; ?>" />
             <input type="password" name="senha" class="login_senha" required placeholder="Senha" />
             
             <input type="submit" name="btn_logar" class="btn_logar" value="Logar" /><br />
             
             
             </form>
             <br>
             <a href="recuperarSenha.php?email=<?php echo $email; ?>">Clique aqui para recuperar senha</a><br><br>atenção: ao recuperar a senha, um link será enviado para seu email (procure na caixa de spam também), onde você poderá modificar sua senha.</aside>
