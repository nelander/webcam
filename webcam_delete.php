<!DOCTYPE html>
<html lang="de">
 	<head>
  		<meta charset="UTF-8">
  		<title>Webcam loeschen</title>
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
	// Webcam aus der MySQL-Datenbanktabelle 'webcams' loeschen
	// Aufruf: ..../webcam_delete.php?id=<id>   (<id> steht fuer das webcams_id)
	//
	
	// PHP Fehlermeldungen (1 um das Formular zu testen) anzeigen.
 	error_reporting(0); // (0/1)

	// Sprungadressen
	$Ruecksprung = "webcam_pflege.php";
	
	// Parameter "id" auslesen
	$id = $_GET["id"];
		
	// Zugangsdaten der MySQL-Datenbank
	require_once 'Zugangsdaten.php';
	
	// Verbindungsaufbau mit der der MySQL-Datenbank
	$db = new MySQLi($db_server, $db_benutzer, $db_passwort, $db_name);
	if ($db->connect_error) {
		die( "Error: (" . $db->connect_errno . ") " . $db->connect_error );
	}
	
	// Die Zeile mit der angegebenen Id aus der Tabelle 'kalender' loeschen 
	$sql = "DELETE FROM `webcams` WHERE `webcams_id`=" . $id;
	if ($db->query($sql) === TRUE) {
		echo '<p>Der Webcam mit der Id = ' . $id . 
			' wurde aus dem Webcam-Tabelle gel&ouml;scht</p>' . 
			'<p><a href="' . $Ruecksprung . '">Zur&uuml;ck</a><p>';
	} else {
		echo '<p>Fehler: ' . mysqli_error($db) . '!!!<p>';
	}
	
	// Verbindung zur Datenbank beenden
	$db->close();
	?>

	</body>
</html>
	