<?php
	//
	// Lese MySQL-Tabelle 'webcams' und gebe ein zufaelliger Webcam aus der Tabelle aus
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
	
	// Alle Datenzeilen aus der Tabelle 'webcams' lesen
	$sql = "SELECT * FROM `webcams` ORDER BY `webcams_id`";
	$ergebnis = $db->query($sql);
	
	// Webcam mit der Nummer entsprechend Zufallsgenerator auswählen und ausgeben
	$nr = 0;
	while ($zeile = $ergebnis->fetch_assoc()) {
		$nr = $nr + 1;
		if ($nr == $webcam_index) {
			$kommentar  = htmlspecialchars($zeile["webcams_comment"]);
			$webadresse = $zeile["webcams_url"];
			echo '<img src="' . $webadresse . '" border="0" width="569" height="370">';
			echo '<br \>' . $kommentar;
		}
	}

	// Verbindung zur Datenbank beenden
	$db->close();
?>