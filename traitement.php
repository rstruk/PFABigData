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
	<form method="post" action="">
	  <?php // var_dump($_POST['saisieTexte']);?>
	      <textarea name="saisieTexte" id="saisie" value = "<?php echo isset($_POST['saisieTexte'])?$_POST['saisieTexte']:''; ?>"></textarea><br/>
	   <script>
      var editor = CodeMirror.fromTextArea(document.getElementById("saisie"), {
        mode: {name:"turtle", globalVars: true},
      extraKeys: {"Ctrl-Space": "autocomplete",
	              "Ctrl-N":function(editor){alert("Aide: Raccourci clavier Ctrl-Space : Autocompletion Ctrl-N : Sauvegarde   Ctrl-A : Selectionner tout Ctrl-C : Copier Ctrl-V : Coller Ctrl-X : Couper");},
				  "Ctrl-M":function(editor){<?php save();?> alert("Save");}				 
				  },
      lineNumbers: true,
      lineWrapping: true,
        matchBrackets: true
      });
	  
    </script>	
	<?php
	function save(){
	$subject = $_GET['nomSujet'];
	$i = 0;
	$save_dir = 'save/'.$subject;
	if(!is_dir($save_dir)){mkdir($save_dir,0777,true);}
    $nomFichier = $_GET['nomFichier'];
	$extensionFichier = '.txt';
	$auteurFichier = $_GET['nomAuteur'];
	$nomPDF = $_GET['URL'];
	if(!is_file($save_dir.'/'.$nomFichier.$extensionFichier)){
		$fichier = fopen($save_dir.'/'.$nomFichier.$extensionFichier,'a');}
	else{
		$i = 1;
		while(is_file($save_dir.'/'.$nomFichier.'('.$i.')'.$extensionFichier)){
		$i=$i+1;
		}
		$fichier = fopen($save_dir.'/'.$nomFichier.'('.$i.')'.$extensionFichier,'a');
	}
	if(isset($_POST['saisieTexte'])){
	fputs($fichier, 'Version du fichier :'.$i. "\r\n" );	
	fputs($fichier, 'Document PDF lié : '.$nomPDF."\r\n");
    fputs($fichier, 'Auteur du fichier : '.$auteurFichier."\r\n"."\r\n");
    fputs($fichier, $_POST['saisieTexte']);}
    fclose($fichier);
	
	}?>
		<input type="submit" value = "Valider" onClick = <?php save(); ?>/>
	</form>
      </div>
    </div>
	
		
  </body>

</html>
