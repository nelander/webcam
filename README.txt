PHP-Projekt "webcam"

webcam.php
----------
Die MySQL-Tabelle 'webcams' beinhaltet die URL und eine kurze Beschreibung fuer mehrere
Webcams. Das Programm ermittelt zuerst die Anzahl der Tabellenzeilen und benutz danach
ein Zufallsgenerator um eine Zeilen-Id zu ermitteln. Die entsprechende Tabellenzeile
wird aus der Tabelle gelesen und das Webcam-Bild zusammen mit der Beschreibung dazu
wird in HTML-Form ausgegeben.
