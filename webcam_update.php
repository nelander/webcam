<!DOCTYPE html>
<html lang="de">
 	<head>
  		<meta charset="UTF-8">
  		<title>Webcam &auml;ndern</title>
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
	// Webcam-Eintragung aus der MySQL-Datenbanktabelle 'webcams' aendern
	// Aufruf: ..../webcam_update.php?id=<id>   (<id> steht fuer das webcams_id)
	//
	
	// PHP Fehlermeldungen (1 um das Formular zu testen) anzeigen.
 	error_reporting(0); // (0/1)

	// Sprungadressen
	$Ruecksprung = "webcam_pflege.php";
	
	// Parameter "id" auslesen
	$id = $_GET["id"];
	
	// Hinweis, dass der Funktion noch nicht realisiert ist
	echo '<p>Der Webcam mit Id = ' . $id . ' wurde NICHT ge&auml;ndert,' . 
		' da diese Funktion noch nicht realisiert wurde.</p>';
	echo '<p>Bitte, bis auf weiteres, statt dessen Webcam l&ouml;schen und danach neu eintragen</p>';
	echo '<p><a href="' . $Ruecksprung . '">Zur&uuml;ck</a></p>';
	?>

	</body>
</html>
	