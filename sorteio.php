<script>

   var todos;
   
   function gif(){
   	    document.getElementById("gif").innerHTML="<span style='font-size: 100; color:red'>ATENÇÃAAOOO... EH AGORA.....</span><br><br><img src='img/sorteio.gif' width=1000>";

       
       document.getElementById("rapido").style="visibility: visible; font-size: 100; width:100%; word-break: break-all";
       document.getElementById("mostrar").innerHTML="";

       rapido();
       
       setTimeout(function(){ sortear() }, 7000);
	    
   }
   function embaralhar(){
   
   	    gerarLista();

	    var lista_embaralhada = todos.sort( ()=> Math.random() - 0.5);
	    
 	    
	    return lista_embaralhada;


   
   }

   function rapido(){

   	    document.getElementById('rapido').innerHTML= embaralhar()[1];

	    setTimeout(function(){rapido();}, 50);

   }


   function sortear(){

       document.getElementById("gif").innerHTML="<span style='font-size: 100; color:red'>PAROU!</span><br><br><img src='img/sorteioParou.png' width=1000>";
       document.getElementById("rapido").style="visibility: hidden";

       document.getElementById("mostrar").innerHTML="<span style='color:green'>O GANHADOR É O PARTICIPANTE COM A INSCRIÇÃO NÚMERO: <b>" + embaralhar()[1] + "</b></span>";

   }

   function gerarLista(){

   	    var numero_participantes = 8


	   var numeros = (inicio, fim) =>
	    	Array.from({length: fim}, (_,  i) => inicio+i);

	    todos = numeros(1, numero_participantes);
	    
   	    document.getElementById("todos").innerHTML=todos;
       
   }
   
</script>

<center>

<h1>SORTEIO NA COLINCAMP</h1>


<div id="todos" style="font-size: 30; width:100%; word-break: break-all"></div>


<button onclick="gif()" style="font-size:50">REALIZAR NOVO SORTEIO</button>


<br><br>

<div id="gif"></div>

<div id="mostrar" style="font-size: 100; width:100%; word-break: break-all"></div>

<div id="rapido"></div>


<script>

   gerarLista();

</script>
