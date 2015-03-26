<?php

function save(){
    $subject = $_GET['topic'];
    $i = 0;
    $save_dir = 'save/'.$subject;
    if(!is_dir($save_dir))
        mkdir($save_dir, 0777, true);
    $nomFichier = $_GET['filename'];
    $extensionFichier = '.txt';
    $auteurFichier = $_POST['author'];
    $nomPDF = $_POST['pdfUrl'];
    if(!is_file($save_dir.'/'.$nomFichier.$extensionFichier))
    	$fichier = fopen($save_dir.'/'.$nomFichier.$extensionFichier, 'a');
    else {
    	$i = 1;
    	while (is_file($save_dir.'/'.$nomFichier.' ('.$i.')'.$extensionFichier))
        	$i=$i+1;
    	$fichier = fopen($save_dir.'/'.$nomFichier.' ('.$i.')'.$extensionFichier, 'a');
    }
    if(isset($_POST['saisieTexte'])) {
        fputs($fichier, 'Version du fichier :'.$i. "\r\n" );	
        fputs($fichier, 'Document PDF lié : '.$nomPDF."\r\n");
        fputs($fichier, 'Auteur du fichier : '.$auteurFichier."\r\n"."\r\n");
        fputs($fichier, $_POST['text']);
    }
    fclose($fichier);
}
