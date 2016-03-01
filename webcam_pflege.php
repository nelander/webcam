<!DOCTYPE html>
<html lang="de">
 	<head>
  		<meta charset="UTF-8">
  		<title>Webcam-Eintraege pflegen</title>
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
	// Webcams aus der MySQL-Datenbanktabelle 'webcams' auflisten
	// und fuer jeden Eintrag die Moeglichkeit der Loeschung oder Aenderung
	// anzubieten. Ausserdem ein Link zur Erfassung neuer Daten.
	//
	
	// PHP Fehlermeldungen (1 um das Formular zu testen) anzeigen.
 	error_reporting(0); // (0/1)

	// Sprungadressen
	$Ruecksprung	= "../privat/index.php";
	$Loeschen	= "../webcam/webcam_delete.php";
	$Aendern	= "../webcam/webcam_update.php";
	$Erfassen	= "../webcam/webcam_insert.php";
	$Zeigen		= "../webcam/webcam_show.php";
	
	// Heading
	echo "<h3>Webcam-Eintr&auml;ge anzeigen und pflegen</h3>";
	
	// Zugangsdaten der MySQL-Datenbank
	require_once '../Zugangsdaten.php';
	
	// Verbindungsaufbau mit der der MySQL-Datenbank
	$db = new MySQLi($db_server, $db_benutzer, $db_passwort, $db_name);
	if ($db->connect_error) {
		die( "Error: (" . $db->connect_errno . ") " . $db->connect_error );
	}
	$sql = "SET NAMES 'utf8'";
	$db->query($sql); 	
	
	// Alle Datenzeilen aus der Tabelle 'webcams' lesen und ausgeben 
	$sql = "SELECT * FROM `webcams` ORDER BY `webcams_id`";
	$ergebnis = $db->query($sql);
	
	// Spaltenueberschriften
 	echo '<table width="1000" cellspacing="0" bgcolor="#94D7F8" border="1" >';
	echo '<tr>';
//	echo '<td width="45"><p align="center"><b>Id</b></p></td>';
	echo '<td width="300"><p align="left"><b>&nbsp;Bezeichnung</b></p></td>';
	echo '<td width="505"><p align="left"><b>&nbsp;URL</b></p></td>';
	echo '<td width="75"><p align="center">&nbsp;</p></td>';
	echo '<td width="75"><p align="center">&nbsp;</p></td>';
	echo '</tr>';
	
	// Kalendereintraege in eine HTML-Tabelle ausgeben
	while ($zeile = $ergebnis->fetch_assoc()) {
		$id			= $zeile["webcams_id"];
		$bezeichn	= $zeile["webcams_comment"];
		$url		= $zeile["webcams_url"];
		
		echo '<tr>';
//		echo '<td width="45"><p align="center">' . $id . '</p></td>';
		echo '<td width="300"><p align="left">&nbsp;' . $bezeichn . '</p></td>';
		echo '<td width="505"><p align="left">&nbsp;' . $url . '</p></td>';		
		echo '<td width="75"><p align="center"><a href="' . $Loeschen . '?id=' . $id .
			'">l&ouml;schen</a>';
		echo '<td width="75"><p align="center"><a href="' . $Aendern . '?id=' . $id .
			'">&auml;ndern</a>';
		echo '</tr>';	
	}
				
	// HTML-Tabelle beenden
	echo '</tr>';
	  
	// Verbindung zur Datenbank beenden
	$db->close();
	
	// Link zur Kalenderbilder-Anzeige
	echo '<p><a href="' . $Zeigen		. '">Alle Webcams zeigen</a></p>';
	
	// Link zur Erfassungsmaske
	echo '<p><a href="' . $Erfassen		. '">Neuer Webcam erfassen</a></p>';
	
	// Ruecksprung
	echo '<p><a href="' . $Ruecksprung	. '">Zur&uuml;ck</a></p>';
	?>

	</body>
</html>
	