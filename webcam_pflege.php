<!DOCTYPE html>
<html lang="de">
 	<head>
  		<meta charset="UTF-8">
  		<title>Kalendereintraege pflegen</title>
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
	// Kalenderdaten aus der MySQL-Datenbanktabelle 'kalender' auflisten
	// und fuer jeden Eintrag die Moeglichkeit der Loeschung oder Aenderung
	// anzubieten. Ausserdem ein Link zur Erfassung neuer Daten.
	//
	
	// PHP Fehlermeldungen (1 um das Formular zu testen) anzeigen.
 	error_reporting(0); // (0/1)

	// Sprungadressen
	$Ruecksprung = "index.php";
	$Loeschen    = "kalender_delete.php";
	$Aendern     = "kalender_update.php";
	$Erfassen	 = "kalender_insert.php";
	$Bilderzeigen= "kalender_show.php";
	
	// Heading
	echo "<h3>Kalendereintr&auml;ge anzeigen und pflegen</h3>";
	
	// Zugangsdaten der MySQL-Datenbank
	require_once 'Zugangsdaten.php';
	
	// Verbindungsaufbau mit der der MySQL-Datenbank
	$db = new MySQLi($db_server, $db_benutzer, $db_passwort, $db_name);
	if ($db->connect_error) {
		die( "Error: (" . $db->connect_errno . ") " . $db->connect_error );
	}
	$sql = "SET NAMES 'utf8'";
	$db->query($sql); 	
	
	// Alle Datenzeilen aus der Tabelle 'kalender' lesen und ausgeben 
	$sql = "SELECT * FROM `kalender`" 
		. " ORDER BY SUBSTR(`kalender_datum`, 5, 4), SUBSTR(`kalender_datum`, 1, 4)";
	$ergebnis = $db->query($sql);
	
	// Spaltenueberschriften
 	echo '<table width="700" cellspacing="0" bgcolor="#94D7F8" border="1" >';
	echo '<tr>';
//	echo '<td width="45"><p align="center"><b>Id</b></p></td>';
	echo '<td width="35"><p align="center"><b>Art</b></p></td>';
	echo '<td width="105"><p align="center"><b>yyyy&nbsp;mm&nbsp;dd</b></p></td>';
	echo '<td width="365"><p align="left"><b>&nbsp;Texteintragung</b></p></td>';
	echo '<td width="75"><p align="center">&nbsp;</p></td>';
	echo '<td width="75"><p align="center">&nbsp;</p></td>';
	echo '</tr>';
	
	// Kalendereintraege lesen und in eine HTML-Tabelle ausgeben
	while ($zeile = $ergebnis->fetch_assoc()) {
		$id			= $zeile["kalender_id"];
		$satzart	= $zeile["kalender_art"];
		$datum_yyyy = substr($zeile["kalender_datum"], 0, 4);
		$datum_mm	= substr($zeile["kalender_datum"], 4, 2);
		$datum_dd	= substr($zeile["kalender_datum"], 6, 2);
		$eintrag	= htmlspecialchars($zeile["kalender_eintrag"]);
		
		echo '<tr>';
//		echo '<td width="45"><p align="center">' . $id . '</p></td>';
		echo '<td width="35"><p align="center">' . $satzart . '</p></td>'; 
		echo '<td width="105"><p align="center">' . 
			$datum_yyyy . '&nbsp;' . $datum_mm . '&nbsp;' . $datum_dd . '</p></td>';
		echo '<td width="365"><p align="left">&nbsp;' . $eintrag . '</p></td>';
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
	echo '<p><a href="' . $Bilderzeigen . '">Kalenderbilder anzeigen</a></p>';
	
	// Link zur Erfassungsmaske
	echo '<p><a href="' . $Erfassen . '">Neuer Kalendereintrag erfassen</a></p>';
	
	// Ruecksprung
	echo '<p><a href="' . $Ruecksprung . '">Zur&uuml;ck</a></p>';
	?>

	</body>
</html>
	