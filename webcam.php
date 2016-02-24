<?php
	//
	// Lese Tabelle 'webcams' und gebe ein zufaelliger Webcam aus der Tabelle aus
	//

	// Zugangsdaten vom MySQL-Server
	require_once 'Zugangsdaten.php';	
	
	// Verbindungsaufbau mit der Datenbank
	$db = new MySQLi($db_server, $db_benutzer, $db_passwort, $db_name);
	if ($db->connect_error) {
		die( "Error: (" . $db->connect_errno . ") " . $db->connect_error );
	}
 	$sql = "SET NAMES 'utf8'";
 	$db->query($sql);
		
	// Anzahl der Webcams in der Tabelle 'webcams' ermitteln
	$sql = "SELECT COUNT(*) FROM `webcams`";
	$ergebnis = $db->query($sql);
	$zeile  = $ergebnis->fetch_row();
	$anzahl = $zeile[0];
	
	// Ein zufaelliger Webcam auswaehlen und aus der Tabelle 'webcams' lesen
	$webcam_index = mt_rand(1,$anzahl);		// Zufallsgenerator
	
	$sql = "SELECT * FROM `webcams` WHERE `webcams_id` = '" . $webcam_index . "'";
	$ergebnis = $db->query($sql);
	while($zeile = $ergebnis->fetch_assoc()) {
		$kommentar  = htmlspecialchars($zeile["webcams_comment"]);
		$webadresse = $zeile["webcams_url"];
	}
	
	// HTML generieren
	echo '<img src="' . $webadresse . '" border="0" width="569" height="370">';
	echo '<br \>' . $kommentar;
	
	// Verbindung zur Datenbank beenden
	$db->close();
?>