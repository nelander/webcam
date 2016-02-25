<?php
echo "<font size=\"5\" face=\"Arial\">";

//
// Alle Webcams aus der MySQL-Tabelle 'webcams' werden zusammen angezeigt
//

// Zugangsdaten der MySQL-Datenbank
require_once 'Zugangsdaten.php';

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

echo "<hr />";		// Trennlinie ausgeben

// Webcams ausgeben
while ($zeile = $ergebnis->fetch_assoc()) {
	$bezeichn	= $zeile["webcams_comment"];
	$url		= $zeile["webcams_url"];
	echo '<img src="' . $url . '" border="0" width="569" height="370">';
	echo '<br \>' . $bezeichn;
	echo "<hr />";	// Trennlinie ausgeben
}
 
// Verbindung zur Datenbank beenden
$db->close();

echo "</font>";
?>