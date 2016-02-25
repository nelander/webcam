<!DOCTYPE html>
<html lang="de">
 	<head>
  		<meta charset="UTF-8">
  		<title>Kalendereintrag &auml;ndern</title>
		<style>
	  		body {
	   			font-family: Verdana, Sans-Serif;
	   			font-size: 14px;
	  		}
		</style>
	</head>
	<body>
	
	<?php
	//
	// Kalendereintragung aus der MySQL-Datenbanktabelle 'kalender' aendern
	// Aufruf: ..../kalender_update.php?id=<id>   (<id> steht fuer das kalender_id)
	//
	
	// PHP Fehlermeldungen (1 um das Formular zu testen) anzeigen.
 	error_reporting(0); // (0/1)

	// Sprungadressen
	$Ruecksprung = "kalender_pflege.php";
	
	// Parameter "id" auslesen
	$id = $_GET["id"];
	
	// Hinweis, dass der Funktion noch nicht realisiert ist
	echo '<p>Der Kalendereintrag mit Id = ' . $id . ' wurde NICHT ge&auml;ndert,' . 
		' da diese Funktion noch nicht realisiert wurde.</p>';
	echo '<p>Bitte, bis auf weiteres, statt dessen Satz l&ouml;schen und danach neu eintragen</p>';
	echo '<p><a href="' . $Ruecksprung . '">Zur&uuml;ck</a></p>';
	?>

	</body>
</html>
	