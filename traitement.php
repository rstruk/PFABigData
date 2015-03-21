<!DOCTYPE html>


<html>

  <head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css" />
    <title>PFA BigData en Neurosciences</title>
<script src="CodeMirror-master/lib/codemirror.js"></script>
<link rel="stylesheet" href="CodeMirror-master/lib/codemirror.css">
<link rel="stylesheet" href="CodeMirror-master/addon/hint/show-hint.css">
<script src="CodeMirror-master/addon/hint/show-hint.js"></script>
<script src="CodeMirror-master/addon/hint/anyword-hint.js"></script>
<script src="CodeMirror-master/mode/turtle/turtle.js"></script>
  </head>

  <body>
    <div class="PDFReader">
    <!-- Lecteur PDF -->
    <iframe class="PDF" src= "<?php echo $_GET['URL']; ?>"></iframe>
    </div>
    <div class="TurtoiseWriter">
      <!-- Zone de traitement de texte-->
      <div class="Menu">
      </div>
      <div class="Saisie">
	<form method="post" action="save.php">
	  
	      <textarea name="saisieTexte" id="saisie"></textarea><br/>
	   <script>
      var editor = CodeMirror.fromTextArea(document.getElementById("saisie"), {
        mode: {name:"turtle", globalVars: true},
      extraKeys: {"Ctrl-Space": "autocomplete",
	              "Ctrl-M":function(editor){alert("Aide: Raccourci clavier Ctrl-Space : Autocompletion Ctrl-N : Sauvegarde   Ctrl-A : Selectionner tout Ctrl-C : Copier Ctrl-V : Coller Ctrl-X : Couper");},
				  "Ctrl-N":function(editor){}
				  },
      lineNumbers: true,
      lineWrapping: true,
        matchBrackets: true
      });
	  
    </script>	
		<input type="submit" value = "Valider"/>
	</form>
      </div>
    </div>
	
		
  </body>

</html>
