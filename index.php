<!DOCTYPE html>
<!DOCTYPE html>


<html>

  <head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css" />
    <title>Accueil - PFA BigData en Neurosciences</title>
  </head>

  <body> 
	<form method = "get" action = "traitement.php">
	<p>
		URL du document a traiter       <input type="text" name="URL" size = "180"/><br/>
		Nom du fichier d'ontologie crée <input type = "text" name = "nomFichier" size = "40" /><br/>
		Nom de l'auteur                 <input type = "text" name = "nomAuteur" size = "40"/><br/>
		Sujet de l'article              <input type = "text" name = "nomSujet" size = "40" /><br/>
		<input type = "submit" value = "Validez et acceder a l'editeur"/><br/>	
	</p>
	</form>
	<!--<a href="index.php?URL=">Acces a l'editeur !</a> -->
  </body>

</html>