
<!DOCTYPE html>
<html lang="de">
 <head>
  <meta charset="UTF-8">
  <title>Kalendereintrag erfassen</title>

  <style>
  body {
   font-family: Verdana, Sans-Serif;
   font-size: 14px;
   }

  form {
   background: #94D7F8;
   width: 600px;
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
// Kalenderdaten in eine MySQL-Datenbanktabelle 'kalender' eintragen.
//
// Erstellt mit dem Formular Generator (17.02.2016)
// 		<www.webbausteine.de/tools/formulargenerator.php>
// und anschliessend manuell angepasst
//

// PHP Fehlermeldungen (1 um das Formular zu testen) anzeigen.
error_reporting(0); // (0/1)

// Ruecksprung - Nach dem absenden des Formulars,
// gelangt der Benutzer über einen Link auf folgende Seite:
$Ruecksprung = "kalender_pflege.php";

// Anzahl Tage pro Monat
$checkTage30 = array (4, 6, 9, 11);
$checkTage31 = array (1, 3, 5, 7, 8, 10, 12);

// Art des Eintrags
$art = isset($_POST["art"]) ? strip_tags(trim($_POST["art"])) : ""; 

// Radiobutton: Art des Eintrags
$array = [ "Geburtstag", "Feiertag", "Sonstiger Eintrag" ];
$artRB = "";
foreach ($array as $key => $value) {
 $artRB .= "<label><input type='radio' name='art' value='" . $value . "'";
 if (isset($_POST["art"])) {
  if ($_POST["art"] == $value) {
   $artRB .= " checked='checked'";
  }
 }
 else if ($key == 0) { // 0 = Vorauswahl Option 1
   $artRB .= " checked='checked'";
 }
 $artRB .= ">" . $value . "</label> &nbsp;\n ";
}
// Datum
$datum = isset($_POST["datum"]) ? strip_tags(trim($_POST["datum"])) : "";
// Texteintragung
$eintrag = isset($_POST["eintrag"]) ? strip_tags(trim($_POST["eintrag"])) : "";

// Benutzereingaben ueberpruefen
$monat = substr($datum,4,2);
$tag   = substr($datum,6,2);
if (in_array($monat, $checkTage31)) {
 $maxtage = 31;
} else if (in_array($monat, $checkTage30)) {
 $maxtage = 30;
} else {
 $maxtage = 29;
}
$Fehler = ["art"=>"", "datum"=>"", "eintrag"=>""];
if (isset($_POST["speichern_x"])) {
 $Fehler["art"] = isset($_POST["art"]) == "" ? " Bitte w&auml;hlen Sie eine Option aus!" : "";
 $Fehler["datum"] = strlen($_POST["datum"]) < 8 ? " Bitte f&uuml;llen Sie dieses Feld aus (min. 8 Zeichen)!" : "";
 $Fehler["datum"] .= strlen($_POST["datum"]) > 8 ? " Es sind maximal 8 Zeichen erlaubt!" : "";
 $Fehler["datum"] .= !ctype_digit($_POST["datum"]) ? " Geben Sie nur Ziffern ein!" : "";
 $Fehler["datum"] .= $monat > 12 ? " Monat falsch (>12)!" : "";
 $Fehler["datum"] .= $monat == 00 ? " Monat falsch!" : "";
 $Fehler["datum"] .= $tag == 00 ? " Tag falsch!" : ""; 
 $Fehler["datum"] .= $tag > $maxtage ? " Zu viele Tage im Monat!" : "";
 $Fehler["eintrag"] = strlen($_POST["eintrag"]) < 1 ? " Bitte f&uuml;llen Sie dieses Feld aus!" : "";
 $Fehler["eintrag"] .= strlen($_POST["eintrag"]) > 80 ? " Es sind maximal 80 Zeichen erlaubt!" : "";
}

// Formular als langer String zusammenstellen
$Formular = "
<form action='" . $_SERVER["SCRIPT_NAME"] . "' method='post'>

<h3>Neuer Kalendereintrag erfassen</h3>

<p>
 Art des Eintrags: 
 <span class='pflichtfeld'>&#10034; " . $Fehler["art"] . "</span>
 <br>
 " . $artRB . "
</p>

<p>
 <label> Datum:
<span class='pflichtfeld'>&#10034; " . $Fehler["datum"] . "</span><br>
  <input type='text' name='datum' value='" . $datum . "' size='8' maxlength='8' autofocus='autofocus'>
 </label>
 <br><span class='hilfetext'> yyyymmdd (Jahr kann 0000 sein) </span>
</p>

<p>
 <label> Texteintragung:
<span class='pflichtfeld'>&#10034; " . $Fehler["eintrag"] . "</span><br>
  <input type='text' name='eintrag' value='" . $eintrag . "' size='80' maxlength='80'>
 </label>
 <br><span class='hilfetext'> Name des Geburtstagskinds, Bezeichnung des Feiertags oder ein beliebeiger sonstiger Text </span>
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
  require_once 'Zugangsdaten.php';

  // Verbindungsaufbau mit der Datenban
  $db = new MySQLi($db_server, $db_benutzer, $db_passwort, $db_name);
  if ($db->connect_error) {
 	die( "Error: (" . $db->connect_errno . ") " . $db->connect_error );
  }
  $sql = "SET NAMES 'utf8'";
  $db->query($sql); 	

  // Daten eintragen in Tabelle 'kalender' 
  $sql = "INSERT INTO `kalender` SET" . " `kalender_id` = NULL, " .
    " `kalender_art` = '" . $art . "'," .
  	" `kalender_datum` = '" . $datum . "'," .
  	" `kalender_eintrag` = '" . $eintrag . "'";
  
  if ($db->query($sql) === TRUE) {
  	echo "<p>Die Daten wurden eingetragen.</p>";
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

