<html>
    <head>
        <!-- TÍTULO DA PÁGINA -->
        <?php include("conexao.php"); ?>
        <title><?=$rom?> Semana acadêmica de Informática da UTFPR Francisco Beltrão</title>

        <!-- FAVICON -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <!-- TAGS -->
        <meta charset="UTF-8">
        <meta name="keywords" content="">
        <meta name="description" content="<?=$rom?> Semana Acadêmica de Informática, UTFPR - FRANCISCO BELTRÃO">
        <meta http-equiv="content-language" content="pt-br">
        <meta name="generator" content="Atom">
        <meta name="author" content="Marcos Marcolin, Rodrigo de Morais e Wellton Costa de Oliveira">

        <!-- ESTILOS CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/header.css" rel="stylesheet" type="text/css" />
        <link href="css/footer.css" rel="stylesheet" type="text/css" />
        <link href="css/nivo-slider.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/slicknav.css">
	<link rel="stylesheet" href="css/menuresponsivo.css">
	<link rel="stylesheet" href="css/responsivo.css">
	
	<!-- FONTES EXTERNAS -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

	<!-- SCRIPTS -->
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/script.js" type="text/javascript"></script>
        <script src="js/nivo.slider.js" type="text/javascript"></script>
	<script src="js/jquery.slicknav.js"></script>

     <script src="js/modernizr.min.js"></script>
    </head>
    <body>
	<!-- CABECALHO -->
	<?php
        include 'header.php';
	?>
	<!-- SLIDES -->

		<!-- SLIDES -->

	<section class="box-slider">
        <section class="conteudo">
            <section class="slides slider">
	      <!--img src="img/slides/1mobile.png"  class="image_mobile"-->
	      <div id="banner" class="nivoSlider">
		
                <img src="img/slides/1.jpg" class="image_full" />
		<img src="img/slides/2.jpg" class="image_full" />
		<img src="img/slides/3.jpg" class="image_full" />
		<img src="img/slides/4.jpg" class="image_full" />

		</div>
            </section>
        </section>
    <section>
    <div class="clear"></div>
    <!-- CORPO -->
    <section class="corpo">
      <section class="conteudo">

	<section class="sobre" id="sobre">
	                      <h3>Sobre</h3><br>
		     <p>A Universidade Tecnológica Federal do Paraná (UTFPR) campus Francisco Beltrão, através dos seus cursos de graduação Bacharelado em Sistemas de Informação e Licenciatura em Informática, realizará nos dias <?=$data?> a <?=$rom ?> Semana Acadêmica de Informática.</p><br>
<p>O evento é regional e objetiva reunir estudantes de graduação, pesquisadores da área de tecnologia e profissionais atuantes no mercado a fim de promover a troca de experiências, disseminar conhecimentos atuais e discutir as tendências de mercado da computação em suas mais diversas áreas.<p>
		    </section>
		        <div class="clear"></div>
            <!-- DADOS DO EVENTO -->
            <section class="dados-evento">
	      
              <section class="data">
                    <h3>Data</h3><br>
                    <img src="img/data.png" /><br><br>
                    <strong><?=$data?></strong><br>
                    Das 19:30 às 23:00.
                </section>

                <section class="local">
                    <h3>Local</h3><br>
                    <img src="img/local.png" /><br><br>
                    <strong>UTFPR</strong><br>
                    Câmpus Francisco Beltrão<br>
                    Linha Santa Bárbara<br>
                </section>

                <section class="tema">
                    <h3>Tema</h3><br>
                    <img src="img/tema.png" /><br><br>
                    <strong>Desafios conteporâneos</strong><br>
		    Fronteiras da computação
                </section>
            </section>
            <!-- FIM DADOS DO EVENTO -->
        </section>

	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9891.942601873068!2d-53.095099925994816!3d-26.082716809447433!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94f07258ddb8533d%3A0x253ce2f77c9926ab!2sAudit%C3%B3rio%20-%20UTFPR%20Campus%20Francisco%20Beltr%C3%A3o!5e1!3m2!1sen!2sbr!4v1712800543966!5m2!1sen!2sbr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

	
	<section class="conteudo">

	    <!-- CORPO PROGRAMAÇÃO -->
	    <section class="programacao" id="programacao"><br>
		    <center><h2>PROGRAMAÇÃO</h2></center><br>
		    <?php
		     include("programacao.php");
		     ?>
            </section>
            
          <!-- FIM PROGRAMAÇÃO -->

	    <!-- INSCRIÇÕES -->
	    <section class="inscricoes">

		<section class="formulario" id="inscricoes">
		    <center><h2>
		    INSCRIÇÕES
		    <!--span class="vermelho">INSCRIÇÕES ENCERRADAS</span-->
		    </h2></center>
		    <?php
		    include("formulario.php");
		    ?>
		</section>
	    </section>
	    <!-- FIM INSCRIÇÕES -->
	    
	    
	    <!-- LOGIN -->	    
	    <section class="login">
		<center><h2>FAÇA SEU LOGIN</center></h2>
		<?php  include("login.php"); ?>
	    </section>
	    <!-- FIM LOGIN -->	    	    

	    <!-- APOIO -->	    	    
	    <section class="apoio" id="apoio">
              <h2> APOIO </h2>

		<ul>
		    <li><a href="https://www.megasult.com.br" target="_blank"><img src="img/apoio/megasult.png" alt="Megasult Sistemas" title="Megasult Sistemas" /></a></li>
		</ul>

		<ul>
		    <li><a href="https://www.acefb.com.br/nucleos/detail/21/nubetc-nucleo-beltronense-das-empresas-de-tecnologia-da-informacao/" target="_blank"><img src="img/apoio/nubetec.jpg" alt="Nubetec" title="Nubetec" /></a></li>
		</ul>

		<ul>
		    <li><a href="https://instagram.com/flashprint_3d/" target="_blank"><img src="img/apoio/flashnovo.png" alt="Flash Print" title="Flash Print" /></a></li>
		</ul>
		<ul>
		    <li><a href="" target="_blank"><img src="img/apoio/mvnovo.png" alt="MVImports" title="MVImports" /></a></li>
		</ul>
		<ul>
		    <li><a href="https://www.imaxis.com.br/" target="_blank"><img src="img/apoio/imaxis.png" alt="imaxis" title="maxis" /></a></li>
		</ul>

		<ul>
		    <li><a href="https://bacelltech.com.br/" target="_blank"><img src="img/apoio/bacell.png" alt="bacelltech" title="bacelltech" /></a></li>
		</ul>

		<ul>
		    <li style="padding-top: 30px;><a href="https://www.ampernet.com.br/" target="_blank"><img src="img/apoio/ampernet.png" alt="Ampernet" title="Ampernet" /></a></li>
		</ul>

		<!-- 


		<ul>
		    <li><a href="https://cresol.com.br/category/cidade/francisco-beltrao-pr/" target="_blank"><img src="img/apoio/cresol.png" alt="Cresol" title="Cresol" /></a></li>
		</ul>

		<ul>
		    <li><a href="https://parseint.com.br/" target="_blank"><img src="img/apoio/parseint.jpg" alt="Sischef" title="Sischef" width="800" /></a></li>
		</ul>

		<ul>
		    <li><a href="https://instagram.com/instituto_hoffmann?igshid=YmMyMTA2M2Y=" target="_blank"><img src="img/apoio/institutohoffmann.jpg" alt="Instituto Hoffmann" title="Instituto Hoffmann" width="700" /></a></li>
		</ul>


               
		<ul>
		    <li><a href="https://web.facebook.com/people/OFF-Servi%C3%A7os-de-Tecnologia/100063652435082/" target="_blank"><img src="img/apoio/off.png" alt="OFF Serviços de Tecnologia" title="OFF Serviços de Tecnologia" width="800" /></a></li>
		</ul>
	        <ul>
		    <li><a href="https://www.instagram.com/3dtreco/" target="_blank"><img src="img/apoio/3dtreco.png" alt="3D Treco" title="3D Treco" /></a></li>
		</ul-->
</h2>
	      
	    </section>

	    
             <!-- REALIZAÇÃO-->
            <section class="apoio" id="apoio">
                <h2>Realização</h2><br>
                <ul>
                    <li><a href="http://www.utfpr.edu.br/franciscobeltrao" target="_blank"><img src="img/apoio/utfpr.png" alt="UTFPR" title="UTFPR" /></a></li>

		    <li><a href="http://www.utfpr.edu.br/cursos/graduacao/licenciatura/licenciatura-em-informatica" target="_blank"><img src="img/apoio/colin.png" alt="Curso de Licenciatura em Informática" title="Curso de Licenciatura em Informática" /></a></li>

                    <li><a href="https://portal.utfpr.edu.br/cursos/graduacao/bacharelado/sistemas-de-informacao" target="_blank"><img src="img/bsi.png" alt="Curso de Bacharel em Sistemas de Informação" title="Curso de Bacharel em Sistemas de Informação" /></a></li>

		    <li><a href="https://portal.utfpr.edu.br/cursos/graduacao/bacharelado/sistemas-de-informacao" target="_blank"><img src="img/apoio/cabsi.png" alt="Centro Acadêmico do Curso de Bacharel em Sistemas de Informação" title="Centro Acadêmico Curso de Bacharel em Sistemas de Informação" /></a></li>

		    
		    <li><a href="https://pt-br.facebook.com/caliutfpr/" target="_blank"><img src="img/apoio/cali.png" alt="Centro Acadêmico de Licenciatura em Informática, UTFPR" title="Centro Acadêmico de Licenciatura em Informática, UTFPR" /></a></li>


		</ul>
            </section>


	    

	</section>
        <div class="clear"></div>
    </section>

    <script>

      $(window).load(function() {

$('#banner').nivoSlider({

slices: 15,

boxCols: 8,

boxRows: 4,

animSpeed: 500,

pauseTime: 3000,

startSlide: 0,

directionNav:true,

controlNav:true,

controlNavThumbs:false,

pauseOnHover:true,

manualAdvance:false,

prevText:'Prev',

nextText:'Next',

randomStart:false,

beforeChange:function(){},

afterChange:function(){},

slideshowEnd:function(){},

lastSlide:function(){},

afterLoad:function(){}

});

});

</script>


    
    <!-- RODAPE -->
    <?php
        include 'footer.php';
    ?>
    <div class="clear"></div>
</body>
</html>
