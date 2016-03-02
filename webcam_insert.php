
<!DOCTYPE html>
<html lang="de">
 <head>
  <meta charset="UTF-8">
  <title>Webcam erfassen</title>

  <style>
  body {
   font-family: Verdana, Sans-Serif;
   font-size: 14px;
   }

  form {
   background: #94D7F8;
   width: 1000px;
   padding: 10px;
  }

  span.pflichtfeld {
   font-size: 12px;
   color: Red;
  }

  span.hilfetext {
   font-size: 10px;
   font-style: Oblique;
  }
  </style>

 </head>
<body>

<?php
//
// Webcam in eine MySQL-Datenbanktabelle 'webcams' eintragen.
//
// Erstellt mit dem Formular Generator (17.02.2016)
// 		<www.webbausteine.de/tools/formulargenerator.php>
// und anschliessend manuell angepasst
//

// PHP Fehlermeldungen (1 um das Formular zu testen) anzeigen.
error_reporting(0); // (0/1)

// Ruecksprung - Nach dem absenden des Formulars,
// gelangt der Benutzer über einen Link auf folgende Seite:
$Ruecksprung = "../webcam/webcam_pflege.php";

// Datum
$bezeichn = isset($_POST["bezeichn"]) ? strip_tags(trim($_POST["bezeichn"])) : "";

// Texteintragung
$url = isset($_POST["url"]) ? strip_tags(trim($_POST["url"])) : "";

// Benutzereingaben ueberpruefen
$Fehler = ["art"=>"", "datum"=>"", "eintrag"=>""];
if (isset($_POST["speichern_x"])) {
 $Fehler["bezeichn"] = strlen($_POST["bezeichn"]) < 1 ? " Bitte f&uuml;llen Sie dieses Feld aus!" : "";
 $Fehler["bezeichn"] .= strlen($_POST["bezeichn"]) > 80 ? " Es sind maximal 80 Zeichen erlaubt!" : "";
 $Fehler["url"] = strlen($_POST["url"]) < 1 ? " Bitte f&uuml;llen Sie dieses Feld aus!" : "";
 $Fehler["url"] .= strlen($_POST["url"]) > 200 ? " Es sind maximal 200 Zeichen erlaubt!" : "";
}

// Formular als langer String zusammenstellen
$Formular = "
<form action='" . $_SERVER["SCRIPT_NAME"] . "' method='post'>

<h3>Neuer Webcam erfassen</h3>

<p>
 <label> Bezeichnung:
<span class='pflichtfeld'>&#10034; " . $Fehler["bezeichn"] . "</span><br>
  <input type='text' name='bezeichn' value='" . $bezeichn . "' size='80' maxlength='80'>
 </label>
 <br><span class='hilfetext'> Kurze Beschreibung des Webcams </span>
</p>
 		
<p>
 <label> URL:
<span class='pflichtfeld'>&#10034; " . $Fehler["url"] . "</span><br>
  <input type='text' name='url' value='" . $url . "' size='135' maxlength='200'>
 </label>
 <br><span class='hilfetext'> Webadresse des Webcams </span>
</p>

<p>
 <br>
 <input type='image' src='button_speichern.png' name='speichern' title='Speichern'>
</p>

<p>
 <small>Bitte alle mit <span class='pflichtfeld'>&#10034;</span>
 markierten Felder ausf&uuml;llen.</small>
</p>

</form>
";

// Formular abgesendet
if (isset($_POST["speichern_x"])) {

 // Es sind keine Benutzer-Eingabefehler vorhanden
 if (implode("", $Fehler) == "") {

  // Verbindungsdaten fuer die MySQL-Datenbank
  require_once '../Zugangsdaten.php';

  // Verbindungsaufbau mit der Datenban
  $db = new MySQLi($db_server, $db_benutzer, $db_passwort, $db_name);
  if ($db->connect_error) {
 	die( "Error: (" . $db->connect_errno . ") " . $db->connect_error );
  }
  $sql = "SET NAMES 'utf8'";
  $db->query($sql); 	

  // Daten eintragen in Tabelle 'kalender' 
  $sql = "INSERT INTO `webcams` SET" . " `webcams_id` = NULL, " .
    " `webcams_comment` = '" . $bezeichn . "'," .
  	" `webcams_url` = '" . $url . "'";
  
  if ($db->query($sql) === TRUE) {
  	echo "<p>Der Webcam wurde eingetragen.</p>";
  } else {
  	echo "<p>Fehler " . $db->error . " beim Eintragen der Daten!</p>";
  }
  
  // Verbindung zur Datenbank beenden
  $db->close();

  // Ruecksprung
  echo "<p><a href='" . $Ruecksprung . "'>Weiter</a></p>";
 }
 else {

  // Formular und Benutzer-Eingabefehler ausgeben
  echo $Formular;
 }
}
else {

 // Formular ausgeben
 echo $Formular;
}
?>

</body>
</html>

