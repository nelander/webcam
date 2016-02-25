<!DOCTYPE html>
<html lang="de">
 	<head>
  		<meta charset="UTF-8">
  		<title>Kalendereintrag loeschen</title>
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
	// Kalendereintragung aus der MySQL-Datenbanktabelle 'kalender' löschen
	// Aufruf: ..../kalender_delete.php?id=<id>   (<id> steht fuer das kalender_id)
	//
	
	// PHP Fehlermeldungen (1 um das Formular zu testen) anzeigen.
 	error_reporting(0); // (0/1)

	// Sprungadressen
	$Ruecksprung = "kalender_pflege.php";
	
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
	$sql = "DELETE FROM `kalender` WHERE `kalender_id`=" . $id;
	if ($db->query($sql) === TRUE) {
		echo '<p>Der Kalendereintrag mit der Id = ' . $id . 
			' wurde aus dem Kalender gel&ouml;scht</p>' . 
			'<p><a href="' . $Ruecksprung . '">Zur&uuml;ck</a><p>';
	} else {
		echo '<p>Fehler: ' . mysqli_error($db) . '!!!<p>';
	}
	
	// Verbindung zur Datenbank beenden
	$db->close();
	?>

	</body>
</html>
	