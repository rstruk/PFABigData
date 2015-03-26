<!DOCTYPE html>


<html>

  <head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css" />
    <title>Sauvegarde de fichier - PFA BigData en Neurosciences</title>
  </head>

  <body> 
	<?php
	$save_dir = 'save/';
	$nomFichier = 'test.txt';
	$auteurFichier = 'David';
	$nomPDF = 'Trololo';
	$fichier = fopen($save_dir.$nomFichier,'a');
	fputs($fichier, 'Document PDF lié : '.$nomPDF."\r\n");
	fputs($fichier, 'Auteur du fichier : '.$auteurFichier."\r\n"."\r\n");
	fputs($fichier, $_POST['saisieTexte']);
	
	fclose($fichier);
	?>
  </body>

</html>