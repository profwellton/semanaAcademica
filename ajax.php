<html>
  <head>
    <title>Exemplo Ajax</title>
    <script>
     function ajax(){
	 //alert("Chamando Ajax");
	 var ajax = new XMLHttpRequest();
	 ajax.open("GET", "inscritosoficinas.php", true);
	 ajax.onreadystatechange = function(){
	     document.getElementById("aparece").innerHTML="Carregando...";
	     
	     if (ajax.readyState==4 && ajax.status==200){
		 document.getElementById("aparece").innerHTML=ajax.responseText;
	     }
	 }
	 ajax.send();
     }
    </script>
  </head>

  <body>
    <button onClick="ajax()">
      CHAMAR PÁGINA USANDO AJAX
    </button>
    
    <br />
    
    <div id="aparece"></div>
    
  </body>
</html>
